<?php
// Mulai session jika belum ada yang dimulai
session_start();

// Membersihkan semua variabel sesi
session_unset();

// Menghancurkan sesi
session_destroy();

// Mulai sesi baru
session_start();

// Set informasi admin yang baru
$_SESSION['admin'] = "admin_baru"; // Ganti dengan informasi admin yang baru

// Redirect ke halaman setelah berhasil login
header("Location: admin_dashboard.php");
exit();
?>
