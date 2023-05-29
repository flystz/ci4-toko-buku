<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\OfficeModel;

class SuperAdmin extends BaseController
{
    protected $accountModel;
    protected $officeModel;
    public function __construct()
    {
        $this->accountModel = new AccountModel();
        $this->officeModel = new OfficeModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard SuperAdmin'
        ];
        return view('/superadmin/index', $data);
    }

    public function manage()
    {
        $data = [
            'title' => 'Data Admin',
            'list' => $this->accountModel->getAccount()
        ];
        return view('/superadmin/data', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Admin',
            'office' => $this->officeModel->getOffice()
        ];
        return view('/superadmin/add', $data);
    }

    public function editAdmin($id)
    {
        $data = [
            'title' => 'Edit Admin',
            'admin' => $this->accountModel->getAccount($id),
            'office' => $this->officeModel->getOffice(),
        ];

        return view('/superadmin/edit', $data);
    }

    public function edit()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                    'valid_email' => 'bukan email'
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $id = $this->request->getVar('id');
        $name = $this->request->getVar('name');
        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');
        $role = $this->request->getVar('role');
        $office = $this->request->getVar('office');

        // $getIdOffice = $this->officeModel->getIdOffice($office);

        $this->accountModel->save([
            'id' => $id,
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'role' => $role,
            'id_name_office' => $office
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diupdate');

        return redirect()->to('/superadmin/manage-admin');
    }

    public function add()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                    'valid_email' => 'bukan email'
                ]
            ],

            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                ]
            ],

            'confirm_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],

        ])) {
            return redirect()->back()->withInput();
        }

        $name = $this->request->getVar('name');
        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $confirmPassword = $this->request->getVar('confirm_password');
        $role = $this->request->getVar('role');
        $office = $this->request->getVar('office');

        if ($password == $confirmPassword) {

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $this->accountModel->save([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => $passwordHash,
                'role' => $role,
                'id_name_office' => $office
            ]);
            session()->setFlashdata('pesan', 'Akun berhasil dibuat, silahkan login');

            return redirect()->to('/superadmin/manage-admin');
        } else {
            session()->setFlashdata('alert-regist', 'password dan confirm password tidak sama');
            return redirect()->to(base_url('/superadmin/add-admin'))->withInput();
        }
    }

    public function deleteAdmin($id)
    {
        $this->accountModel->delete($id);

        session()->setFlashdata('pesan', 'Product berhasil dihapus');

        return redirect()->to('/superadmin/manage-admin');
    }

    public function manageOffice()
    {
        $data = [
            'title' => 'Data Office',
            'list' => $this->officeModel->getOffice()
        ];
        return view('/superadmin/dataOffice', $data);
    }

    public function editOffice($id)
    {
        $data = [
            'title' => 'Edit Office',
            'office' => $this->officeModel->getOffice($id)
        ];

        return view('/superadmin/editOffice', $data);
    }

    public function updateOffice()
    {
        if (!$this->validate([
            'name_office' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                ]
            ],
            'location' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $id = $this->request->getVar('id');
        $name_office = $this->request->getVar('name_office');
        $location = $this->request->getVar('location');

        $this->officeModel->save([
            'id' => $id,
            'office_name' => $name_office,
            'location' => $location
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diupdate');
        return redirect()->to('/superadmin/manage-office');
    }

    public function deleteOffice($id)
    {
        $this->officeModel->delete($id);

        session()->setFlashdata('pesan', 'Product berhasil dihapus');

        return redirect()->to('/superadmin/manage-office');
    }

    public function addOffice()
    {
        $data = [
            'title' => 'Edit Office'
        ];
        return view('/superadmin/addOffice', $data);
    }

    public function addOffices()
    {
        if (!$this->validate([
            'name_office' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                ]
            ],
            'location' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'lokasi tidak boleh kosong',
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $name_office = $this->request->getVar('name_office');
        $location = $this->request->getVar('location');

        $this->officeModel->save([
            'office_name' => $name_office,
            'location' => $location,
        ]);
        session()->setFlashdata('pesan', 'Akun berhasil dibuat, silahkan login');
        return redirect()->to(base_url('/superadmin/manage-office'))->withInput();
    }
}
