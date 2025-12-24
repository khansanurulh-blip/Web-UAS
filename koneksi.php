<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_praktiikum';
$port = 3307;  // Sesuai setup Anda

$conn = mysqli_connect($host, $username, $password, $database, $port);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
