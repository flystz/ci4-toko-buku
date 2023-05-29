<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OfficeModel;
use App\Models\ProductModel;
use App\Models\TransaksiModel;
use Dompdf\Dompdf;

class Users extends BaseController
{
    protected $productModel;
    protected $transaksiModel;
    protected $officeModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->transaksiModel = new TransaksiModel();
        $this->officeModel = new OfficeModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_master_product') ? $this->request->getVar('page_master_product') : 1;

        $data = [
            'title' => 'Dashboard',
            // 'product' => $this->productModel->getProduct(),
            'product' => $this->productModel->paginate(4, 'master_product'),
            'pager' => $this->productModel->pager,
            'currentPage' => $currentPage
        ];
        return view('user/index', $data);
    }

    public function create($id)
    {
        $data = [
            'title' => 'Pembelian',
            'product' => $this->productModel->getProduct($id),
        ];
        return view('user/create', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail',
            'product' => $this->productModel->getProduct($id)
        ];

        return view('user/detail', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'pembeli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $id_product = $this->request->getVar('id');
        $jumlah_product = $this->request->getVar('jumlah');
        $pembeli = $this->request->getVar('pembeli');
        $quantity_product = $this->productModel->updateQuantity($id_product);

        //pengecekan apabila jumlah pembelian melebihi stock
        if ($quantity_product['quantity'] - $jumlah_product < 0) {
            session()->setFlashdata('pesan', 'Jumlah pembelian melebihi stock');
            return redirect()->back()->withInput();
        } else {
            $pengurangan_stok = $quantity_product['quantity'] - $jumlah_product;
        }

        $this->transaksiModel->save([
            'id_product' => $id_product,
            'quantity' => $jumlah_product,
            'buyer' => $pembeli,
            'id_account' => session()->get('account')['id'],
            'id_office' => session()->get('account')['id_name_office'],
        ]);

        $this->productModel->save([
            'id' => $id_product,
            'quantity' => $pengurangan_stok
        ]);

        session()->setFlashdata('pesan', 'Produk berhasil dipesan');

        return redirect()->to('/dashboard');
    }

    public function keranjang($sessionName = '')
    {
        $data = [
            'title' => 'History',
            'item' => $this->transaksiModel->getProduct()
        ];

        return view('user/keranjang', $data);
    }

    public function addProduct()
    {
        $data = [
            'title' => 'Add Product',
        ];
        return view('user/addProduct', $data);
    }

    public function saveProduct()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[master_product.name]',
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                    'is_unique' => 'nama sudah terdaftar'
                ]
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harga tidak boleh kosong',
                ]
            ],
            'quantity' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah stock tidak boleh kosong',
                ]
            ],
            'writer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kolom asal tidak boleh kosong',
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'file yang diupload bukan gambar',
                    'mime_in' => 'selain format jpg, jpeg, dan png tidak diterima'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }
        $name = $this->request->getVar('name');
        $price = $this->request->getVar('price');
        $description = $this->request->getVar('description');
        $quantity = $this->request->getVar('quantity');
        $writer = $this->request->getVar('writer');
        $year = $this->request->getVar('year');
        $photo = $this->request->getFile('foto');

        if ($photo->getError() == 4) {
            $photoName = 'default.jpeg';
        } else {
            // generate nama random
            $photoName = $photo->getRandomName();
            // memindahkan gambar ke folder img_upload
            $photo->move('img/img_upload', $photoName);
        }

        $this->productModel->save([
            'photo' => $photoName,
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'writer' => $writer,
            'year' => $year,
            'quantity' => $quantity
        ]);

        session()->setFlashdata('pesan', 'Product berhasil ditambahkan');

        return redirect()->to('/dashboard');
    }

    public function productEdit($id)
    {
        $data = [
            'title' => 'Update Product',
            'product' => $this->productModel->getProduct($id)
        ];
        return view('user/updateProduct', $data);
    }

    public function updateProduct()
    {

        //cek apakah nama diganti atau tidak
        $namaLama = $this->productModel->getProduct($this->request->getVar('id'));
        if ($namaLama['name'] == $this->request->getVar('name')) {
            $rulejudul = 'required';
        } else {
            $rulejudul = 'required|is_unique[master_product.name]';
        }

        if (!$this->validate([
            'name' => [
                'rules' => $rulejudul,
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                    'is_unique' => 'nama sudah terdaftar'
                ]
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harga tidak boleh kosong',
                ]
            ],
            'quantity' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah stock tidak boleh kosong',
                ]
            ],
            'writer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kolom asal tidak boleh kosong',
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'file yang diupload bukan gambar',
                    'mime_in' => 'selain format jpg, jpeg, dan png tidak diterima'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $id = $this->request->getVar('id');
        $name = $this->request->getVar('name');
        $price = $this->request->getVar('price');
        $quantity = $this->request->getVar('quantity');
        $writer = $this->request->getVar('writer');
        $photo = $this->request->getFile('foto');

        //cek gambar apakah diganti atau tidak
        if ($photo->getError() == 4) {
            $photoName = $this->request->getVar('photoLama');
        } else {
            //generate file random
            $photoName = $photo->getRandomName();
            //move gambar
            $photo->move('img/img_upload', $photoName);
            //hapus file yang lama
            // unlink('img/img_upload/' . $this->request->getVar('photoLama'));
        }

        $this->productModel->save([
            'id' => $id,
            'photo' => $photoName,
            'name' => $name,
            'price' => $price,
            'writer' => $writer,
            'quantity' => $quantity
        ]);

        session()->setFlashdata('pesan', 'Product berhasil diupdate');

        return redirect()->to('/dashboard');
    }

    public function productDelete($id)
    {
        //cari gambar berdasarkan id
        $product = $this->productModel->find($id);

        // pengecekan untuk default.jpeg
        if ($product['photo'] != 'default.jpeg') {
            //hapus gambar yang di direktori
            // unlink('img/img_upload/' . $product['photo']);
        }


        $this->productModel->delete($id);

        session()->setFlashdata('pesan', 'Product berhasil dihapus');

        return redirect()->to('/dashboard');
    }

    public function cetak()
    {
        $data = [
            'data' => $this->transaksiModel->getProduct(),
            'cabang' => $this->officeModel->getOffice(session()->get('account')['id_name_office'])
        ];
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('/user/cetakLaporan', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan_Pengeluaran_' . date('d-M-y'), ['Attachment' => 0]);
    }
}
