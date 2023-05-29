<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container form-wrapper">
    <div class="row">
        <div class="col">
            <h2 class="mt-2 mb-3">Detail Produk</h2>

            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/img_upload/<?= $product['photo']; ?>" class="img-fluid rounded-start sampul-detail" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><?= strtoupper($product['name']); ?></h3>
                            <p class="card-text">Nama Penulis : <?= $product['writer']; ?></p>
                            <h5 class="card-text"><b>Harga : <?= number_format($product['price'], 0, ',', '.'); ?></b></h5>
                            <br>
                            <a href="/dashboard" class="btn btn-success mr-2">Kembali</a>
                            <a href="/dashboard/edit/<?= $product['id']; ?>" class="btn btn-warning mr-2">Perbarui</a>
                            <a href="/dashboard/delete/<?= $product['id']; ?>" class="btn btn-danger mr-2" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>