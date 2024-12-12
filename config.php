<?php
// Informasi koneksi database
$host = "localhost"; // Host database
$username_db = "root"; // Username database
$password_db = ""; // Password database
$database = "absen_pegawai"; // Nama database

// Koneksi ke database
$mysqli = new mysqli($host, $username_db, $password_db, $database);

// Memeriksa koneksi
if ($mysqli->connect_errno) {
    die("Koneksi ke database gagal: " . $mysqli->connect_error);
}

// Memeriksa apakah ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Username']) && isset($_POST['Password'])) {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $stmt_admin = $mysqli->prepare("SELECT Username, Password FROM Admin WHERE Username=?");
    $stmt_admin->bind_param("s", $username);
    $stmt_admin->execute();
    $stmt_admin->bind_result($db_username_admin, $db_password_hash_admin);
    $stmt_admin->fetch();
    $stmt_admin->close();

    $stmt_pengguna = $mysqli->prepare("SELECT Username, Password FROM Pengguna WHERE Username=?");
    $stmt_pengguna->bind_param("s", $username);
    $stmt_pengguna->execute();
    $stmt_pengguna->bind_result($db_username_pengguna, $db_password_hash_pengguna);
    $stmt_pengguna->fetch();
    $stmt_pengguna->close();

    if (($db_username_admin && password_verify($password, $db_password_hash_admin)) || ($db_username_pengguna && password_verify($password, $db_password_hash_pengguna))) {
        
        if ($db_username_admin) {
            $_SESSION['admin'] = $username;
        
            header("Location: admin_dashboard.php");
        } else {
            $_SESSION['user'] = $username;
        
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        $error_message = "Username atau password salah.";
    }
}
?>
