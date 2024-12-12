<?php
session_start();

// Periksa apakah sesi pegawai sudah masuk atau belum, jika tidak, arahkan ke halaman login
if(!isset($_SESSION['pegawai_logged_in']) || $_SESSION['pegawai_logged_in'] !== true) {
    header("location: ../Login_pegawai.php");
    exit;
}

// Ambil nama pegawai dari sesi
$Nama_Pegawai = $_SESSION['Nama_Pegawai'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pegawai</title>
    <link rel="stylesheet" href="dashpeg.css?v=1">
</head>
<body>
    <!-- Navbar -->
    <?php include "navbar.php"; ?>

    <!-- Pintasan ke absensi.php -->
    <div class="container">
        <div class="row center">
            <a href="absensi.php" class="shortcut-link">Absensi</a>
        </div>
    </div>

    <!-- Pintasan ke rekap_data.php -->
    <div class="container">
        <div class="row center">
            <a href="rekap_data.php" class="shortcut-link">Lihat Absensi</a>
        </div>
    </div>

    <!-- Pintasan ke About.php -->
    <div class="container">
        <div class="row center">
            <a href="About.php" class="shortcut-link">About</a>
        </div>
    </div>

    <!-- jQuery dan Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
