<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h3 class="mt-4"><b>List Admin</b></h3>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <table class="table mt-3">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Cabang</th>
                <th scope="col">Role</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php if (!count($list) == 0) : ?>
                <?php foreach ($list as $admin) : ?>
                    <?php if ($admin['role'] != 'superadmin') : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $admin['name']; ?></td>
                            <td><?= $admin['username']; ?></td>
                            <td><?= $admin['email']; ?></td>
                            <td><?= $admin['office_name']; ?></td>
                            <td><?= $admin['role']; ?></td>
                            <td>
                                <a href="/superadmin/edit-admin/<?= $admin['id']; ?>" class="btn btn-warning text-white">Edit</a>
                                <a href="/superadmin/delete-admin/<?= $admin['id']; ?>" class="btn btn-danger mr-2" onclick="return confirm('Yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endif ?>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">
                        <h3>Belum ada admin</h3>
                    </td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>