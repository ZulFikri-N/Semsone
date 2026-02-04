<?php
    session_start();
    if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semsone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* --- CSS Global --- */
        body {
            background-color: #f8fbff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden; /* Mencegah scroll horizontal akibat animasi haze */
        }

        /* --- Navbar Styles (Logo Melayang & Diperbesar) --- */
        .custom-navbar {
            background: linear-gradient(to bottom, #e3f2fd, #bbdefb) !important;
            border-bottom: 1px solid #90caf9;
            height: 80px; 
            display: flex;
            align-items: center;
            z-index: 1050;
        }

        .navbar-brand {
            position: relative;
            padding: 0;
            width: 120px; 
        }

        .navbar-brand img {
            height: 120px !important; 
            width: auto;
            position: absolute; 
            top: -60px; 
            left: 0;
            transition: 0.3s ease;
            z-index: 1100;
        }

        .navbar-brand img:hover {
            transform: scale(1.1);
        }

        .navbar-nav .nav-link {
            color: #333 !important;
            font-size: 1.1rem;
        }

        .navbar-nav .nav-link:hover {
            color: #1976d2 !important;
        }

        .btn-logout {
            background-color: #2196f3;
            border-radius: 8px;
            border: none;
            transition: 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .btn-logout:hover {
            background-color: #1976d2;
            transform: translateY(-2px);
        }

        /* --- Hero Section --- */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('assets/img/bg.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 200px 0;
            color: white;
        }

        /* --- Product Card Styles --- */
        .card-product {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0,0,0,0.05);
            transition: 0.4s;
            background: #fff;
            height: 100%;
        }

        .card-product:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }

        .img-container {
            height: 250px; 
            width: 100%;
            overflow: hidden;
            background-color: #fff;
        }

        .card-product img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
        }

        .card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-size: 1.2rem;
            min-height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* --- Animasi Haze (Kabut Bergerak) --- */
        .haze-container {
            position: relative;
            width: 100%;
            height: 350px;
            background: #1976d2; /* Warna dasar biru Semsone */
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-top: 50px;
        }

        .haze-effect {
            position: absolute;
            top: 0;
            left: 0;
            width: 200%; 
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/fog.png'); 
            opacity: 0.4;
            animation: hazeMove 25s linear infinite;
            pointer-events: none;
        }

        @keyframes hazeMove {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }

        /* --- Section Tim Kami --- */
        .team-section {
            padding: 80px 0;
            background-color: #fff;
        }

        .team-card img {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 50%;
            border: 6px solid #e3f2fd;
            margin-bottom: 20px;
            transition: 0.3s;
        }
        
        .team-card:hover img {
            border-color: #1976d2;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light custom-navbar sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="assets/img/logo.png" alt="Semsone Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link px-3 fw-medium" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link px-3 fw-medium" href="#">Member</a></li>
                <li class="nav-item"><a class="nav-link px-3 fw-medium" href="#">Order</a></li>
            </ul>
            <div class="d-flex">
                <a href="logout.php" class="btn btn-logout px-4 py-2 fw-bold text-white">LOGOUT</a>
            </div>
        </div>
    </div>
</nav>

<header class="hero-section text-center text-white">
    <div class="container">
        <h1 class="display-4 fw-bold">Selamat Datang</h1>
        <p class="lead"> Disini ada Pilihan Menu Terbaik untuk Anda</p>
    </div>
</header>

<section id="produk" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold" style="color: #1976d2;">DAFTAR PRODUK</h2>
        <div class="row g-4">
        <?php
            $products = [
                ["nama" => "Kopi Gula Aren", "img" => "assets/img/kopi.jpg"],
                ["nama" => "Markisa Sprite", "img" => "assets/img/markisa.jpg"],
                ["nama" => "Cireng Isi", "img" => "assets/img/cireng.webp"],
                ["nama" => "Dimsum Original", "img" => "assets/img/dimsum.jpg"],
                ["nama" => "Dimsum Mentai", "img" => "assets/img/mentai.jpg"],
                ["nama" => "Wonton Kuah", "img" => "assets/img/kuah.avif"],
                ["nama" => "Wonton Goreng", "img" => "assets/img/goreng.jpg"]
            ];

            foreach ($products as $p) : ?>
            <div class="col-md-3 d-flex align-items-stretch">
                <div class="card card-product w-100">
                    <div class="img-container">
                        <img src="<?= $p['img']; ?>" alt="<?= $p['nama']; ?>" onerror="this.src='https://via.placeholder.com/300x300?text=No+Image'">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold text-dark mb-3"><?= $p['nama']; ?></h5>
                        <div class="mt-auto">
                            <a href="detail.php?id=..." class="btn btn-outline-primary w-100 fw-bold shadow-sm">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="team-section">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold" style="color: #1976d2;">TIM KAMI</h2>
        <div class="row text-center justify-content-center g-4">
            <div class="col-md-4 col-lg-3 team-card">
                <img src="assets/img/foto4.png" alt="Team 1" onerror="this.src='https://via.placeholder.com/150?text=Team+Semsone'">
                <h5 class="fw-bold">Dhenia Putri Nuraini</h5>
                <p class="text-muted">Ketua</p>
            </div>
            <div class="col-md-4 col-lg-3 team-card">
                <img src="assets/img/foto2.png" alt="Team 2" onerror="this.src='https://via.placeholder.com/150?text=Team+Semsone'">
                <h5 class="fw-bold">Fahridzal Nur Sidiq</h5>
                <p class="text-muted">Wakil Ketua</p>
            </div>
            <div class="col-md-4 col-lg-3 team-card">
                <img src="assets/img/foto3.png" alt="Team 3" onerror="this.src='https://via.placeholder.com/150?text=Team+Semsone'">
                <h5 class="fw-bold">Ega Silfhia</h5>
                <p class="text-muted">Sekretaris</p>
            </div>
            <div class="col-md-4 col-lg-3 team-card">
                <img src="assets/img/foto1.png" alt="Team 4" onerror="this.src='https://via.placeholder.com/150?text=Team+Semsone'">
                <h5 class="fw-bold">Zul Fikri Nugroho</h5>
                <p class="text-muted">Bendahara</p>
            </div>
        </div>
    </div>
</section>

<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p class="mb-0">&copy; Semsone.id - All Rights Reserved</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>