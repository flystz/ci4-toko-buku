<!-- As a heading -->
<nav class="navbar bg-primary bg-gradient">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1 text-white p-3 fs2 "><img src="/img/book.png" width="50" alt=""><b><a href="/dashboard" class="text-white resto">BOOK_STORE</a></b></span>
        <div>
            <?php if (session()->get('account')['role'] == 'superadmin') : ?>
                <a href="/superadmin/manage" class="btn btn-light mr-2">Akun</a>
            <?php endif ?>
            <a href="/user/histori" class="btn btn-warning text-white ml-2 mr-2">Riwayat</a>
            <a href="/logout" class="btn btn-danger ml-2">Keluar</a>
        </div>

    </div>
</nav>