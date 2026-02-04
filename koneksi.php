<?php
$host = "localhost";
$user = "root"; // Username default XAMPP
$pass = "";     // Password default XAMPP (kosong)
$db   = "semsone_db"; // GANTI dengan nama database yang kamu buat di phpMyAdmin

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>