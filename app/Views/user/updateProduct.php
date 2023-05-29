<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="form-wrapper">
        <h2>Perbarui Produk</h2>
        <?php $error = session()->get('_ci_validation_errors'); ?>
        <form action="/admin/update-product" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="id" id="id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="photoLama" id="photoLama" value="<?= $product['photo'] ?>">
                    <div class="form-group">
                        <label for="inputName">Nama Buku :</label>
                        <input type="text" class="form-control <?= isset($error['name']) ? 'is-invalid' : '' ?>" id="inputName" name="name" placeholder="Masukkan nama barang" value="<?= $product['name']; ?>">
                        <div class="invalid-feedback">
                            <?= isset($error['name']) ? $error['name'] : ''; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPrice">Harga :</label>
                        <input type="number" class="form-control <?= isset($error['price']) ? 'is-invalid' : '' ?>" id="inputPrice" name="price" placeholder="Masukkan harga barang" value="<?= $product['price']; ?>">
                        <div class="invalid-feedback">
                            <?= isset($error['price']) ? $error['price'] : ''; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputQuantity">Stok :</label>
                        <input type="number" class="form-control <?= isset($error['quantity']) ? 'is-invalid' : '' ?>" id="inputQuantity" name="quantity" placeholder="Masukkan jumlah barang" value="<?= $product['quantity']; ?>">
                        <div class="invalid-feedback">
                            <?= isset($error['quantity']) ? $error['quantity'] : ''; ?>
                        </div>
                    </div>
                    <button href="/dashboard" type="submit" class="btn btn-submit">Simpan</button>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputSource">Nama Penulis :</label>
                        <input type="text" class="form-control <?= isset($error['writer']) ? 'is-invalid' : '' ?>" id="inputSource" name="writer" placeholder="Masukkan asal makanan" value="<?= $product['writer']; ?>">
                        <div class="invalid-feedback">
                            <?= isset($error['writer']) ? $error['writer'] : ''; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFoto">Foto Barang :</label>
                        <input type="file" class="form-control-file" id="inputFoto" name="foto">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>