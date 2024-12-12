<?php
session_start();

include 'config.php'; // Sertakan file konfigurasi database

// Periksa apakah pengguna sudah login sebagai pegawai
if (!isset($_SESSION['pegawai_logged_in']) || $_SESSION['pegawai_logged_in'] !== true) {
    header("location: login_pegawai.php");
    exit;
}

// Pastikan metode pengiriman adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $ID_pns = $_POST['ID_pns'];
    
    // Query untuk menghapus absensi hari ini
    $sql = "DELETE FROM Absensi WHERE ID_pns = ? AND Tanggal = CURDATE()";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $ID_pns);

    // Lakukan eksekusi query
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Absensi hari ini berhasil di-reset.";
    } else {
        $_SESSION['error_message'] = "Gagal melakukan reset absensi.";
    }
}

// Arahkan kembali ke halaman absensi
header("location: absensi.php");
exit;
?>
