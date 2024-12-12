<?php

include '../../config.php';

// Menghandle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST["tanggal"];
    $pegawai_id = $_POST["pegawai"];
    $kehadiran = $_POST["kehadiran"];


    // Insert kehadiran ke database jika setidaknya satu kehadiran dipilih
    if (!empty($kehadiran)) {
        // Filter dan escape data yang diinputkan
        $tanggal = $mysqli->real_escape_string($tanggal);
        $pegawai_id = $mysqli->real_escape_string($pegawai_id);
        $kehadiran = $mysqli->real_escape_string($kehadiran); // Kehadiran bisa berupa Izin, Sakit, atau Alfa

        // Insert kehadiran ke database
        $sql_insert = "INSERT INTO Absensi (ID_pns, Tanggal, Kehadiran) VALUES ('$pegawai_id', '$tanggal', '$kehadiran')";
        if ($mysqli->query($sql_insert) === TRUE) {
            // Redirect ke halaman kehadiran.php setelah data disimpan
            header("Location: kehadiran.php");
            exit();
        } else {
            echo "Error: " . $sql_insert . "<br>" . $mysqli->error;
        }
    } else {
        echo "Status kehadiran harus dipilih.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Kehadiran pegawai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 70px; /* Padding atas agar konten tidak tertutup navbar */
            background-image: url('../I.png'); /* Ubah 'background.jpg' sesuai dengan nama file gambar latar belakang */
            background-size: cover;
            background-position: center;
            color: #ffffff; /* Warna font */
        }

        .form-group {
            border: 1px solid #ced4da; /* Tambahkan border untuk seluruh form */
            border-radius: 5px; /* Membuat border melengkung */
            padding: 10px; /* Beri jarak antara border dengan konten di dalamnya */
            background-color: rgba(255, 255, 255, 0.7); /* Warna latar belakang dengan kejelasan 70% */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand"  href="#">PENDATAAN pegawai</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                <a class="nav-link" href="admin_dashboard.php">home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="About.php">About</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">
        <h2 class="style="color: black;>Pendataan Kehadiran pegawai</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label style="color: black;"for="tanggal">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="form-group">
                <label style="color: black;" for="pegawai">Pilih pegawai:</label>
                <select class="form-control" id="pegawai" name="pegawai" required>
                    <option value="">Pilih pegawai</option>
                    <?php
                    // Ambil data pegawai dari database
                    $sql_pegawai = "SELECT * FROM pegawai";
                    $result_pegawai = $mysqli->query($sql_pegawai);
                    if ($result_pegawai->num_rows > 0) {
                        while($row_pegawai = $result_pegawai->fetch_assoc()) {
                            echo "<option value='".$row_pegawai["ID_pns"]."'>".$row_pegawai["Nama_Pegawai"]."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label style="color: black;">Status Kehadiran:</label><br>
                <select class="form-control" name="kehadiran" required>
                    <option value="">Pilih Status Kehadiran</option>
                    <?php
                    // Ambil data status kehadiran dari tabel keterangan
                    $sql_status = "SELECT DISTINCT ada FROM keterangan";
                    $result_status = $mysqli->query($sql_status);
                    if ($result_status->num_rows > 0) {
                        while($row_status = $result_status->fetch_assoc()) {
                            echo "<option value='".$row_status["ada"]."'>".$row_status["ada"]."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </form>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
