<?php
include '../../config.php';

// Query untuk mengambil data absensi beserta Nama pegawai, NIP, dan Foto
$sql_absensi = "SELECT Absensi.ID_Absensi, pegawai.Golongan,pegawai.Nama_Pegawai , pegawai.NIP, pegawai.Jabatan, Absensi.Tanggal, Absensi.Kehadiran 
                FROM Absensi 
                INNER JOIN pegawai ON Absensi.ID_pns = pegawai.ID_pns";
$result_absensi = $mysqli->query($sql_absensi);

// Memeriksa apakah query berhasil dijalankan
if ($result_absensi === false) {
    echo "Error: " . $mysqli->error; // Menampilkan pesan kesalahan jika query gagal
    exit(); // Menghentikan eksekusi kode jika terjadi kesalahan
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi Pegawai</title>
    <link rel="stylesheet" href="../css/kehadiran.css?v=1">
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Content -->
    <div class="container mt-5">
        <h2>Data Absensi Pegawai</h2>
        <center>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Absensi</th>
                        <th>Nama Pegawai</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Golongan</th>
                        <th>Tanggal</th>
                        <th>Kehadiran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                </center>
                <tbody>

                    <?php
                    // Memeriksa apakah query menghasilkan baris data
                    if ($result_absensi->num_rows > 0) {
                        // Lakukan iterasi dan tampilkan hasil
                        while($row_absensi = $result_absensi->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row_absensi["ID_Absensi"]."</td>";
                            echo "<td>".$row_absensi["Nama_Pegawai"]."</td>";
                            echo "<td>".$row_absensi["NIP"]."</td>";
                            echo "<td>".$row_absensi["Jabatan"]."</td>";
                            echo "<td>".$row_absensi["Golongan"]."</td>";
                            echo "<td>".$row_absensi["Tanggal"]."</td>";
                            echo "<td>".$row_absensi["Kehadiran"]."</td>";
                            echo "<td>";
                            echo "<a href='edit_absensi.php?id=".$row_absensi["ID_Absensi"]."' class='btn btn-warning btn-sm'>Edit</a> ";
                            echo "<a href='delete_absensi.php?id=".$row_absensi["ID_Absensi"]."' class='btn btn-danger btn-sm'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Tidak ada data absensi.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
