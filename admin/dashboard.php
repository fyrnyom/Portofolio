<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM projects ORDER BY id DESC");
$totalProject = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM projects"));
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Frynn</title>
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
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="tambah_project.php">Tambah Project</a>
                <a href="../index.php" target="_blank">Lihat Website</a>
                <a href="../logout.php" class="logout-link">Logout</a>
            </nav>
        </aside>

        <main class="admin-main">
            <header class="topbar">
                <div>
                    <h1>Dashboard Admin</h1>
                    <p>Kelola project portfolio kamu dengan lebih rapi dan profesional.</p>
                </div>
                <a href="tambah_project.php" class="topbar-btn">+ Tambah Project</a>
            </header>

            <section class="stats-grid">
                <div class="stat-card">
                    <h3>Total Project</h3>
                    <p><?php echo $totalProject; ?></p>
                </div>

                <div class="stat-card">
                    <h3>Status</h3>
                    <p>Aktif</p>
                </div>

                <div class="stat-card">
                    <h3>Portfolio</h3>
                    <p>Online</p>
                </div>
            </section>

            <section class="table-section">
                <div class="table-header">
                    <h2>Daftar Project</h2>
                    <p>Semua project yang tampil di halaman portfolio.</p>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Teknologi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($query) > 0): ?>
                                <?php $no = 1; ?>
                                <?php while ($data = mysqli_fetch_assoc($query)): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td>
                                            <img src="../img/<?php echo htmlspecialchars($data['gambar']); ?>" class="table-img">
                                        </td>
                                        <td class="judul-cell"><?php echo htmlspecialchars($data['judul']); ?></td>
                                        <td class="deskripsi-cell"><?php echo htmlspecialchars($data['deskripsi']); ?></td>
                                        <td><?php echo htmlspecialchars($data['teknologi']); ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="edit_project.php?id=<?php echo $data['id']; ?>" class="edit-btn">Edit</a>
                                                <a href="hapus_project.php?id=<?php echo $data['id']; ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus project ini?')">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="empty-row">Belum ada project.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>

</html>