<?php
include "koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM absen WHERE id = '$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update_status'])) {
    $status = $_POST['presensi'];

    $update = mysqli_query($conn, "UPDATE absen SET status = '$status' WHERE id = '$id'");

    if ($update) {
        echo "<script>alert('Status Kehadiran Berhasil Diperbarui!'); window.location='member.php';</script>";
    } else {
        echo "Gagal Update: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kehadiran - Semsone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .card-header-blue {
            background-color: #4dd0e1; 
            color: white;
            text-align: center;
            font-weight: bold;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }
        .btn-update {
            background-color: #4dd0e1;
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-update:hover { background-color: #26c6da; color: white; }
    </style>
</head>
<body>
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card shadow-sm" style="border-radius: 10px;">
            <div class="card-header-blue">Edit Kehadiran Member</div>
            <div class="card-body p-4">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="fw-bold text-muted">Username</label>
                        <input type="text" class="form-control bg-light" value="<?= $data['username']; ?>" readonly>
                        <small class="text-muted">*Username tidak dapat diubah</small>
                    </div>
                    
                    <div class="mb-4">
                        <label class="fw-bold">Pilih Kehadiran Baru</label>
                        <select class="form-select" name="presensi" required>
                            <option value="Hadir" <?= ($data['status'] == 'Hadir') ? 'selected' : ''; ?>>Hadir</option>
                            <option value="Sakit" <?= ($data['status'] == 'Sakit') ? 'selected' : ''; ?>>Sakit</option>
                            <option value="Izin" <?= ($data['status'] == 'Izin') ? 'selected' : ''; ?>>Izin</option>
                            <option value="Alpa" <?= ($data['status'] == 'Alpa') ? 'selected' : ''; ?>>Alpa</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="update_status" class="btn btn-update">Simpan Perubahan</button>
                        <a href="member.php" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>