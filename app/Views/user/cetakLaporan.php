<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengeluaran</title>

    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        header,
        main {
            padding: 50px 50px 0 50px;
        }

        header .line {
            margin-top: 5px;
            height: 2px;
            width: 100%;
            border-radius: 10px;
            background-color: black;
        }

        header .line2 {
            margin-top: 2px;
            height: 2px;
            width: 100%;
            border-radius: 10px;
            background-color: black;
        }

        .data-table {
            border-collapse: collapse;
            width: 100%;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .data-table th {
            background-color: #424242;
            color: white;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #B2B2B2;
        }

        main h2 {
            text-align: center;
        }

        .keterangan-table tr td {
            padding-right: 7px;
        }

        header .quotes {
            margin-bottom: 12px;
        }

        header .alamat {
            width: 400px;
        }
    </style>
</head>

<body>
    <header>
        <h2>BOOK_STORE</h2>
        <p class="quotes"><i>Pentingnya buku bagi kehidupan</i></p>
        <div class="alamat">
            <p><b><?= $cabang['location']; ?></b></p>
        </div>
        <div class="line"></div>
        <div class="line2"></div>
    </header>
    <main>
        <h2>Laporan Pengeluaran Barang</h2>
        <br>
        <div>
            <table class="keterangan-table">
                <tr>
                    <td>Dicetak Oleh</td>
                    <td>:</td>
                    <td><?= session()->get('account')['name']; ?></td>
                </tr>
                <tr>
                    <td>Nama Kantor</td>
                    <td>:</td>
                    <td><?= $cabang['office_name']; ?></td>
                </tr>
                <tr>
                    <td>Waktu</td>
                    <td>:</td>
                    <td><?= date('d F Y  H:i:s'); ?></td>
                </tr>
            </table>
            <!-- <p>Dicetak Oleh : </p>
            <p>Waktu : </p> -->
        </div>
        <br>
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>Jumlah Pembelian</th>
                    <th>Subtotal</th>
                    <th>admin</th>
                    <th>Kantor Cabang</th>
                    <th>Waktu Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($data as $row) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row['buyer']; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td>Rp <?= number_format($row['price'], 0, ',', '.'); ?></td>
                        <td><?= $row['quantity']; ?></td>
                        <td>Rp <?= number_format($row['price'] * $row['quantity'], 0, ',', '.'); ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['office_name']; ?></td>
                        <td><?= date_format(new DateTime($row['created_time']), "d F Y, H:i:s"); ?></td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </main>
</body>

</html>