<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $teknologi = mysqli_real_escape_string($conn, $_POST['teknologi']);
    $github = mysqli_real_escape_string($conn, $_POST['github']);
    $demo = mysqli_real_escape_string($conn, $_POST['demo']);

    $gambar = '';

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $namaFile = $_FILES['gambar']['name'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ext, $allowed)) {
            $gambarBaru = time() . '_' . uniqid() . '.' . $ext;

            $uploadDir = '../img/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (move_uploaded_file($tmpName, $uploadDir . $gambarBaru)) {
                $gambar = $gambarBaru;
            } else {
                die("Gagal upload gambar ke server.");
            }
        } else {
            die("Format gambar tidak didukung. Gunakan JPG, JPEG, PNG, atau WEBP.");
        }
    }

    $query = "INSERT INTO projects (judul, deskripsi, teknologi, gambar, github, demo)
              VALUES ('$judul', '$deskripsi', '$teknologi', '$gambar', '$github', '$demo')";

    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php?success=1");
        exit;
    } else {
        echo "Gagal simpan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Project</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background: #0f172a;
            color: white;
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        .form-box {
            max-width: 700px;
            margin: auto;
            background: #111827;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
        }

        .form-box h1 {
            margin-bottom: 25px;
        }

        .form-box input,
        .form-box textarea {
            width: 100%;
            padding: 14px;
            margin-bottom: 16px;
            border: none;
            border-radius: 12px;
            background: #1e293b;
            color: white;
        }

        .form-box button {
            background: #38bdf8;
            color: #0f172a;
            border: none;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .form-box button:hover {
            opacity: 0.9;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #94a3b8;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="form-box">
        <h1>Tambah Project</h1>

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="judul" placeholder="Judul Project" required>
            <textarea name="deskripsi" placeholder="Deskripsi Project" rows="5" required></textarea>
            <input type="text" name="teknologi" placeholder="Contoh: HTML, CSS, PHP" required>
            <input type="file" name="gambar" accept="image/*" required>
            <input type="text" name="github" placeholder="Link GitHub (opsional)">
            <input type="text" name="demo" placeholder="Link Demo / Preview (opsional)">

            <button type="submit" name="submit">Simpan Project</button>
        </form>

        <a href="dashboard.php" class="back-link">← Kembali ke Dashboard</a>
    </div>

</body>

</html>