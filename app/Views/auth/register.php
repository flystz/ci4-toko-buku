<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- my css -->
    <link rel="stylesheet" href="/css/style.css">
    <title><?= $title; ?></title>
</head>

<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Buat Akun</h3>
                                    <?php if (session()->getFlashdata('alert-regist')) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= session()->getFlashdata('alert'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php $error = session()->get('_ci_validation_errors'); ?>
                                </div>
                                <div class="card-body">
                                    <form action="/auth/create" method="post">
                                        <div class="form-floating mb-3">
                                            <label for="inputName">Name</label>
                                            <input class="form-control <?= isset($error['name']) ? 'is-invalid' : '' ?>" id="name" type="text" placeholder="Gramedia" name="name" value="<?= old('name'); ?>" />
                                            <div class="invalid-feedback">
                                                <?= isset($error['name']) ? $error['name'] : ''; ?>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="inputUsername">Username</label>
                                            <input class="form-control <?= isset($error['username']) ? 'is-invalid' : '' ?>" id="username" type="text" placeholder="vitacantik" name="username" value="<?= old('username'); ?>" />
                                            <div class="invalid-feedback">
                                                <?= isset($error['username']) ? $error['username'] : ''; ?>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="inputEmail">Email</label>
                                            <input class="form-control <?= isset($error['email']) ? 'is-invalid' : '' ?>" id="inputEmail" type="email" placeholder="name@example.com" name="email" value="<?= old('email'); ?>" />
                                            <div class="invalid-feedback">
                                                <?= isset($error['email']) ? $error['email'] : ''; ?>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Office</label>
                                            </div>
                                            <select class="custom-select" id="inputGroupSelect01">
                                                <option selected disabled>Choose...</option>
                                                <option value="superadmin">SuperAdmin</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <label for="inputPassword">Password</label>
                                                    <input class="form-control <?= isset($error['password']) ? 'is-invalid' : '' ?>" id="inputPassword" type="password" placeholder="Create a password" name="password" />
                                                    <div class="invalid-feedback">
                                                        <?= isset($error['password']) ? $error['password'] : ''; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <label for="inputPasswordConfirm">Konfirmasi Password</label>
                                                    <input class="form-control <?= isset($error['password']) ? 'is-invalid' : '' ?>" id="inputPasswordConfirm" type="password" placeholder="Confirm password" name="confirm_password" />
                                                    <div class="invalid-feedback">
                                                        <?= isset($error['confirm_password']) ? $error['confirm_password'] : ''; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button type="submit" class="btn btn-primary btn-block">Buat Akun</button></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="/">Punya Akun? Login</a></div>
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    </script>
</body>

</html>