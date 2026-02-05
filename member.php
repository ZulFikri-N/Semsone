<?php
include "koneksi.php";

if (isset($_POST['simpan_data'])) { 
    $username = $_POST['username'];
    $tanggal  = $_POST['tanggal'];
    $status   = $_POST['presensi'];

    $query = "INSERT INTO absen (username, status, tanggal) VALUES ('$username', '$status', '$tanggal')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script>alert('Data Berhasil Disimpan!'); window.location='member.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
            background-color: #f4f7f6;
        }

        .custom-navbar {
            background: linear-gradient(to bottom, #e3f2fd, #bbdefb) !important;
            height: 80px;
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            height: 110px !important;
            position: absolute;
            top: -15px; 
            left: 150px;
            z-index: 1100;
        }
        .nav-menu-text {
            position: relative;
            text-decoration: none;
            font-size: 1.25rem !important; 
            letter-spacing: 1px;
            padding: 10px 25px !important; 
            transition: all 0.3s ease;
        }
        .nav-menu-text::after {
            content: '';
            position: absolute;
            width: 0;
            height: 4px;
            bottom: -2px;
            left: 50%;
            background-color: #1976d2;
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        .nav-link.active-member::after, .nav-menu-text:hover::after {
            width: 70%;
        }
        .btn-logout {
            background-color: #2196f3;
            border: none;
            border-radius: 8px;
        }

        .main-content {
            flex: 1 0 auto; /* Mendorong footer ke bawah */
            max-width: 900px;
            margin: 40px auto;
            width: 100%;
            padding: 20px;
        }

        .card-header-purple {
            background-color: #6c63cc;
            color: white;
            text-align: center;
            font-weight: bold;
            padding: 12px;
        }
        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #ddd;
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
        }
        
        footer {
            flex-shrink: 0;
            background-color: #212529;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        @media (max-width: 768px) {
            .nav-menu-text { font-size: 1rem !important; padding: 10px 10px !important; }
            .navbar-brand img { height: 80px !important; top: -10px; left: 20px; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-light custom-navbar sticky-top shadow-sm">
    <div class="container d-flex align-items-center flex-nowrap">
        <div style="flex: 1; display: flex; justify-content: flex-start;">
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/logo.png" alt="Logo">
            </a>
        </div>
        <div style="flex: 2; display: flex; justify-content: center;">
            <ul class="nav flex-row list-unstyled mb-0">
                <li><a class="nav-link fw-bold text-dark nav-menu-text" href="index.php">Home</a></li>
                <li><a class="nav-link fw-bold text-dark nav-menu-text active-member" href="member.php">Member</a></li>
                <li><a class="nav-link fw-bold text-dark nav-menu-text" href="order.php">Order</a></li>
            </ul>
        </div>
        <div style="flex: 1; display: flex; justify-content: flex-end;">
            <a href="logout.php" class="btn btn-logout px-3 py-2 fw-bold text-white shadow-sm">LOGOUT</a>
        </div>
    </div>
</nav>

<div class="container main-content">
    <div class="card shadow-sm mb-5" style="border-radius: 10px; overflow: hidden; border: 1px solid #ddd;">
        <div class="card-header-purple">Edit Presensi Member</div>
        <div class="card-body p-4">
            <form action="" method="POST">
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 fw-bold">Username</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="username" required>
                            <option value="">-- Pilih Username --</option>
                            <option value="Dheniaa">Dheniaa</option>
                            <option value="Zul Fikri">Zul Fikri</option>
                            <option value="Fahridzal">Fahridzal</option>
                            <option value="Egaa">Ega Silfhia</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 fw-bold">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                </div>
                <div class="row mb-4 align-items-center">
                    <label class="col-sm-2 fw-bold">Presensi</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="presensi" required>
                            <option value="">-- Pilih Kehadiran --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Izin">Izin</option>
                            <option value="Alpa">Tidak Hadir</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex gap-2" style="margin-left: 16.6%;">
                    <button type="submit" name="simpan_data" class="btn btn-primary px-4 fw-bold">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-container shadow-sm">
        <div class="card-header-purple">Data Presensi</div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="text-center text-white" style="background-color: #6c63cc;">
                    <tr>
                        <th width="60">No</th>
                        <th>Username</th>
                        <th>Presensi</th>
                        <th>Tanggal</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($conn, "SELECT * FROM absen ORDER BY id DESC");
                    if(mysqli_num_rows($tampil) > 0) {
                        while($data = mysqli_fetch_array($tampil)) :
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="px-3"><?= $data['username']; ?></td>
                        <td class="text-center"><?= $data['status']; ?></td>
                        <td class="text-center"><?= $data['tanggal']; ?></td>
                    <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                            <a href="edit.php?id=<?= $data['id']; ?>" class="btn btn-info btn-sm fw-bold text-white" style="background-color: #c9d427; border: none;">
                                Edit
                            </a>
                            <a href="hapus_absen.php?id=<?= $data['id']; ?>" 
                            class="btn btn-danger btn-sm fw-bold" 
                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                            Hapus
                            </a>
                        </div>
                    </td>
                    </tr>
                    <?php 
                        endwhile; 
                    } else {
                        echo "<tr><td colspan='5' class='text-center py-3'>Belum ada data kehadiran.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <p class="mb-0">&copy; Semsone.id - All Rights Reserved</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>