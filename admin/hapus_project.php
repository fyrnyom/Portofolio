<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

include '../koneksi.php';

$id = (int) $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM projects WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if ($row) {
    $gambarPath = "../uploads/" . $row['gambar'];

    if (!empty($row['gambar']) && file_exists($gambarPath)) {
        unlink($gambarPath);
    }

    mysqli_query($conn, "DELETE FROM projects WHERE id='$id'");
}

header("Location: dashboard.php");
exit;
