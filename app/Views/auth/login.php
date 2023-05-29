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
    <div class="bg">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Login</h3>
                                        <?php $error = session()->get('_ci_validation_errors'); ?>
                                        <?php if (session()->getFlashdata('alert')) : ?>
                                            <div class="alert alert-success" role="alert">
                                                <?= session()->getFlashdata('alert'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (session()->getFlashdata('alert-login')) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= session()->getFlashdata('alert-login'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <form action="auth/check" method="post">
                                            <div class="form-floating mb-3">
                                                <label for="inputUsername ">Username</label>
                                                <input class="form-control <?= isset($error['username']) ? 'is-invalid' : '' ?>" id="inputUsername" type="text" placeholder="Admin12" name="username" value="<?= old('username'); ?>" autocomplete="off" />
                                                <div class="invalid-feedback">
                                                    <?= isset($error['username']) ? $error['username'] : ''; ?>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="inputPassword">Password</label>
                                                <input class="form-control <?= isset($error['password']) ? 'is-invalid' : '' ?>" id="inputPassword" type="password" placeholder="Password" name="password" value="<?= old('password'); ?>" />
                                                <div class="invalid-feedback">
                                                    <?= isset($error['password']) ? $error['password'] : ''; ?>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary ">Login</button>
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