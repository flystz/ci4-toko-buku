<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3 ">Histori Pembelian</h2>
            <a href="/dashboard" class="btn btn-danger mr-3">Kembali</a>
            <a href="/user/cetak" target="_blank" class="btn btn-success mt-2 mb-2">Cetak</a>
            <table class="table table-light table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Harga Produk</th>
                        <th scope="col">Jumlah Pembelian</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Cabang</th>
                        <th scope="col">Waktu</th>


                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php if (!count($item) == 0) : ?>
                        <?php foreach ($item as $list) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $list['name']; ?></td>
                                <td><?= $list['buyer']; ?></td>
                                <td>Rp <?= number_format($list['price'], 0, ',', '.'); ?></td>
                                <td><?= $list['quantity']; ?></td>
                                <td>Rp <?= number_format($list['price'] * $list['quantity'], 0, ',', '.'); ?></td>
                                <td><?= $list['username']; ?></td>
                                <td><?= $list['office_name']; ?></td>
                                <td><?= date_format(new DateTime($list['created_time']), "d F Y, H:i:s"); ?></td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan='9'>
                                <h3>Belum ada transaksi</h3>
                            </td>
                        </tr>
                    <?php endif ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>