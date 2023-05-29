<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h3 class="mt-4"><b>List Admin</b></h3>
    <a href="/superadmin/add-office" class="btn btn-primary">[+] Add Kantor Cabang</a>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <table class="table mt-3">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name Kantor</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php if (!count($list) == 0) : ?>
                <?php foreach ($list as $office) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $office['office_name']; ?></td>
                        <td><?= $office['location']; ?></td>
                        <td>
                            <a href="/superadmin/edit-office/<?= $office['id']; ?>" class="btn btn-dark text-white">Edit</a>
                            <a href="/superadmin/delete-office/<?= $office['id']; ?>" class="btn btn-danger mr-2" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">
                        <h3>Belum ada data kantor</h3>
                    </td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>