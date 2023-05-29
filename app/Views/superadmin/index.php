<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container form-wrapper">
    <h1 class="mb-4"><b>Selamat Datang SuperAdmin</b></h1>
    <a href="/dashboard" class="btn btn-warning mb-3">< Kembali</a>
    <div class="row d-flex justify-content-around">
        <div class="card" style="width: 18rem;">
            <img src="/img/blogger.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><b>Admin</b></h5>
                <p class="card-text">Data para pemegang akun dengan role admin</p>
                <a href="/superadmin/manage-admin" class="btn btn-primary">Kelola</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="/img/add.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><b>Tambah Admin</b></h5>
                <p class="card-text">Menambah akun untuk mengakses aplikasi</p>
                <a href="/superadmin/add-admin" class="btn btn-primary">[+] Tambah</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="/img/office.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><b>Kelola Kantor</b></h5>
                <p class="card-text">Mengelola Kantor cabang seperti menambah dan mengedit</p>
                <a href="/superadmin/manage-office" class="btn btn-primary">Kelola</a>
            </div>
        </div>
    </div>
    <br><br>
</div>
<?= $this->endSection(); ?>