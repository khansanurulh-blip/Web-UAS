<?php
include 'koneksi.php';
if (isset($_GET['update'])) {
    $id = $_GET['update'];
    mysqli_query($conn, "UPDATE tugas SET status='Selesai' WHERE id=$id");
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM tugas WHERE id=$id");
}
header("Location: index.php");
mysqli_close($conn);
?>
