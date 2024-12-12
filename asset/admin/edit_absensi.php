<?php
include '../../config.php';

// Query untuk mengambil opsi kehadiran dari tabel 'keterangan'
$sql_kehadiran = "SELECT * FROM keterangan";
$result_kehadiran = $mysqli->query($sql_kehadiran);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $ID_pns = $_POST['ID_pns'];
    $tanggal = $_POST['tanggal'];
    $kehadiran = $_POST['kehadiran'];

    $sql = "UPDATE Absensi SET ID_pns='$ID_pns', Tanggal='$tanggal', Kehadiran='$kehadiran' WHERE ID_Absensi='$id'";
    
    if ($mysqli->query($sql) === TRUE) {
        header("Location: kehadiran.php");
        exit();
    } else {
        echo "Error updating record: " . $mysqli->error;
    }

    $mysqli->close();
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Absensi WHERE ID_Absensi='$id'";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $ID_pns = $row['ID_pns'];
        $tanggal = $row['Tanggal'];
        $kehadiran = $row['Kehadiran'];
    } else {
        echo "Data absensi tidak ditemukan.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi</title>
    <link rel="stylesheet" href="../css/edita.css">
</head>
<body>
    <?php
    include 'navbar.php'?>
    <center>
<div class="container">
    <h2 class="text-center">Edit Absensi</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="ID_pns">ID Pegawai:</label>
            <input type="text" class="form-control" id="ID_pns" name="ID_pns" value="<?php echo $ID_pns; ?>" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>
        </div>
        <div class="form-group">
            <label for="kehadiran">Kehadiran:</label>
            <select class="form-control" id="kehadiran" name="kehadiran">
                <?php
                if ($result_kehadiran->num_rows > 0) {
                    while($row_kehadiran = $result_kehadiran->fetch_assoc()) {
                        echo "<option value='".$row_kehadiran['kehadiran']."' ".($kehadiran == $row_kehadiran['kehadiran'] ? 'selected' : '').">".$row_kehadiran['kehadiran']."</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada opsi kehadiran</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn-primary">Update</button>
    </form>
    </center>
</div>
</body>
</html>
