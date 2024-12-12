<?php
require_once "config.php";

// Variabel untuk menyimpan pesan error
$login_error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = $mysqli->prepare("SELECT * FROM Admin WHERE Username = ? AND Password = ?");
    $stmt->bind_param("ss", $username, $password); // "ss" berarti dua parameter string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Redirect ke dashboard jika login berhasil
        header("location: asset/admin/admin_dashboard.php");
        exit;
    } else {
        $login_error = "Username atau password salah.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="adminL.css?v=1">
</head>
<body>

    <div class="login-container">
        <div class="login-form">
            <h2>LOGIN ADMIN</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
            <?php
            // Tampilkan pesan error jika ada
            if (!empty($login_error)) {
                echo "<p class='error'>$login_error</p>";
            }
            ?>
        </div>
    </div>

</body>
</html>
