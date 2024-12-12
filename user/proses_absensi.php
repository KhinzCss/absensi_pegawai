<?php
session_start();

include '../config.php'; // Sertakan file konfigurasi database

// Pastikan metode pengiriman adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $ID_pns = $_POST['ID_pns'];
    $NIP = $_SESSION['NIP']; // Ambil NIP dari sesi
    $kehadiran = $_POST['kehadiran'];
    $action = $_POST['action'];

    // Dapatkan waktu saat ini
    $current_time = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $start_checkin_time = new DateTime('08:00', new DateTimeZone('Asia/Jakarta'));
    $end_checkin_time = new DateTime('11:59', new DateTimeZone('Asia/Jakarta'));
    $end = new DateTime('23.50', new DateTimeZone('Asia/Jakarta'));

    // Query untuk mendapatkan status absensi hari ini
    $stmt = $mysqli->prepare("SELECT * FROM Absensi WHERE ID_pns = ? AND Tanggal = CURDATE()");
    $stmt->bind_param("s", $ID_pns);
    $stmt->execute();
    $result = $stmt->get_result();
    $absensi_today = $result->fetch_assoc();
    $stmt->close();

    // Proses absen masuk
    if ($action == 'check_in') {
        if (!$absensi_today && $current_time >= $start_checkin_time && $current_time <= $end_checkin_time) {
            // Query untuk menyimpan data absen masuk
            $sql = "INSERT INTO Absensi (ID_pns, Tanggal, Kehadiran, NIP, check_in_time) VALUES (?, CURDATE(), ?, ?, NOW())";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sss", $ID_pns, $kehadiran, $NIP);

            // Lakukan eksekusi query
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Absensi masuk berhasil disimpan.";
            } else {
                $_SESSION['error_message'] = "Gagal menyimpan data absensi masuk.";
            }
        } else {
            $_SESSION['error_message'] = "Anda sudah melakukan absen masuk atau di luar waktu absen.";
        }
    } else {
        $_SESSION['error_message'] = "Aksi tidak valid.";
    }
} 

// Arahkan kembali ke halaman absensi
header("location: absensi.php");
exit;
?>
