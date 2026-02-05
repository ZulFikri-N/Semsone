<?php 
session_start(); 
include "koneksi.php"; 
// Mengambil nama lengkap dari session login
$admin_login = $_SESSION['nama_lengkap']; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <style>
        /* CSS Anda tetap sama sesuai permintaan, tidak ada yang dirubah */
        body { background-color: #f8fbff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; }
        .nav-menu-text { position: relative; text-decoration: none; font-size: 1.25rem !important; letter-spacing: 1px; padding: 10px 25px !important; transition: all 0.3s ease; display: inline-block; }
        .nav-menu-text::after { content: ''; position: absolute; width: 0; height: 4px; bottom: -2px; left: 50%; background-color: #1976d2; transition: all 0.3s ease; transform: translateX(-50%); border-radius: 2px; }
        .nav-menu-text:hover::after, .nav-menu-text:active::after { width: 70%; }
        .nav-menu-text:hover, .nav-menu-text:active { color: #1976d2 !important; }
        @media (max-width: 576px) { .nav-menu-text { font-size: 1rem !important; padding: 8px 12px !important; letter-spacing: 0; } }
        .nav-link:focus { outline: none; box-shadow: none; }
        .custom-navbar { background: linear-gradient(to bottom, #e3f2fd, #bbdefb) !important; border-bottom: 1px solid #90caf9; height: 80px; display: flex; align-items: center; overflow: visible; }
        .navbar-brand { position: relative; padding: 0; width: 120px; }
        .navbar-brand img { height: 120px !important; width: auto; position: absolute; top: -60px; left: 0; transition: 0.3s ease; z-index: 1100; }
        .navbar-brand img:hover { transform: scale(1.1); }
        .navbar-nav .nav-link { color: #333 !important; font-size: 1.1rem; }
        .navbar-nav .nav-link:hover { color: #1976d2 !important; }
        @media (max-width: 768px) { .nav-menu-text { font-size: 0.85rem !important; padding-left: 8px !important; padding-right: 8px !important; } .navbar-brand img { height: 80px !important; top: -35px; } .btn-logout { font-size: 0.75rem !important; padding: 5px 12px !important; } }
        .btn-logout { background-color: #2196f3; border-radius: 8px; border: none; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-logout:hover { background-color: #1976d2; transform: translateY(-2px); }
        .main-content { flex: 1 0 auto; max-width: 1200px; margin: 40px auto; width: 100%; padding: 0 20px; }
        .card-header-purple { background-color: #6c63cc; color: white; font-weight: bold; text-align: center; padding: 12px; border-radius: 8px 8px 0 0; }
        .table-custom { font-size: 13px; vertical-align: middle; border-radius: 8px; overflow: hidden; }
        .table-custom thead th { background-color: #4dd0e1; color: white; border: none; text-align: center; padding: 12px; }
        .table-custom tbody td { background: white; border-bottom: 1px solid #eee; padding: 10px; }
    </style>
</head>
<body>

<nav class="navbar navbar-light custom-navbar sticky-top shadow-sm">
    <div class="container d-flex align-items-center flex-nowrap">
        <div style="flex: 1; display: flex; justify-content: flex-start;">
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/logo.png" alt="Semsone Logo">
            </a>
        </div>
        <div style="flex: 2; display: flex; justify-content: center;">
            <ul class="nav flex-row list-unstyled mb-0">
                <li><a class="nav-link fw-bold text-dark nav-menu-text" href="index.php">Home</a></li>
                <li><a class="nav-link fw-bold text-dark nav-menu-text" href="member.php">Member</a></li>
                <li><a class="nav-link fw-bold text-dark nav-menu-text" href="order.php">Order</a></li>
            </ul>
        </div>
        <div style="flex: 1; display: flex; justify-content: flex-end;">
            <a href="logout.php" class="btn btn-logout px-3 py-1 py-md-2 fw-bold text-white shadow-sm">LOGOUT</a>
        </div>
    </div>
</nav>

<div class="container main-content">
    <div class="card shadow-sm mb-5 border-0" style="border-radius: 8px;">
        <div class="card-header-purple">INPUT PENJUALAN HARIAN</div>
        <div class="card-body p-4">
            <form action="proses_order.php" method="POST">
                <input type="hidden" name="admin" value="<?= $admin_login; ?>">

                <div class="row g-3">
                    <div class="col-md-12"><label class="fw-bold text-muted">Tanggal</label><input type="date" name="tanggal" class="form-control" required></div>
                    <div class="col-md-3"><label class="fw-bold text-muted">Cireng</label><input type="number" name="cireng" class="form-control" value="0"></div>
                    <div class="col-md-3"><label class="fw-bold text-muted">Dimsum Original</label><input type="number" name="siomay" class="form-control" value="0"></div>
                    <div class="col-md-3"><label class="fw-bold text-muted">Dimsum Mentai</label><input type="number" name="mentai" class="form-control" value="0"></div>
                    <div class="col-md-3"><label class="fw-bold text-muted">Wonton Kuah</label><input type="number" name="wonton_kuah" class="form-control" value="0"></div>
                    <div class="col-md-3"><label class="fw-bold text-muted">Wonton Goreng</label><input type="number" name="wonton_goreng" class="form-control" value="0"></div>
                    <div class="col-md-3"><label class="fw-bold text-muted">Kopi Gula Aren</label><input type="number" name="kopi" class="form-control" value="0"></div>
                    <div class="col-md-3"><label class="fw-bold text-muted">Markisa Sprite</label><input type="number" name="markisa" class="form-control" value="0"></div>
                    <div class="col-12 mt-4 d-flex gap-2">
                        <button type="submit" name="simpan" class="btn btn-primary fw-bold px-4">Simpan Data</button>
                        <a href="cetak.php" target="_blank" class="btn btn-success fw-bold px-4">Cetak Omset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-custom text-center mb-0" id="tabelDataOrder">
            <thead>
                <tr>
                    <th>Admin</th>
                    <th>Tanggal</th>
                    <th>Dimsum Original</th>
                    <th>Dimsum Mentai</th>
                    <th>Wonton Kuah</th>
                    <th>Wonton Goreng</th>
                    <th>Cireng</th>
                    <th>Kopi Gula Aren</th>
                    <th>Markisa Sprite</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM laporan_omset ORDER BY id DESC");
                while($row = mysqli_fetch_array($query)): ?>
                <tr>
                    <td class="fw-bold"><?= $row['admin']; ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td><?= $row['dimsum_original']; ?></td> 
                    <td><?= $row['dimsum_mentai']; ?></td>
                    <td><?= $row['wonton_kuah']; ?></td>
                    <td><?= $row['wonton_goreng']; ?></td>
                    <td><?= $row['cireng']; ?></td>
                    <td><?= $row['kopi_gula_aren']; ?></td>
                    <td><?= $row['markisa_sprite']; ?></td>
                    <td>
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="edit_order.php?id=<?= $row['id']; ?>" class="btn btn-edit btn-sm" style="background-color: #c9d427; border: none; color: white;">Edit</a>
                            <a href="hapus_order.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>