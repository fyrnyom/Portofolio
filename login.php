<?php
session_start();
include 'koneksi.php';

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
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
    <title>Login Admin - Frynn</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* =========================
           LOGIN PREMIUM
        ========================= */
        body.login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background:
                radial-gradient(circle at top left, rgba(0,212,255,0.08), transparent 20%),
                radial-gradient(circle at bottom right, rgba(124,58,237,0.08), transparent 20%),
                #0a0a0c;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1080px;
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 32px;
            overflow: hidden;
            backdrop-filter: blur(18px);
            box-shadow: 0 28px 70px rgba(0,0,0,0.24);
        }

        .login-left {
            padding: 56px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: "";
            position: absolute;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(0,212,255,0.10);
            filter: blur(80px);
            top: -40px;
            left: -40px;
        }

        .login-badge {
            display: inline-flex;
            width: fit-content;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(0,212,255,0.08);
            border: 1px solid rgba(0,212,255,0.16);
            color: #00d4ff;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .login-left h1 {
            font-size: 46px;
            line-height: 1.15;
            margin-bottom: 16px;
        }

        .login-left h1 span {
            color: #00d4ff;
        }

        .login-left p {
            color: rgba(255,255,255,0.72);
            line-height: 1.9;
            max-width: 520px;
            font-size: 15px;
        }

        .login-features {
            margin-top: 28px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .login-features span {
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            font-size: 13px;
            color: rgba(255,255,255,0.78);
        }

        .login-right {
            padding: 56px 40px;
            background: rgba(255,255,255,0.02);
            border-left: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
        }

        .login-card h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .login-card p {
            color: rgba(255,255,255,0.65);
            font-size: 14px;
            margin-bottom: 28px;
            line-height: 1.7;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .login-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .login-group label {
            font-size: 14px;
            font-weight: 600;
            color: white;
        }

        .login-group input {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 16px 18px;
            color: white;
            font-size: 15px;
            outline: none;
            transition: all 0.3s ease;
        }

        .login-group input:focus {
            border-color: rgba(0,212,255,0.28);
            box-shadow: 0 0 0 4px rgba(0,212,255,0.08);
        }

        .login-btn {
            margin-top: 6px;
            width: 100%;
            border: none;
            cursor: pointer;
            padding: 15px 18px;
            border-radius: 16px;
            font-size: 15px;
            font-weight: 700;
            color: white;
            background: linear-gradient(135deg, #00d4ff, #7c3aed);
            box-shadow: 0 14px 34px rgba(0,212,255,0.18);
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 38px rgba(0,212,255,0.24);
        }

        .login-error {
            background: rgba(255,80,80,0.08);
            border: 1px solid rgba(255,80,80,0.16);
            color: #ff8a8a;
            padding: 14px 16px;
            border-radius: 16px;
            font-size: 14px;
        }

        .login-links {
            margin-top: 18px;
            display: flex;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .login-links a {
            font-size: 14px;
            color: rgba(255,255,255,0.72);
            transition: all 0.3s ease;
        }

        .login-links a:hover {
            color: #00d4ff;
        }

        @media (max-width: 900px) {
            .login-wrapper {
                grid-template-columns: 1fr;
            }

            .login-right {
                border-left: none;
                border-top: 1px solid rgba(255,255,255,0.06);
            }

            .login-left,
            .login-right {
                padding: 38px 24px;
            }

            .login-left h1 {
                font-size: 34px;
            }
        }
    </style>
</head>
<body class="login-page">

    <div class="login-wrapper">

        <!-- LEFT -->
        <div class="login-left">
            <span class="login-badge">Admin Access</span>
            <h1>Kelola Portfolio <span>FlyFrynn</span> dengan lebih profesional.</h1>
            <p>
                Masuk ke panel admin untuk menambahkan, mengedit, dan mengelola project
                yang tampil di website portfolio kamu. Semua karya terbaikmu mulai dari sini.
            </p>

            <div class="login-features">
                <span>Dashboard Modern</span>
                <span>Tambah Project</span>
                <span>Edit Project</span>
                <span>Portfolio Control</span>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="login-right">
            <div class="login-card">
                <h2>Login Admin</h2>
                <p>Masukkan username dan password untuk mengakses dashboard admin.</p>

                <?php if (!empty($error)): ?>
                    <div class="login-error"><?php echo $error; ?></div>
                    <br>
                <?php endif; ?>

                <form method="POST" class="login-form">
                    <div class="login-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan username" required>
                    </div>

                    <div class="login-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                    </div>

                    <button type="submit" name="login" class="login-btn">Masuk ke Dashboard</button>
                </form>

                <div class="login-links">
                    <a href="index.php">← Kembali ke Portfolio</a>
                    <a href="#">Secure Admin Panel</a>
                </div>
            </div>
        </div>

    </div>

</body>
</html>