<?php
include '../../config.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $Jabatan = isset($_POST['Jabatan']) ? trim($_POST['Jabatan']) : '';
    $Golongan = isset($_POST['Golongan']) ? trim($_POST['Golongan']) : '';
    $NIP = isset($_POST['NIP']) ? trim($_POST['NIP']) : '';

    // Validasi tambahan (misalnya panjang input, format NIP, dll)
    if (empty($nama) || empty($NIP)) {
        $error_message = "Nama dan NIP harus diisi.";
    } else {
        // Cek apakah NIP sudah ada
        $stmt = $mysqli->prepare("SELECT COUNT(*) FROM pegawai WHERE NIP = ?");
        $stmt->bind_param("s", $NIP);
        $stmt->execute();
        $stmt->bind_result($query);
        $stmt->fetch();
        $stmt->close();

        if ($query > 0) {
            $error_message = "NIP sudah terdaftar.";
        } else {
            // Prepared statement untuk menambahkan pegawai
            $stmt = $mysqli->prepare("INSERT INTO pegawai (Nama_Pegawai, Jabatan, Golongan, NIP) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nama, $Jabatan, $Golongan, $NIP);

            // Eksekusi prepared statement
            if ($stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                $error_message = "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai Dinas</title>
    <link rel="stylesheet" href="../css/addpeg.css?v=1">
</head>
<body>
    <div class="container">
        <h2 class="mt-3 mb-4">Tambah Pegawai</h2>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="nama">Nama Pegawai:</label>
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
                <input type="text" class="form-control" id="NIP" name="NIP" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
