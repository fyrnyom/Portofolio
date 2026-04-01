<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM project ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Project | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #0a0a0c;
            color: white;
            font-family: 'Segoe UI', sans-serif;
        }

        .glass-box {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(18px);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 20px 40px rgba(0, 210, 255, 0.08);
        }

        .top-title {
            font-size: 2rem;
            font-weight: 800;
        }

        .top-title span {
            color: #00d2ff;
        }

        .btn-custom {
            border-radius: 14px;
            font-weight: 600;
            padding: 10px 18px;
        }

        .table-dark-custom {
            width: 100%;
            border-collapse: collapse;
        }

        .table-dark-custom th,
        .table-dark-custom td {
            padding: 14px 12px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            vertical-align: middle;
        }

        .table-dark-custom th {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        .table-dark-custom img {
            width: 90px;
            height: 60px;
            object-fit: cover;
            border-radius: 12px;
        }

        .badge-soft {
            background: rgba(0, 210, 255, 0.08);
            color: #00d2ff;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 600;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="glass-box">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <h1 class="top-title">Kelola<span>Project</span></h1>
                    <p class="text-secondary mb-0">Daftar semua project yang tampil di website portofolio.</p>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="dashboard.php" class="btn btn-outline-light btn-custom">
                        <i class="fas fa-arrow-left"></i> Dashboard
                    </a>
                    <a href="tambah_project.php" class="btn btn-info btn-custom">
                        <i class="fas fa-plus"></i> Tambah Project
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($data) > 0): ?>
                            <?php $no = 1; while($row = mysqli_fetch_assoc($data)): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>
                                        <img src="../uploads/<?php echo $row['gambar']; ?>" alt="project">
                                    </td>
                                    <td><?php echo $row['judul']; ?></td>
                                    <td><?php echo substr($row['deskripsi'], 0, 80); ?>...</td>
                                    <td><span class="badge-soft">Tampil</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">Belum ada project.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>