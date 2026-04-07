<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $teknologi = mysqli_real_escape_string($conn, $_POST['teknologi']);

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if (!empty($gambar)) {
        move_uploaded_file($tmp, "../img/" . $gambar);

        $insert = mysqli_query($conn, "INSERT INTO projects (judul, deskripsi, gambar, teknologi)
            VALUES ('$judul', '$deskripsi', '$gambar', '$teknologi')");

        if ($insert) {
            echo "<script>alert('Project berhasil ditambahkan!'); window.location='dashboard.php';</script>";
            exit;
        } else {
            $error = "Gagal menambahkan project.";
        }
    } else {
        $error = "Gambar project wajib diupload.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Project - Frynn Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <div class="sidebar-top">
                <h2>Frynn<span>Admin</span></h2>
                <p>Portfolio Management</p>
            </div>

            <nav class="sidebar-menu">
                <a href="dashboard.php">Dashboard</a>
                <a href="tambah_project.php" class="active">Tambah Project</a>
                <a href="../index.php" target="_blank">Lihat Website</a>
                <a href="../logout.php" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="admin-main">
            <header class="topbar">
                <div>
                    <h1>Tambah Project</h1>
                    <p>Masukkan project baru agar tampil di halaman portfolio utama.</p>
                </div>
                <a href="dashboard.php" class="topbar-btn">← Kembali Dashboard</a>
            </header>

            <section class="form-section">
                <div class="form-header">
                    <h2>Form Project Baru</h2>
                    <p>Isi data project dengan lengkap dan rapi.</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert-error"><?php echo $error; ?></div>
                <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data" class="project-form">
                    <div class="form-group">
                        <label>Judul Project</label>
                        <input type="text" name="judul" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" rows="6" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Teknologi</label>
                        <input type="text" name="teknologi" required>
                        <small>Pisahkan dengan koma.</small>
                    </div>

                    <div class="form-group">
                        <label>Upload Gambar</label>
                        <input type="file" name="gambar" accept="image/*" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="submit-btn">+ Simpan Project</button>
                        <a href="dashboard.php" class="cancel-btn">Batal</a>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>

</html>