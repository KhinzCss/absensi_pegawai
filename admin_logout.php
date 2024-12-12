<?php
// Mulai session
session_start();

// Hapus semua data sesi admin
$_SESSION = array();

// Hancurkan sesi admin
session_destroy();

// Redirect ke halaman login admin
header("Location: admin_login.php");
exit;
?>
