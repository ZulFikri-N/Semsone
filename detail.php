<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Tangkap nama dari URL
$nama_produk = isset($_GET['nama']) ? $_GET['nama'] : 'Produk';

// Simulasi data biaya seperti di gambar yang kamu kirim
$data_biaya = [
    "Kopi Gula Aren" => ["harga" => "12.000", "modal" => "6.500", "pajak" => "2.400", "ops" => "1.200", "untung" => "1.900", "img" => "assets/img/kopi.jpg"],
    "Markisa Sprite" => ["harga" => "12.000", "modal" => "5.500", "pajak" => "2.400", "ops" => "1.200", "untung" => "2.900", "img" => "assets/img/markisa.jpg"],
    "Cireng Isi"     => ["harga" => "3.000", "modal" => "1.600", "pajak" => "600", "ops" => "300", "untung" => "600", "img" => "assets/img/cireng.webp"],
    "Dimsum Original" => ["harga" => "15.000", "modal" => "9.000", "pajak" => "3.000", "ops" => "1.500", "untung" => "1.500", "img" => "assets/img/dimsum.jpg"],
    "Dimsum Mentai"   => ["harga" => "18.000", "modal" => "1.500", "pajak" => "3.600", "ops" => "1.800", "untung" => "2.100", "img" => "assets/img/mentai.jpg"],
    "Wonton Kuah"     => ["harga" => "15.000", "modal" => "5.500", "pajak" => "3.000", "ops" => "1.500", "untung" => "5.000", "img" => "assets/img/kuah.avif"],
    "Wonton Goreng"   => ["harga" => "15.000", "modal" => "5.500", "pajak" => "3.000", "ops" => "1.500", "untung" => "5.000", "img" => "assets/img/goreng.jpg"]
    
];

// Ambil data spesifik atau gunakan default jika tidak ada di array
$detail = isset($data_biaya[$nama_produk]) ? $data_biaya[$nama_produk] : ["harga" => "0", "modal" => "0", "pajak" => "0", "ops" => "0", "untung" => "0", "img" => "https://via.placeholder.com/300"];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semsone | Detail <?= $nama_produk; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <style>
        body { background-color: #f0f8ff; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 0; }
        
        /* Navbar Sesuai Landing Page */
        .custom-navbar {
            background: linear-gradient(to bottom, #e3f2fd, #bbdefb) !important;
            border-bottom: 1px solid #90caf9;
            height: 80px; display: flex; align-items: center; z-index: 1050;
        }
        .navbar-brand { position: relative; width: 120px; }
        .navbar-brand img {
            height: 120px !important; position: absolute; top: -60px; left: 0; transition: 0.3s; z-index: 1100;
        }

        .btn-logout {
            background-color: #0d6efd; color: white; border: none;
            padding: 8px 20px; border-radius: 8px; font-weight: bold;
        }

        /* Layout Kartu Tengah */
        .main-content {
            display: flex; justify-content: center; align-items: center;
            min-height: calc(100vh - 80px); padding: 20px;
        }

        .card-detail-premium {
            background: white; border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            width: 100%; max-width: 400px; padding: 30px;
            text-align: center; border: 1px solid #e3f2fd;
        }

        .img-box { position: relative; margin-bottom: 25px; }
        .img-box img { width: 100%; height: auto; border-radius: 15px; }
        
        .price-tag {
            position: absolute; top: -10px; right: -10px;
            background: #1976d2; color: white;
            padding: 6px 15px; border-radius: 20px;
            font-weight: bold; box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .biaya-info { color: #636e72; font-size: 1.05rem; line-height: 2; }
        .biaya-info b { color: #2d3436; }

        .btn-back {
            margin-top: 25px; border-radius: 12px; font-weight: bold;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light custom-navbar sticky-top shadow-sm">
    <div class="container d-flex align-items-center">
        <div class="d-flex" style="flex: 1;">
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/logo.png" alt="Semsone Logo">
            </a>
        </div>

        <div class="d-flex justify-content-center" style="flex: 1;">
            <a class="nav-link fw-bold text-dark" href="index.php" style="font-size: 1.1rem; letter-spacing: 1px;">Home</a>
        </div>

        <div class="d-flex justify-content-end" style="flex: 1;">
            <a href="logout.php" class="btn btn-primary px-4 py-2 fw-bold shadow-sm" style="border-radius: 10px;">LOGOUT</a>
        </div>
    </div>
</nav>

<div class="main-content">
    <div class="card-detail-premium">
        <div class="img-box">
            <div class="price-tag">Rp <?= $detail['harga']; ?></div>
            <img src="<?= $detail['img']; ?>" alt="<?= $nama_produk; ?>" onerror="this.src='https://via.placeholder.com/300?text=Semsone'">
        </div>
        
        <h3 class="fw-bold mb-4"><?= $nama_produk; ?></h3>
        
        <div class="biaya-info">
            <div>Modal = <b>Rp.<?= $detail['modal']; ?></b></div>
            <div>Pajak 20% = <b>Rp.<?= $detail['pajak']; ?></b></div>
            <div>Operasional = <b>Rp.<?= $detail['ops']; ?></b></div>
            <div class="text-success fw-bold mt-2" style="font-size: 1.2rem;">
                Keuntungan = Rp.<?= $detail['untung']; ?>
            </div>
        </div>

        <a href="index.php" class="btn btn-outline-primary w-100 btn-back py-2">
            KEMBALI
        </a>
    </div>
</div>

<footer class="bg-dark text-white py-4 text-center">
    <p class="mb-0">&copy; Semsone.id - All Rights Reserved</p>
</footer>
</body>
</html>