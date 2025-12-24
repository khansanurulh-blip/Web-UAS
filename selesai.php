<?php
require_once 'koneksi.php';
$id=intval($_GET['id']);
mysqli_query($conn,"UPDATE tugas SET status='Selesai' WHERE id=$id");
header("Location: index.php");
mysqli_close($conn);
?>
