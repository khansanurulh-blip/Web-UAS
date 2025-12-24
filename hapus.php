<?php
require_once 'koneksi.php';
$id=intval($_GET['id']);
mysqli_query($conn,"DELETE FROM tugas WHERE id=$id");
header("Location: index.php");
mysqli_close($conn);
?>
