<?php 
include "koneksi.php"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Semsone</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h2 { text-decoration: underline; text-transform: uppercase; margin: 0; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; }
        th { background-color: #f2f2f2; padding: 10px; font-size: 12px; }
        td { padding: 8px; font-size: 11px; text-align: center; }
        
        .text-end { text-align: right; }
        .keuntungan { color: green; font-weight: bold; }
        
        @media print {
            .no-print { display: none; }
            @page { size: landscape; margin: 1cm; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>Laporan Rincian Laba Rugi Semsone</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Admin</th>
                <th>Tanggal</th>
                <th>Dms Ori</th>
                <th>Dms Mnt</th>
                <th>Wnt Kuah</th>
                <th>Wnt Grg</th>
                <th>Cireng</th>
                <th>Kopi Aren</th>
                <th>Markisa</th>
                <th>Omset Kotor</th>
                <th>Total Modal</th>
                <th>Pajak (20%)</th>
                <th>Operasional</th>
                <th>Laba Bersih</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Memanggil data sesuai urutan kolom di database Anda
            $query = mysqli_query($conn, "SELECT * FROM laporan_omset ORDER BY tanggal DESC");
            while($row = mysqli_fetch_array($query)): 
            ?>
            <tr>
                <td><?= $row['admin']; ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td><?= $row['dimsum_original']; ?></td>
                <td><?= $row['dimsum_mentai']; ?></td>
                <td><?= $row['wonton_kuah']; ?></td>
                <td><?= $row['wonton_goreng']; ?></td>
                <td><?= $row['cireng']; ?></td>
                <td><?= $row['kopi_gula_aren']; ?></td>
                <td><?= $row['markisa_sprite']; ?></td>
                <td class="text-end">Rp <?= number_format($row['omset_kotor'], 0, ',', '.'); ?></td>
                <td class="text-end">Rp <?= number_format($row['total_modal'], 0, ',', '.'); ?></td>
                <td class="text-end">Rp <?= number_format($row['pajak'], 0, ',', '.'); ?></td>
                <td class="text-end">Rp <?= number_format($row['operasional'], 0, ',', '.'); ?></td>
                <td class="text-end keuntungan">Rp <?= number_format($row['keuntungan_bersih'], 0, ',', '.'); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="no-print" style="margin-top: 20px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer;">Print Sekarang</button>
        <button onclick="window.close()" style="padding: 10px 20px; cursor: pointer;">Tutup</button>
    </div>

</body>
</html>