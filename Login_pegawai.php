<?php
session_start();

// Cek apakah pengguna sudah login, jika sudah arahkan ke halaman dashboard pegawai
if (isset($_SESSION['pegawai_logged_in']) && $_SESSION['pegawai_logged_in'] === true) {
    header("location: user/dashboard_pegawai.php");
    exit;
}

include 'config.php'; // Sertakan file konfigurasi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mencegah SQL Injection dengan memvalidasi input
    $Nama_Pegawai = trim($_POST['Nama_Pegawai']);
    $NIP = trim($_POST['NIP']);

    // Query untuk memeriksa kecocokan data login dengan data di database pegawai
    $sql = "SELECT * FROM pegawai WHERE Nama_Pegawai = ? AND NIP = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ss", $Nama_Pegawai, $NIP);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Data login cocok, set session dan arahkan ke dashboard pegawai
            $_SESSION['pegawai_logged_in'] = true;
            $_SESSION['Nama_Pegawai'] = $Nama_Pegawai;
            $_SESSION['NIP'] = $NIP; // Simpan NIP ke dalam sesi
            header("location: user/dashboard_pegawai.php");
            exit;
        } else {
            // Data login tidak cocok, tampilkan pesan error
            $error = "Nama pegawai atau NIP tidak valid.";
        }
        $stmt->close();
    } else {
        $error = "Terjadi kesalahan pada sistem. Silakan coba lagi nanti.";
    }
    $mysqli->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login pegawai</title>
   <link rel="stylesheet" href="pegawai.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">pegawai PANEL</a>
        </div>
    </div>

    <div class="login-container">
        <div class="login-form">
            <h2 class="text-center">LOGIN PEGAWAI</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="Nama_Pegawai">Nama pegawai:</label>
                    <input type="text" id="Nama_Pegawai" name="Nama_Pegawai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="NIP">NIP:</label>
                    <input type="text" id="NIP" name="NIP" class="form-control" required>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn login-btn">Login</button>
                </div>
            </form>
            <?php
            // Tampilkan pesan error jika ada
            if (isset($error)) {
                echo "<p class='error-message'>$error</p>";
            }
            ?>
        </div>
    </div>

</body>
</html>
