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
                                <h3 class="text-center font-weight-light my-4">Tambah Kantor Cabang</h3>
                                <?php if (session()->getFlashdata('alert')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('alert'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->getFlashdata('alert-regist')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('alert-regist'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php $error = session()->get('_ci_validation_errors'); ?>
                            </div>
                            <div class="card-body">
                                <form action="/superadmin/addoffice" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="form-floating mb-3">
                                        <label for="name_office">Nama Kantor</label>
                                        <input class="form-control <?= isset($error['name_office']) ? 'is-invalid' : '' ?>" id="name_office" type="text" placeholder="nama kantor" name="name_office" value="<?= old('name_office'); ?>" />
                                        <div class="invalid-feedback">
                                            <?= isset($error['name_office']) ? $error['name_office'] : ''; ?>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="location">Lokasi</label>
                                        <input class="form-control <?= isset($error['location']) ? 'is-invalid' : '' ?>" id="location" type="text" placeholder="lokasi kantor" name="location" value="<?= old('location'); ?>" />
                                        <div class="invalid-feedback">
                                            <?= isset($error['location']) ? $error['location'] : ''; ?>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid"><button type="submit" class="btn btn-primary btn-block">Tambah</button></div>
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