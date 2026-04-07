<?php
session_start();
include '../koneksi.php';

$error = '';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
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
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <div class="admin-wrapper" style="justify-content:center; align-items:center;">
        <div class="form-section" style="max-width:500px; width:100%;">
            <div class="form-header">
                <h2>Login Admin</h2>
                <p>Masuk ke dashboard untuk mengelola portfolio.</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert-error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" class="project-form">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="login" class="submit-btn">Login</button>
                    <a href="../index.php" class="cancel-btn">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>