<?php
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['nama'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $Jabatan = $_POST['Jabatan'];
    $Golongan = $_POST['Golongan'];
    $NIP = $_POST['NIP'];

    $sql = "UPDATE pegawai SET Nama_Pegawai='$nama', Jabatan='$Jabatan', Golongan='$Golongan', NIP='$NIP' WHERE ID_pns='$id'";
    
    if ($mysqli->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $mysqli->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pegawai WHERE ID_pns='$id'";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nama = $row['Nama_Pegawai'];
        $Jabatan = $row['Jabatan'];
        $Golongan = $row['Golongan'];
        $NIP = $row['NIP'];
    } else {
        echo "Data pegawai tidak ditemukan.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>
    <link rel="stylesheet" href="../css/edit.css?v=1"> <!-- Hubungkan file CSS -->
</head>
<body>
    <div class="container">
        <h2>Edit Pegawai</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="nama">Nama Pegawai:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>
            </div>
            <div class="form-group">
                <label for="Jabatan">Jabatan:</label>
                <select id="Jabatan" name="Jabatan">
                    <!-- Opsi Jabatan -->
                    <option value="Kepala Dinas" <?php if ($Jabatan == 'Kepala Dinas') echo 'selected'; ?>>Kepala Dinas</option>
                    <!-- Tambahkan opsi lainnya -->
                </select>
            </div>
            <div class="form-group">
                <label for="Golongan">Golongan:</label>
                <select id="Golongan" name="Golongan">
                    <!-- Opsi Golongan -->
                    <option value="Pembina Tingkat I / IV-b" <?php if ($Golongan == 'Pembina Tingkat I / IV-b') echo 'selected'; ?>>Pembina Tingkat I / IV-b</option>
                    <!-- Tambahkan opsi lainnya -->
                </select>
            </div>
            <div class="form-group">
                <label for="NIP">NIP:</label>
                <input type="text" id="NIP" name="NIP" value="<?php echo $NIP; ?>">
            </div>
            <button type="submit" class="btn">Update</button>
        </form>
    </div>
</body>
</html>
