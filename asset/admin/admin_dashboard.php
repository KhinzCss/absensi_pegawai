<?php
// Mulai session jika belum dimulai
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/dasadmin.css?v=1">
</head>
<body>

    <?php
    include 'navbar.php';
    ?>

    <!-- Konten Dashboard -->
    <div class="container">
        <?php 
        // Periksa apakah sesi admin sudah ada dan bernilai true
        if(isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
            // Jika sudah, tampilkan nama admin yang telah login
            echo "<h2>Selamat datang, ".$_SESSION['admin']."!</h2>";
        }
        ?>
    </div>
    <br>
    <br>

    <!-- Pintasan ke kehadiran.php -->
    <div class="container mt-3">
        <div class="row justify-content-center">
            <center>
                <a href="kehadiran.php"><button class="shortcut-link">Pergi ke Kehadiran</button></a>
            </center>
        </div>
    </div>

    <!-- Pintasan ke index.php -->
    <div class="container mt-3">
        <div class="row justify-content-center">
            <center>
                <a href="index.php"><button class="shortcut-link">Registrasi Pegawai dinas</button></a>
            </center>
        </div>
    </div>

    <!-- Pintasan ke laporan_kehadiran.php -->
    <div class="container mt-3">
        <div class="row justify-content-center">
            <center>
                <a href="laporan_kehadiran.php"><button class="shortcut-link">Lihat Rekap Absensi</button></a>
            </center>
        </div>
    </div>

</body>
</html>
