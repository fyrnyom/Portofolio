<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

$success = "";
$error = "";

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if ($gambar != "") {
        $folder = "../uploads/" . $gambar;

        if (move_uploaded_file($tmp, $folder)) {
            $query = mysqli_query($conn, "INSERT INTO project (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$gambar')");

            if ($query) {
                $success = "Project berhasil ditambahkan!";
            } else {
                $error = "Gagal menyimpan ke database.";
            }
        } else {
            $error = "Gagal upload gambar.";
        }
    } else {
        $error = "Gambar wajib diupload.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Project | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #0a0a0c;
            color: white;
            font-family: 'Segoe UI', sans-serif;
        }

        .glass-box {
            max-width: 750px;
            margin: 60px auto;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(18px);
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 20px 40px rgba(0, 210, 255, 0.08);
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

        textarea.form-control {
            min-height: 160px;
        }

        .btn-custom {
            border-radius: 14px;
            font-weight: 600;
            padding: 10px 18px;
        }

        h2 span {
            color: #00d2ff;
        }
    </style>
</head>
<body>
    <div class="glass-box">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2>Tambah<span>Project</span></h2>
                <p class="text-secondary mb-0">Tambahkan project baru ke website portofolio.</p>
            </div>
            <a href="project.php" class="btn btn-outline-light btn-custom">← Kembali</a>
        </div>

        <?php if ($success != ""): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if ($error != ""): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="mb-2">Judul Project</label>
                <input type="text" name="judul" class="form-control" placeholder="Masukkan judul project" required>
            </div>

            <div class="mb-3">
                <label class="mb-2">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" placeholder="Masukkan deskripsi project" required></textarea>
            </div>

            <div class="mb-4">
                <label class="mb-2">Upload Gambar</label>
                <input type="file" name="gambar" class="form-control" required>
            </div>

            <button type="submit" name="simpan" class="btn btn-info btn-custom">Simpan Project</button>
        </form>
    </div>
</body>
</html>