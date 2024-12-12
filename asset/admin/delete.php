<?php
include '../../config.php';

if (isset($_GET['id'])) {
    $ID_pns = $_GET['id'];

    // Menghapus entri pegawai dari tabel pegawai
    $stmt = $mysqli->prepare("DELETE FROM pegawai WHERE ID_pns=?");
    $stmt->bind_param("i", $ID_pns);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: index.php");
        exit();
    } else {
        echo "Tidak dapat menghapus entri pegawai.";
    }

    $stmt->close();
}

$mysqli->close();
?>
