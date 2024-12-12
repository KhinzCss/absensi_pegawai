<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kehadiran Pegawai</title>
    <link rel="stylesheet" href="../css/laporankehadiran.css"> <!-- Menggunakan file CSS terpisah -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
    <?php
    include 'navbar.php';
    ?>
    <!-- Konten Laporan Kehadiran Pegawai -->
    <div class="container">
        <h2 class="mb-4">Laporan Kehadiran Pegawai</h2>
        <div class="table-responsive">
            <?php
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

            // Query untuk mengakumulasikan setiap status kehadiran untuk setiap pengguna beserta nama pegawai
            $sql = "SELECT pegawai.Nama_Pegawai, 
                SUM(CASE WHEN Absensi.Kehadiran = 'Hadir' THEN 1 ELSE 0 END) AS Hadir,
                SUM(CASE WHEN Absensi.Kehadiran = 'Sakit' THEN 1 ELSE 0 END) AS Sakit,
                SUM(CASE WHEN Absensi.Kehadiran = 'Izin' THEN 1 ELSE 0 END) AS Izin,
                SUM(CASE WHEN Absensi.Kehadiran = 'Alfa' THEN 1 ELSE 0 END) AS Alfa
            FROM Absensi
            INNER JOIN pegawai ON Absensi.ID_pns = pegawai.ID_pns
            GROUP BY pegawai.ID_pns";

            // Eksekusi query
            $result = $mysqli->query($sql);

            // Memeriksa apakah query berhasil dijalankan
            if ($result === false) {
                echo "Error: " . $mysqli->error; // Menampilkan pesan kesalahan jika query gagal
                exit(); // Menghentikan eksekusi kode jika terjadi kesalahan
            }

            // Menampilkan tabel
            echo "<table class='table table-bordered' id='tabel'>
                    <thead>
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Hadir</th>
                            <th>Sakit</th>
                            <th>Izin</th>
                            <th>Alfa</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Nama_Pegawai'] . "</td>";
                echo "<td>" . $row['Hadir'] . "</td>";
                echo "<td>" . $row['Sakit'] . "</td>";
                echo "<td>" . $row['Izin'] . "</td>";
                echo "<td>" . $row['Alfa'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>
                </table>";

            // Membebaskan hasil query
            $result->free();

            // Menutup koneksi database
            $mysqli->close();
            ?>
        </div>
        <button class="btn btn-primary mt-3" onclick="cetakPDF()">Cetak PDF</button>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        async function cetakPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            const elementHTML = document.querySelector('#tabel');
            const canvas = await html2canvas(elementHTML);
            const imageData = canvas.toDataURL('image/png');
            const imgWidth = 210; 
            const pageHeight = 295;  
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            let heightLeft = imgHeight;
            let position = 0;

            doc.addImage(imageData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                doc.addPage();
                doc.addImage(imageData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            doc.save('Rekap_data_Pegawai.pdf');
        }
    </script>
</body>
</html>
