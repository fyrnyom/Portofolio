<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
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

    $gambarUpdate = $data['gambar'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $gambarBaru = time() . '_' . basename($_FILES['gambar']['name']);
        $tmp = $_FILES['gambar']['tmp_name'];
        $target = "../uploads/" . $gambarBaru;

        if (move_uploaded_file($tmp, $target)) {
            if (!empty($data['gambar']) && file_exists("../uploads/" . $data['gambar'])) {
                unlink("../uploads/" . $data['gambar']);
            }
            $gambarUpdate = $gambarBaru;
        }
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
                    <p>Perbarui informasi project agar portfolio kamu tetap rapi dan up to date.</p>
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
                    <img src="../uploads/<?php echo htmlspecialchars($data['gambar']); ?>" alt="<?php echo htmlspecialchars($data['judul']); ?>" class="current-project-image">
                </div>

                <form action="" method="POST" enctype="multipart/form-data" class="project-form">
                    <div class="form-group">
                        <label for="judul">Judul Project</label>
                        <input type="text" name="judul" id="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="6" required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="teknologi">Teknologi</label>
                        <input type="text" name="teknologi" id="teknologi" value="<?php echo htmlspecialchars($data['teknologi']); ?>" required>
                        <small>Pisahkan beberapa teknologi dengan koma.</small>
                    </div>

                    <div class="form-group">
                        <label for="gambar">Ganti Gambar (Opsional)</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*">
                        <small>Kosongkan jika tidak ingin mengganti gambar project.</small>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="submit-btn">💾 Update Project</button>
                        <a href="dashboard.php" class="cancel-btn">Batal</a>
                    </div>
                </form>
            </section>

        </main>
    </div>

</body>

</html>