<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD pegawai dan Absensi</title>
    <link rel="stylesheet" href="../css/index.css?v=1"> <!-- Menggunakan file CSS kustom -->
</head>
<body>

    <!-- Content -->
    <div class="container">
        <h2>Data pegawai</h2>
        <div class="button-group">
            <a href="add_pegawai.php" class="btn btn-primary">Tambah Pegawai dinas</a>
            <a href="kehadiran.php" class="btn btn-success">Kehadiran</a>
            <a href="admin_dashboard.php" class="btn btn-danger">Back</a> <!-- Pintasan ke kehadiran.php -->
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama pegawai</th>
                        <th>Jabatan</th>
                        <th>Golongan</th>
                        <th>NIP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../../config.php';
                    $sql = "SELECT * FROM pegawai";
                    $result = $mysqli->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row["ID_pns"]."</td>";
                            echo "<td>".$row["Nama_Pegawai"]."</td>";
                            echo "<td>".$row["Jabatan"]."</td>";
                            echo "<td>".$row["Golongan"]."</td>";
                            echo "<td>".$row["NIP"]."</td>";
                            echo "<td>
                                    <a href='edit_pegawai.php?id=".$row["ID_pns"]."' class='btn btn-primary btn-sm'>Edit</a>
                                    <a href='delete.php?id=".$row["ID_pns"]."' class='btn btn-danger btn-sm'>Hapus</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                    }
                    $mysqli->close();
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
