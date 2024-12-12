<?php
session_start();

include '../config.php'; // Sertakan file konfigurasi database

// Periksa apakah pengguna sudah login sebagai pegawai
if (!isset($_SESSION['pegawai_logged_in']) || $_SESSION['pegawai_logged_in'] !== true) {
    header("location: login_pegawai.php");
    exit;
}

// Ambil nama pegawai dari sesi
$Nama_Pegawai = $_SESSION['Nama_Pegawai'];

// Query untuk mendapatkan ID pegawai berdasarkan nama pegawai
$stmt = $mysqli->prepare("SELECT ID_pns FROM pegawai WHERE Nama_Pegawai = ?");
$stmt->bind_param("s", $Nama_Pegawai);
$stmt->execute();
$result = $stmt->get_result();
$pegawai = $result->fetch_assoc();
$ID_pns = $pegawai['ID_pns'];
$stmt->close();

// Query untuk mendapatkan data absensi pegawai
$sql = "SELECT * FROM Absensi WHERE ID_pns = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $ID_pns);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Pegawai</title>
    <link rel="stylesheet" href="rekap.css">
</head>
<body>
    <!-- Navbar -->
    <?php include "navbar.php"; ?>

    <!-- Konten Dashboard -->
    <div class="container">
        <h2 class="title">Absensi Pegawai</h2>
        <div class="table-wrapper">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td>{$row['Tanggal']}</td>";
                        echo "<td>{$row['check_in_time']}</td>";
                        echo "<td>{$row['Kehadiran']}</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="dashboard_pegawai.php" class="button">Kembali</a>
    </div>
</body>
</html>
