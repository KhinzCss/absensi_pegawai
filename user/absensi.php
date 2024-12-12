<?php
session_start();

// Periksa apakah pengguna sudah login sebagai PEGAWAI
if (!isset($_SESSION['pegawai_logged_in']) || $_SESSION['pegawai_logged_in'] !== true) {
    header("location: ../login_pegawai.php");
    exit;
}

include '../config.php'; // Sertakan file konfigurasi database

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

// Query untuk mendapatkan status absensi hari ini
$stmt = $mysqli->prepare("SELECT * FROM Absensi WHERE ID_pns = ? AND Tanggal = CURDATE()");
$stmt->bind_param("s", $ID_pns);
$stmt->execute();
$result = $stmt->get_result();
$absensi_today = $result->fetch_assoc();
$stmt->close();

// Dapatkan waktu saat ini
$current_time = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
$start_checkin_time = new DateTime('08:00', new DateTimeZone('Asia/Jakarta'));
$end_checkin_time = new DateTime('11:59', new DateTimeZone('Asia/Jakarta'));
$end_day_time = new DateTime('23:50', new DateTimeZone('Asia/Jakarta'));

// Kondisi untuk absen
$can_check_in = !$absensi_today && $current_time >= $start_checkin_time && $current_time <= $end_checkin_time;

// Tandai otomatis "Alfa" jika waktu sudah lewat dan belum ada data absensi
if (!$absensi_today && $current_time > $end_checkin_time && $current_time <= $end_day_time) {
    $sql = "INSERT INTO Absensi (ID_pns, Tanggal, Kehadiran, NIP, check_in_time) VALUES (?, CURDATE(), 'Alfa', ?, NOW())";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $ID_pns, $_SESSION['NIP']);
    $stmt->execute();
    $stmt->close();
    $absensi_today['Kehadiran'] = 'Alfa';
}

// Status absensi berdasarkan waktu
$absensi_message = '';
if ($current_time < $start_checkin_time) {
    $absensi_message = "Absensi akan dibuka pada pukul " . $start_checkin_time->format('H:i');
} elseif ($current_time > $end_checkin_time) {
    $absensi_message = "Absensi telah ditutup pada pukul " . $end_checkin_time->format('H:i');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi Pegawai</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* style.css */
        body {
    background-image: url('../asset/22.png');
    background-size: cover; /* Mengatur agar background menutupi seluruh halaman */
    background-position: center center; /* Mengatur posisi background tetap di tengah */
    background-attachment: fixed; /* Menjaga background tetap di tempat meski halaman di-scroll */
    color: #ffffff;
    font-family: 'Arial', sans-serif;
    padding: 0;
    margin: 0;
}

/* Memastikan container tetap terlihat dengan efek transparan */
.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.7); /* Efek transparansi agar background tetap terlihat */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    color: #fff;
}


.navbar {
    background-color: #343a40; /* Warna navbar */
    padding: 15px;
    z-index: 1000;
}

.navbar-brand {
    display: flex;
    align-items: center;
    color: white;
    font-size: 1.5em;
}

.navbar-brand .logo img {
    width: 50px;
    margin-right: 10px;
}
.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.8);
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    color: #fff;
}

.absensi-form h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
}

.form-group select,
.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 15px;
    font-size: 14px;
    color: #000;
}

.submit-btn {
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    display: block;
    margin: 0 auto;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background-color: #0056b3;
}

.alert {
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
    font-size: 14px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}

.alert-info {
    background-color: #d1ecf1;
    color: #0c5460;
}

.alert-warning {
    background-color: #fff3cd;
    color: #856404;
}

footer {
    text-align: center;
    margin-top: 30px;
    color: #bbb;
    font-size: 14px;
}

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="#" class="navbar-brand">Pegawai Panel</a>
    </nav>

    <!-- Konten Dashboard -->
    <div class="container">
        <div class="absensi-form">
            <h2>Form Absensi</h2>

            <!-- Tampilkan status absensi -->
            <?php if ($absensi_today): ?>
                <div class="alert alert-info">
                    Anda sudah absen hari ini dengan status: <strong><?= htmlspecialchars($absensi_today['Kehadiran']) ?></strong>.
                </div>
            <?php elseif (!empty($absensi_message)): ?>
                <div class="alert alert-warning">
                    <?= htmlspecialchars($absensi_message) ?>
                </div>
            <?php elseif ($can_check_in): ?>
                <form method="post" action="proses_absensi.php">
                    <div class="form-group">
                        <label for="kehadiran">Kehadiran:</label>
                        <select id="kehadiran" name="kehadiran" required>
                            <option value="Hadir">Hadir</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>

                    <button type="submit" class="submit-btn">Absen</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        &copy; 2024 Sistem Absensi Pegawai
    </footer>
</body>
</html>
