<?php
include "koneksi.php";

// Pastikan ada ID yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Melakukan query hapus berdasarkan ID
    $query = mysqli_query($conn, "DELETE FROM laporan_omset WHERE id = '$id'");

    if ($query) {
        // Jika berhasil, kembali ke halaman order dengan pesan sukses
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href='order.php';
              </script>";
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($conn) . "');
                window.location.href='order.php';
              </script>";
    }
} else {
    // Jika tidak ada ID, langsung kembali ke halaman order
    header("location:order.php");
}
?>