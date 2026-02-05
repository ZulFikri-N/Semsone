<?php
session_start();
include 'koneksi.php'; 

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row['password']) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            
            // TAMBAHKAN BARIS INI:
            // Mengambil 'nama_lengkap' dari tabel users dan menyimpannya ke session
            $_SESSION['nama_lengkap'] = $row['nama_lengkap']; 
            
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Semsone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <style>
        body {
            background: linear-gradient(135deg, #f0f7ff 0%, #c9e4ff 100%);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-container {
            background: #ffffff;
            padding: 50px 40px;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 123, 255, 0.15);
            width: 100%;
            max-width: 420px;
            transition: transform 0.3s ease;
        }
        .login-container:hover {
            transform: translateY(-5px);
        }
        .logo-box {
            margin-bottom: 1px;
            text-align: center;
        }
        .logo-box img {
            height: 150px;
            width: auto;
            filter: drop-shadow(0 8px 15px rgba(0,0,0,0.1));
            transition: transform 0.3s ease;
        }
        .header-text h2 {
            color: #1976d2;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .header-text p {
            color: #778ca3;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #4b6584;
            margin-left: 5px;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 2px solid #eef2f7;
            background-color: #f8fbff;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #1976d2;
            box-shadow: none;
            background-color: #fff;
        }
        .btn-masuk {
            background: linear-gradient(to right, #1976d2, #2196f3);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-top: 10px;
            box-shadow: 0 10px 20px rgba(25, 118, 210, 0.3);
            transition: all 0.3s;
        }
        .btn-masuk:hover {
            background: linear-gradient(to right, #1565c0, #1976d2);
            transform: scale(1.02);
            box-shadow: 0 12px 25px rgba(25, 118, 210, 0.4);
        }
        .error-msg {
            background-color: #fff5f5;
            color: #eb3b5a;
            border-radius: 10px;
            padding: 10px;
            font-size: 0.8rem;
            margin-bottom: 20px;
            border: 1px solid #ffdbdb;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="logo-box">
        <img src="assets/img/logo.png" alt="Semsone Logo">
    </div>

    <div class="header-text text-center">
        <h2>Selamat Datang</h2>
        <p>Silahkan masukkan username dan password</p>
    </div>

    <?php if (isset($error)) : ?>
        <div class="error-msg text-center">
            ⚠️ Username atau Password Anda salah!
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label">USERNAME</label>
            <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        </div>
        <div class="mb-4">
            <label class="form-label">PASSWORD</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100 btn-masuk">MASUK SEKARANG</button>
    </form>
    
    <div class="text-center mt-4">
        <small class="text-muted">&copy; Semsone </small>
    </div>
</div>

</body>
</html>