<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

// Hitung jumlah project
$totalProject = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project"));
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Portofolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0a0a0c;
            --bg-soft: #111217;
            --primary: #00d2ff;
            --text-soft: #9ca3af;
            --glass: rgba(255, 255, 255, 0.04);
            --border: rgba(255, 255, 255, 0.08);
            --shadow: 0 20px 40px rgba(0, 210, 255, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-dark);
            color: white;
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        .sidebar {
            min-height: 100vh;
            background: rgba(255, 255, 255, 0.03);
            border-right: 1px solid var(--border);
            padding: 30px 20px;
            position: sticky;
            top: 0;
        }

        .logo {
            font-size: 1.7rem;
            font-weight: 800;
            margin-bottom: 35px;
        }

        .logo span {
            color: var(--primary);
        }

        .menu-title {
            font-size: 0.8rem;
            color: var(--text-soft);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d1d5db;
            text-decoration: none;
            padding: 13px 16px;
            border-radius: 14px;
            margin-bottom: 12px;
            transition: 0.3s ease;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(0, 210, 255, 0.08);
            color: var(--primary);
            transform: translateX(4px);
        }

        .main-content {
            padding: 30px;
        }

        .topbar {
            background: var(--glass);
            border: 1px solid var(--border);
            backdrop-filter: blur(18px);
            border-radius: 24px;
            padding: 20px 24px;
            box-shadow: var(--shadow);
            margin-bottom: 28px;
        }

        .topbar h2 {
            font-weight: 800;
            margin-bottom: 6px;
        }

        .topbar p {
            color: var(--text-soft);
            margin-bottom: 0;
        }

        .glass-card {
            background: var(--glass);
            border: 1px solid var(--border);
            backdrop-filter: blur(18px);
            border-radius: 24px;
            padding: 26px;
            box-shadow: var(--shadow);
            height: 100%;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card .icon {
            width: 55px;
            height: 55px;
            border-radius: 16px;
            background: rgba(0, 210, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.3rem;
            margin-bottom: 18px;
        }

        .stat-card h6 {
            color: var(--text-soft);
            margin-bottom: 8px;
        }

        .stat-card h3 {
            font-size: 2rem;
            font-weight: 800;
        }

        .quick-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px;
            border-radius: 16px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s ease;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.03);
            color: white;
        }

        .quick-btn:hover {
            background: rgba(0, 210, 255, 0.08);
            color: var(--primary);
            transform: translateY(-3px);
        }

        .table-dark-custom {
            width: 100%;
            border-collapse: collapse;
        }

        .table-dark-custom th,
        .table-dark-custom td {
            padding: 14px 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            text-align: left;
        }

        .table-dark-custom th {
            color: var(--text-soft);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .table-dark-custom td {
            color: #f3f4f6;
        }

        .status-badge {
            display: inline-block;
            padding: 7px 14px;
            border-radius: 999px;
            background: rgba(34, 197, 94, 0.12);
            color: #22c55e;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .logout-btn {
            background: rgba(255, 75, 75, 0.12);
            color: #ff6b6b !important;
        }

        .logout-btn:hover {
            background: rgba(255, 75, 75, 0.2) !important;
            color: #ff6b6b !important;
        }

        .small-soft {
            color: var(--text-soft);
            font-size: 0.92rem;
        }

        @media (max-width: 992px) {
            .sidebar {
                min-height: auto;
                position: static;
                border-right: none;
                border-bottom: 1px solid var(--border);
            }

            .main-content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-lg-2 sidebar">
                <div class="logo">Admin<span>Panel</span></div>

                <div class="menu-title">Menu Utama</div>
                <a href="dashboard.php" class="active"><i class="fas fa-house"></i> Dashboard</a>
                <a href="project.php"><i class="fas fa-folder-open"></i> Kelola Project</a>
                <a href="#"><i class="fas fa-user-pen"></i> Edit Profil</a>
                <a href="../index.php" target="_blank"><i class="fas fa-globe"></i> Lihat Website</a>

                <div class="menu-title mt-4">Akun</div>
                <a href="../logout.php" class="logout-btn"><i class="fas fa-right-from-bracket"></i> Logout</a>
            </div>

            <!-- MAIN -->
            <div class="col-lg-10 main-content">
                <!-- TOPBAR -->
                <div class="topbar d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h2>Halo, <?php echo $_SESSION['admin']; ?> 👋</h2>
                        <p>Selamat datang di dashboard admin website portofolio kamu.</p>
                    </div>
                    <div>
                        <span class="status-badge">Website Online</span>
                    </div>
                </div>

                <!-- STATS -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="glass-card stat-card">
                            <div class="icon"><i class="fas fa-folder"></i></div>
                            <h6>Total Project</h6>
                            <h3><?php echo $totalProject; ?></h3>
                            <p class="small-soft mb-0">Jumlah project yang ditampilkan di portofolio.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="glass-card stat-card">
                            <div class="icon"><i class="fas fa-user-shield"></i></div>
                            <h6>Status Admin</h6>
                            <h3>Aktif</h3>
                            <p class="small-soft mb-0">Kamu sedang login sebagai administrator website.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="glass-card stat-card">
                            <div class="icon"><i class="fas fa-wifi"></i></div>
                            <h6>Status Sistem</h6>
                            <h3>Online</h3>
                            <p class="small-soft mb-0">Website portofolio dapat diakses dengan normal.</p>
                        </div>
                    </div>
                </div>

                <!-- QUICK ACTION -->
                <div class="glass-card mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                        <div>
                            <h4 class="mb-1">Quick Action</h4>
                            <p class="small-soft mb-0">Akses cepat untuk mengelola isi website.</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="tambah_project.php" class="quick-btn"><i class="fas fa-plus"></i> Tambah Project</a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="quick-btn"><i class="fas fa-user-edit"></i> Edit Profil</a>
                        </div>
                        <div class="col-md-4">
                            <a href="../index.php" target="_blank" class="quick-btn"><i class="fas fa-eye"></i> Preview Website</a>
                        </div>
                    </div>
                </div>

                <!-- INFO -->
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="glass-card h-100">
                            <h4 class="mb-3">Ringkasan Website</h4>
                            <table class="table-dark-custom">
                                <tr>
                                    <th>Nama Website</th>
                                    <td>Portofolio Arfan</td>
                                </tr>
                                <tr>
                                    <th>Framework / Basis</th>
                                    <td>PHP Native + Bootstrap</td>
                                </tr>
                                <tr>
                                    <th>Tampilan</th>
                                    <td>Dark Glassmorphism UI</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Project</th>
                                    <td><?php echo $totalProject; ?> Project</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><span class="status-badge">Aktif</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="glass-card h-100">
                            <h4 class="mb-3">Catatan Admin</h4>
                            <p class="small-soft">
                                Dashboard ini digunakan untuk mengelola isi website portofolio seperti project,
                                profil, dan tampilan data secara dinamis menggunakan database MySQL.
                            </p>

                            <hr class="border-secondary my-4">

                            <h6 class="mb-3">Progress Saat Ini</h6>
                            <div class="mb-3">
                                <small class="small-soft">Frontend Portofolio</small>
                                <div class="progress mt-2" style="height: 10px; border-radius: 20px;">
                                    <div class="progress-bar bg-info" style="width: 90%;"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <small class="small-soft">Dashboard Admin</small>
                                <div class="progress mt-2" style="height: 10px; border-radius: 20px;">
                                    <div class="progress-bar bg-success" style="width: 55%;"></div>
                                </div>
                            </div>

                            <div>
                                <small class="small-soft">Integrasi Database</small>
                                <div class="progress mt-2" style="height: 10px; border-radius: 20px;">
                                    <div class="progress-bar bg-warning" style="width: 65%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>