<?php require_once 'koneksi.php'; 
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as jml FROM tugas"))['jml'] ?? 0;
$selesai = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as jml FROM tugas WHERE status='Selesai'"))['jml'] ?? 0;
$result = mysqli_query($conn, "SELECT * FROM tugas ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tugas Harian</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Manajemen Tugas Harian</h1>
    
    <div class="dashboard">
        <div class="card total"><h2><?php echo $total; ?></h2><p>Total</p></div>
        <div class="card pending"><h2><?php echo $total-$selesai; ?></h2><p>Pending</p></div>
        <div class="card selesai"><h2><?php echo $selesai; ?></h2><p>Selesai</p></div>
    </div>
    
    <div style="margin:20px 0;">
        <a href="tambah.php" class="btn-tambah" style="font-size:18px;padding:15px 30px;">TAMBAH TUGAS</a>
    </div>
    
    <input type="text" id="cari" placeholder="🔍 Cari tugas..." onkeyup="cariTugas()">
    
    <table>
        <tr><th>ID</th><th>Judul</th><th>Deskripsi</th><th>Deadline</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr>
        <?php if(mysqli_num_rows($result)>0): while($row=mysqli_fetch_assoc($result)): ?>
        <tr class="<?php echo $row['status']; ?>">
            <td data-label="ID"><?php echo $row['id']; ?></td>
            <td data-label="Judul"><?php echo htmlspecialchars($row['judul']); ?></td>
            <td data-label="Deskripsi"><?php echo strlen($row['deskripsi'])>30?substr(htmlspecialchars($row['deskripsi']),0,30).'..':htmlspecialchars($row['deskripsi']); ?></td>
            <td data-label="Deadline"><?php echo $row['deadline']?:'-'; ?></td>
            <td data-label="Kategori"><?php echo htmlspecialchars($row['kategori']?:'-'); ?></td>
            <td data-label="Status"><?php echo $row['status']; ?></td>
            <td data-label="Aksi">
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-edit">✏️ EDIT</a>
                <?php if($row['status']=='Pending'): ?>
                <a href="selesai.php?id=<?php echo $row['id']; ?>" class="btn-selesai" onclick="return confirm('Selesai?')">✅ SELESAI</a>
                <?php endif; ?>
                <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn-hapus" onclick="return confirm('Hapus?')">🗑️ HAPUS</a>
            </td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="7" style="text-align:center;padding:40px;">📭 Belum ada tugas</td></tr>
        <?php endif; ?>
    </table>

    <script>
    function cariTugas(){
        let input=document.getElementById('cari').value.toLowerCase();
        let tr=document.querySelectorAll('table tr');
        for(let i=1;i<tr.length;i++){
            let td=tr[i].getElementsByTagName('td')[1];
            if(td) tr[i].style.display=td.textContent.toLowerCase().indexOf(input)>-1?'':'none';
        }
    }
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>
