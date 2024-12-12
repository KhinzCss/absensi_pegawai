<?php
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $Jabatan = $_POST['Jabatan'];
    $Golongan = $_POST['Golongan'];
    $NIP = $_POST['NIP']; // Mengambil NIP dari input

    $sql = "INSERT INTO pegawai (Nama_Pegawai, Jabatan, Golongan, NIP)
            VALUES ('$nama', '$Jabatan', '$Golongan', '$NIP')";
    
    if ($mysqli->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah pegawai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('../background.jpg');
            background-size: cover;
            color: black; /* Change font color to black */
        }
        .container {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
            color: black; /* Change font color to black */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">PENDATAAN pegawai</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                <a class="nav-link" href="admin_dashboard.php">home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Content -->
    <div class="container">
        <h2 class="mt-3 mb-4">Tambah pegawai</h2>
        <form method="post">
            <div class="form-group">
                <label for="nama">Nama pegawai:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="Jabatan">Jabatan:</label>
                <select class="form-control" id="Jabatan" name="Jabatan">
                    <option value="Kepala Dinas">Kepala Dinas</option>
                    <option value="Sekertaris Dinas">Sekertaris Dinas</option>
                    <option value="Kepala Bidang Informasi Dan Komunikasi Publik">Kepala Bidang Informasi Dan Komunikasi Publik</option>
                    <option value="Kepala Bidang Aplikasi Informatika Pemerintah">Kepala Bidang Aplikasi Informatika Pemerintah</option>
                    <option value="Kepala Sub Bagian Kepegawaian dan Umun">Kepala Sub Bagian Kepegawaian dan Umun</option>
                    <option value="Kepala Sub Bagian perencanaan dan Keuangan">Kepala Sub Bagian perencanaan dan Keuangan</option>
                    <option value="Peranata Hubungan masyarakat Ahli Muda">Peranata Hubungan masyarakat Ahli Muda</option>
                    <option value="Kepala Seksi Persandian">Kepala Seksi Persandian</option>
                    <option value="Peranata Komputer Ahli Muda">Peranata Komputer Ahli Muda</option>
                    <option value="kepala Seksi Statistik">kepala Seksi Statistik</option>
                    <option value="Analisis Kebijakan Ahli Muda">Analisis Kebijakan Ahli Muda</option>
                    <option value="Analisis Statistik">Analisis Statistik</option>
                    <option value="Bendahara Pengeluaran">Bendahara Pengeluaran</option>  
                    <option value="Statistisi Ahli Pertama">Statistisi Ahli Pertama</option> 
                    <option value="Pranata Komputer Ahli Pertama">Pranata Komputer Ahli Pertama</option> 
                    <option value="Pranata Hubungan Masyarakat Ahli Pertama">Pranata Hubungan Masyarakat Ahli Pertama</option> 
                    <option value="Pengelola Pemanfaatan Barang Milik Daerah">Pengelola Pemanfaatan Barang Milik Daerah</option> 
                    <option value="Pranata Komputer Terampil">Pranata Komputer Terampil</option> 
                    <option value="Pranata Komputer Mahir">Pranata Komputer Mahir</option> 
                    
                </select>
            </div>
            <div class="form-group">
                <label for="Golongan">Golongan:</label>
                <select class="form-control" id="Golongan" name="Golongan">
                    <option value="Pembina Tingkat I / IV-b">Pembina Tingkat I / IV-b</option>
                    <option value="Penata Muda / III-a">Penata Muda / III-a</option>
                    <option value="Penata Muda TK I / III-b">Penata Muda TK I / III-b</option>
                    <option value="Penata Tingkat I / III-d">Penata Tingkat I / III-d</option>
                    <option value="Pengatur Tingkat I / III-d">Pengatur Tingkat I / III-d</option>
                    <option value="Pengatur Tingkat I / II-c">Pengatur Tingkat I / II-c</option>
                    <option value="Pembina / IV-a">Pembina / IV-a</option>
                    <option value="IX">IX</option>
                    <option value="VII">VII</option>  
                </select>
            </div>
            <div class="form-group">
                <label for="NIP">NIP:</label>
                <input type="text" class="form-control" id="NIP" name="NIP">
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
