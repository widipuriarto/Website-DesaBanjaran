<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h3 style="text-align: center;">Laporan Transaksi Desa Wisata Banjaran</h3>
    <p><strong>Periode:</strong> <?= date('d M Y', strtotime($dari)) ?> - <?= date('d M Y', strtotime($sampai)) ?></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Member</th>
                <th>Paket</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($transaksi as $t): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($t['nama_member']) ?></td>
                    <td><?= esc($t['nama_paket']) ?></td>
                    <td><?= $t['tanggal_pemesanan'] ?></td>
                    <td><?= $t['jumlah_orang'] ?></td>
                    <td>Rp <?= number_format($t['total_harga'], 0, ',', '.') ?></td>
                    <td><?= $t['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4 style="margin-top: 20px;">Total Pendapatan (Status: Diterima): Rp <?= number_format($total_diterima, 0, ',', '.') ?></h4>
</body>

</html>