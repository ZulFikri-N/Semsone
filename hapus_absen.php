<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM absen WHERE id = '$id'";
    $hapus = mysqli_query($conn, $query);

    if ($hapus) {
        echo "<script>alert('Data Berhasil Dihapus!'); window.location='member.php';</script>";
    } else {
        echo "<script>alert('Gagal Hapus: " . mysqli_error($conn) . "'); window.location='member.php';</script>";
    }
} else {
    header("Location: member.php");
}
?>