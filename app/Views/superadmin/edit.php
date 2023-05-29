<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Perbarui Akun</h3>
                                <?php $error = session()->get('_ci_validation_errors'); ?>
                            </div>
                            <div class="card-body">
                                <form action="/superadmin/update" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="form-floating mb-3">
                                        <label for="inputName">Nama</label>
                                        <input class="form-control <?= isset($error['name']) ? 'is-invalid' : '' ?>" id="name" type="text" placeholder="vita" name="name" value="<?= $admin['name'] ?>" />
                                        <div class="invalid-feedback">
                                            <?= isset($error['name']) ? $error['name'] : ''; ?>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="inputUsername">Username</label>
                                        <input class="form-control <?= isset($error['username']) ? 'is-invalid' : '' ?>" id="username" type="text" placeholder="vitacantik" name="username" value="<?= $admin['username'] ?>" />
                                        <div class="invalid-feedback">
                                            <?= isset($error['username']) ? $error['username'] : ''; ?>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="inputEmail">Email</label>
                                        <input class="form-control <?= isset($error['email']) ? 'is-invalid' : '' ?>" id="inputEmail" type="email" placeholder="name@example.com" name="email" value="<?= $admin['email'] ?>" />
                                        <div class="invalid-feedback">
                                            <?= isset($error['email']) ? $error['email'] : ''; ?>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Role</label>
                                        </div>
                                        <select class="custom-select" id="inputGroupSelect01" name="role">
                                            <option selected disabled>Choose...</option>
                                            <option <?= $admin['role'] == 'superadmin' ? 'selected' : ''; ?> value="superadmin">SuperAdmin</option>
                                            <option <?= $admin['role'] == 'admin' ? 'selected' : ''; ?> value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Kantor</label>
                                        </div>
                                        <select class="custom-select" id="inputGroupSelect01" name="office">
                                            <?php foreach ($office as $row) :  ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['office_name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <input type="hidden" value="<?= $admin['id']; ?>" name="id">
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid"><button type="submit" class="btn btn-primary btn-block">Perbarui Akun</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<?= $this->endSection(); ?>