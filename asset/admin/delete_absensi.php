<?php
include '../../config.php';

// Pastikan ID absensi disediakan melalui parameter GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM Absensi WHERE ID_Absensi = ?");
    $stmt->bind_param("i", $id); 

    if ($stmt->execute()) {
        header("Location: kehadiran.php");
        exit();
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo "ID absensi tidak disediakan.";
}
?>
