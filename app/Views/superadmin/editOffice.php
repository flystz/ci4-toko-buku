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
                                <h3 class="text-center font-weight-light my-4">Perbarui Kantor</h3>
                                <?php $error = session()->get('_ci_validation_errors'); ?>
                            </div>
                            <div class="card-body">
                                <form action="/superadmin/update-office" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="form-floating mb-3">
                                        <label for="name_office">Nama Lantor</label>
                                        <input class="form-control <?= isset($error['office_name']) ? 'is-invalid' : '' ?>" id="name_office" type="text" placeholder="nama kantor cabang" name="name_office" autocomplete="off" value="<?= $office['office_name'] ?>" />
                                        <div class="invalid-feedback">
                                            <?= isset($error['office_name']) ? $error['office_name'] : ''; ?>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="location">Lokasi</label>
                                        <input class="form-control <?= isset($error['location']) ? 'is-invalid' : '' ?>" id="location" type="text" placeholder="Lokasi Cabang" name="location" value="<?= $office['location'] ?>" autocomplete="off" />
                                        <div class="invalid-feedback">
                                            <?= isset($error['location']) ? $error['location'] : ''; ?>
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?= $office['id']; ?>" name="id">
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid"><button type="submit" class="btn btn-primary btn-block">Perbarui</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?= $this->endSection(); ?>