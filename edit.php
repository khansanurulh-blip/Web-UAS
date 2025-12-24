<?php 
require_once 'koneksi.php'; 
$id=intval($_GET['id']);
$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM tugas WHERE id=$id"));
$msg='';
if(isset($_POST['simpan'])){
    $judul=mysqli_real_escape_string($conn,trim($_POST['judul']));
    $deskripsi=mysqli_real_escape_string($conn,trim($_POST['deskripsi']));
    $deadline=mysqli_real_escape_string($conn,$_POST['deadline']);
    $kategori=mysqli_real_escape_string($conn,$_POST['kategori']);
    $sql="UPDATE tugas SET judul='$judul',deskripsi='$deskripsi',deadline='$deadline',kategori='$kategori' WHERE id=$id";
    if(mysqli_query($conn,$sql)) $msg='✅ Tugas berhasil diupdate!';
    else $msg='❌ Error: '.mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html><head>
    <title>Edit Tugas</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head><body style="max-width:600px;margin:50px auto;">
    <h1>Edit Tugas</h1>
    <?php if($msg) echo "<div style='padding:15px;border-radius:10px;margin:20px 0;font-weight:bold;color:#22c55e;background:rgba(34,197,94,0.2);'>$msg</div>"; ?>
    <a href="index.php" class="btn-kembali" style="display:inline-block;margin-bottom:20px;">← Kembali</a>
    <form method="POST">
        <input type="text" name="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" required>
        <textarea name="deskripsi"><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
        <input type="date" name="deadline" value="<?php echo $data['deadline']; ?>">
        <select name="kategori">
            <option value="">Kategori</option>
            <option value="Pribadi" <?php echo $data['kategori']=='Pribadi'?'selected':'';?>>Pribadi</option>
            <option value="Kerja" <?php echo $data['kategori']=='Kerja'?'selected':'';?>>Kerja</option>
            <option value="Belajar" <?php echo $data['kategori']=='Belajar'?'selected':'';?>>Belajar</option>
            <option value="Lainnya" <?php echo $data['kategori']=='Lainnya'?'selected':'';?>>Lainnya</option>
        </select>
        <button type="submit" name="simpan">UPDATE TUGAS</button>
    </form>
</body></html>
<?php mysqli_close($conn); ?>
