<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['admin'])) {
    header("Location: admin/dashboard.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $_SESSION['admin'] = $username;
        header("Location: admin/dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Portofolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #0a0a0c;
            color: white;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(18px);
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 20px 40px rgba(0, 210, 255, 0.08);
        }

        .login-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .login-title span {
            color: #00d2ff;
        }

        .text-soft {
            color: #9ca3af;
        }

        .form-control {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            color: white;
            border-radius: 14px;
            padding: 12px 15px;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.06);
            color: white;
            border-color: #00d2ff;
            box-shadow: none;
        }

        .btn-login {
            background: #00d2ff;
            color: black;
            font-weight: 700;
            border-radius: 14px;
            padding: 12px;
            border: none;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
        }

        .alert-custom {
            background: rgba(255, 0, 0, 0.08);
            border: 1px solid rgba(255, 0, 0, 0.15);
            color: #ff7b7b;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1 class="login-title">Admin<span>Login</span></h1>
        <p class="text-soft mb-4">Masuk untuk mengelola isi website portofolio.</p>

        <?php if ($error != ""): ?>
            <div class="alert-custom mb-3"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="mb-2">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>

            <div class="mb-4">
                <label class="mb-2">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" name="login" class="btn btn-login w-100">Masuk ke Dashboard</button>
        </form>
    </div>
</body>
</html>