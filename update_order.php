<?php
session_start();
include "koneksi.php";

if (isset($_POST['update'])) {
    $id      = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    
    // Ambil Qty (jika kosong set ke 0)
    $cireng         = $_POST['cireng'] ?: 0;
    $dimsum_ori     = $_POST['siomay'] ?: 0;
    $dimsum_mentai  = $_POST['mentai'] ?: 0;
    $wonton_kuah    = $_POST['wonton_kuah'] ?: 0;
    $wonton_goreng  = $_POST['wonton_goreng'] ?: 0;
    $kopi           = $_POST['kopi'] ?: 0;
    $markisa        = $_POST['markisa'] ?: 0;

    // --- HARGA JUAL ---
    $h_cireng = 10000; $h_ori = 15000; $h_mentai = 18000; 
    $h_w_kuah = 15000; $h_w_grg = 15000; $h_kopi = 12000; $h_markisa = 10000;

    // --- HARGA MODAL ---
    $m_cireng = 6000; $m_ori = 8000; $m_mentai = 10000; 
    $m_w_kuah = 8000; $m_w_grg = 8000; $m_kopi = 6000; $m_markisa = 5000;

    // --- PERHITUNGAN OTOMATIS ---
    $omset_kotor = ($cireng * $h_cireng) + ($dimsum_ori * $h_ori) + ($dimsum_mentai * $h_mentai) + 
                   ($wonton_kuah * $h_w_kuah) + ($wonton_goreng * $h_w_grg) + 
                   ($kopi * $h_kopi) + ($markisa * $h_markisa);

    $total_modal = ($cireng * $m_cireng) + ($dimsum_ori * $m_ori) + ($dimsum_mentai * $m_mentai) + 
                   ($wonton_kuah * $m_w_kuah) + ($wonton_goreng * $m_w_grg) + 
                   ($kopi * $m_kopi) + ($markisa * $m_markisa);

    $pajak = $omset_kotor * 0.20; 
    $operasional = $omset_kotor * 0.10;
    $keuntungan_bersih = $omset_kotor - $total_modal - $pajak - $operasional;

    // --- EKSEKUSI UPDATE ---
    $query = "UPDATE laporan_omset SET 
                tanggal = '$tanggal',
                cireng = '$cireng',
                dimsum_original = '$dimsum_ori',
                dimsum_mentai = '$dimsum_mentai',
                wonton_kuah = '$wonton_kuah',
                wonton_goreng = '$wonton_goreng',
                kopi_gula_aren = '$kopi',
                markisa_sprite = '$markisa',
                omset_kotor = '$omset_kotor',
                total_modal = '$total_modal',
                pajak = '$pajak',
                operasional = '$operasional',
                keuntungan_bersih = '$keuntungan_bersih'
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Berhasil Diupdate!'); window.location='order.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: order.php");
}
?>