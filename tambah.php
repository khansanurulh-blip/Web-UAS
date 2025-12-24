<?php 
require_once 'koneksi.php'; 
$msg='';
if(isset($_POST['simpan'])){
    $judul=mysqli_real_escape_string($conn,trim($_POST['judul']));
    $deskripsi=mysqli_real_escape_string($conn,trim($_POST['deskripsi']));
    $deadline=mysqli_real_escape_string($conn,$_POST['deadline']);
    $kategori=mysqli_real_escape_string($conn,$_POST['kategori']);
    $sql="INSERT INTO tugas (judul,deskripsi,deadline,kategori,status) VALUES('$judul','$deskripsi','$deadline','$kategori','Pending')";
    if(mysqli_query($conn,$sql)) $msg='✅ Tugas berhasil ditambahkan!';
    else $msg='❌ Error: '.mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html><head>
    <title>Tambah Tugas</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head><body style="max-width:600px;margin:50px auto;">
    <h1>Tambah Tugas Baru</h1>
    <?php if($msg) echo "<div style='padding:15px;border-radius:10px;margin:20px 0;font-weight:bold;color:#22c55e;background:rgba(34,197,94,0.2);'>$msg</div>"; ?>
    <a href="index.php" class="btn-kembali" style="display:inline-block;margin-bottom:20px;">← Kembali</a>
    <form method="POST">
        <input type="text" name="judul" placeholder="Judul *" required maxlength="255">
        <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
        <input type="date" name="deadline">
        <select name="kategori">
            <option value="">Kategori</option>
            <option value="Pribadi">Pribadi</option><option value="Kerja">Kerja</option>
            <option value="Belajar">Belajar</option><option value="Lainnya">Lainnya</option>
        </select>
        <button type="submit" name="simpan">SIMPAN TUGAS</button>
    </form>
</body></html>
<?php mysqli_close($conn); ?>
