<?php
session_start();
include "koneksi.php";

// Pastikan ID ada di URL
if (!isset($_GET['id'])) {
    header("Location: order.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM laporan_omset WHERE id = '$id'");
$row = mysqli_fetch_array($data);

// Jika data tidak ditemukan
if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Omset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8fbff; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; font-family: 'Segoe UI', sans-serif; }
        .edit-card { background: white; width: 100%; max-width: 600px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e0e0e0; }
        .card-header-cyan { background-color: #4dd0e1; color: white; text-align: center; padding: 15px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .card-body { padding: 30px; }
        .form-label { font-weight: 500; color: #444; margin-bottom: 5px; }
        .form-control { border: 1px solid #ced4da; padding: 10px; border-radius: 6px; }
        .btn-update { background-color: #4dd0e1; border: none; color: white; font-weight: bold; padding: 12px 30px; border-radius: 8px; transition: 0.3s; }
        .btn-update:hover { background-color: #26c6da; transform: translateY(-2px); }
        .btn-batal { background-color: #6c757d; border: none; color: white; font-weight: bold; padding: 12px 30px; border-radius: 8px; text-decoration: none; display: inline-block; text-align: center; }
    </style>
</head>
<body>

<div class="edit-card">
    <div class="card-header-cyan">EDIT DATA OMSET</div>
    <div class="card-body">
        <form action="update_order.php" method="POST">
            <input type="hidden" name="id" value="<?= $row['id']; ?>">

            <div class="row g-3">
                <div class="col-12 mb-2">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal']; ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Cireng</label>
                    <input type="number" name="cireng" class="form-control" value="<?= $row['cireng']; ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Dimsum Original</label>
                    <input type="number" name="siomay" class="form-control" value="<?= $row['dimsum_original']; ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Dimsum Mentai</label>
                    <input type="number" name="mentai" class="form-control" value="<?= $row['dimsum_mentai']; ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Wonton Kuah</label>
                    <input type="number" name="wonton_kuah" class="form-control" value="<?= $row['wonton_kuah']; ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Wonton Goreng</label>
                    <input type="number" name="wonton_goreng" class="form-control" value="<?= $row['wonton_goreng']; ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kopi Gula Aren</label>
                    <input type="number" name="kopi" class="form-control" value="<?= $row['kopi_gula_aren']; ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Markisa Sprite</label>
                    <input type="number" name="markisa" class="form-control" value="<?= $row['markisa_sprite']; ?>">
                </div>

                <div class="col-12 text-center mt-4 d-flex justify-content-center gap-2">
                    <button type="submit" name="update" class="btn btn-update">Update Data</button>
                    <a href="order.php" class="btn btn-batal">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>