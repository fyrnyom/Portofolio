<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM projects WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['submit'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $teknologi = mysqli_real_escape_string($conn, $_POST['teknologi']);

    $gambarBaru = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if (!empty($gambarBaru)) {
        move_uploaded_file($tmp, "../img/" . $gambarBaru);
        $gambarUpdate = $gambarBaru;
    } else {
        $gambarUpdate = $data['gambar'];
    }

    $update = mysqli_query($conn, "UPDATE projects SET
        judul = '$judul',
        deskripsi = '$deskripsi',
        gambar = '$gambarUpdate',
        teknologi = '$teknologi'
        WHERE id = $id
    ");

    if ($update) {
        echo "<script>alert('Project berhasil diupdate!'); window.location='dashboard.php';</script>";
        exit;
    } else {
        $error = "Gagal mengupdate project.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - Frynn Admin</title>
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
                <a href="tambah_project.php">Tambah Project</a>
                <a href="../index.php" target="_blank">Lihat Website</a>
                <a href="../logout.php" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="admin-main">
            <header class="topbar">
                <div>
                    <h1>Edit Project</h1>
                    <p>Perbarui informasi project agar portfolio tetap rapi.</p>
                </div>
                <a href="dashboard.php" class="topbar-btn">← Kembali Dashboard</a>
            </header>

            <section class="form-section">
                <div class="form-header">
                    <h2>Form Edit Project</h2>
                    <p>Ubah data project sesuai kebutuhan.</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert-error"><?php echo $error; ?></div>
                <?php endif; ?>

                <div class="current-image-box">
                    <p class="current-image-label">Gambar Saat Ini</p>
                    <img src="../img/<?php echo htmlspecialchars($data['gambar']); ?>" class="current-project-image">
                </div>

                <form action="" method="POST" enctype="multipart/form-data" class="project-form">
                    <div class="form-group">
                        <label>Judul Project</label>
                        <input type="text" name="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" rows="6" required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Teknologi</label>
                        <input type="text" name="teknologi" value="<?php echo htmlspecialchars($data['teknologi']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Ganti Gambar (Opsional)</label>
                        <input type="file" name="gambar" accept="image/*">
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="submit-btn">Update Project</button>
                        <a href="dashboard.php" class="cancel-btn">Batal</a>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>

</html>