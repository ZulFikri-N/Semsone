<?php
session_start();
include "koneksi.php";

if (isset($_POST['simpan'])) {
    // 1. Ambil Data dari Form
    $admin   = $_POST['admin']; // Diambil dari input hidden di order.php
    $tanggal = $_POST['tanggal'];
    
    // Ambil jumlah qty (jika kosong set ke 0)
    $cireng         = $_POST['cireng'] ?: 0;
    $dimsum_ori     = $_POST['siomay'] ?: 0; // Sesuaikan name="siomay" di order.php
    $dimsum_mentai  = $_POST['mentai'] ?: 0;
    $wonton_kuah    = $_POST['wonton_kuah'] ?: 0;
    $wonton_goreng  = $_POST['wonton_goreng'] ?: 0;
    $kopi           = $_POST['kopi'] ?: 0;
    $markisa        = $_POST['markisa'] ?: 0;

    // 2. Definisi Harga Jual & Harga Modal (Silahkan sesuaikan nominalnya)
    // Contoh Harga Jual
    $h_cireng = 3000; $h_ori = 15000; $h_mentai = 18000; 
    $h_w_kuah = 15000; $h_w_grg = 15000; $h_kopi = 12000; $h_markisa = 12000;

    // Contoh Harga Modal (HPP)
    $m_cireng = 6000; $m_ori = 8000; $m_mentai = 10000; 
    $m_w_kuah = 8000; $m_w_grg = 8000; $m_kopi = 6000; $m_markisa = 5000;

    // 3. Perhitungan Otomatis
    $omset_kotor = ($cireng * $h_cireng) + ($dimsum_ori * $h_ori) + ($dimsum_mentai * $h_mentai) + 
                   ($wonton_kuah * $h_w_kuah) + ($wonton_goreng * $h_w_grg) + 
                   ($kopi * $h_kopi) + ($markisa * $h_markisa);

    $total_modal = ($cireng * $m_cireng) + ($dimsum_ori * $m_ori) + ($dimsum_mentai * $m_mentai) + 
                   ($wonton_kuah * $m_w_kuah) + ($wonton_goreng * $m_w_grg) + 
                   ($kopi * $m_kopi) + ($markisa * $m_markisa);

    // Hitung Pajak 20% dari Omset Kotor
    $pajak = $omset_kotor * 0.20; 

    // Hitung Operasional (Misal 10% dari Omset atau sesuaikan rumus Anda)
    $operasional = $omset_kotor * 0.10;

    // Hitung Keuntungan Bersih (Laba Bersih)
    $keuntungan_bersih = $omset_kotor - $total_modal - $pajak - $operasional;

    // 4. Simpan ke Database (Tabel laporan_omset)
    $query = "INSERT INTO laporan_omset 
              (admin, tanggal, cireng, dimsum_original, dimsum_mentai, wonton_kuah, wonton_goreng, kopi_gula_aren, markisa_sprite, omset_kotor, total_modal, pajak, operasional, keuntungan_bersih) 
              VALUES 
              ('$admin', '$tanggal', '$cireng', '$dimsum_ori', '$dimsum_mentai', '$wonton_kuah', '$wonton_goreng', '$kopi', '$markisa', '$omset_kotor', '$total_modal', '$pajak', '$operasional', '$keuntungan_bersih')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Berhasil Disimpan!'); window.location='order.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>