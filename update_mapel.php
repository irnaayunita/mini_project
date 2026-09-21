<?php
include "config/koneksi.php";
$kode_mapel =$_GET['kode_mapel'] ?? $_POST['kode_mapel'] ?? '';
// var_dump($kode_mapel);
if (isset($_POST['submit'])) {
    $kode_mapel = $_POST['kode_mapel'];
    $nama_mapel = $_POST['nama_mapel'];
    $tingkat = $_POST['tingkat'];
    $alokasi_jam = $_POST['alokasi_jam'];

    $query = "UPDATE mapel SET kode_mapel = '$kode_mapel', nama_mapel = '$nama_mapel', tingkat = '$tingkat', alokasi_jam = '$alokasi_jam' where kode_mapel ='$kode_mapel'";
    mysqli_query($koneksi, $query);
    header("Location:tampil_mapel.php");
    exit;
}
    $query_lama = "SELECT * FROM mapel WHERE kode_mapel ='$kode_mapel'";
    $hasil_lama = mysqli_query($koneksi, $query_lama);
    $lama = mysqli_fetch_assoc($hasil_lama);
   // var_dump($lama);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Mapel</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="update-card">
        <div class="update-header">
            <h2><i class="fa-solid fa-user-edit"></i> Update Data Mapel</h2>
            <p>Mohon lengkapi formulir di bawah ini untuk mengupdate data mapel.</p>
        </div>
    <form action="" method="POST">
    <!-- Menggunakan isset/null coalescing agar tidak mencetak warning di value -->
    <input type="text" name="kode_mapel" value="<?php echo $lama['kode_mapel'] ?? ''; ?>" readonly placeholder="Kode Mapel">
    <input type="text" name="nama_mapel" value="<?php echo $lama['nama_mapel'] ?? ''; ?>" placeholder="Nama Mata Pelajaran">
    <input type="text" name="tingkat" value="<?php echo $lama['tingkat'] ?? ''; ?>" placeholder="Tingkat">
    <input type="text" name="alokasi_jam" value="<?php echo $lama['alokasi_jam'] ?? ''; ?>" placeholder="Alokasi Jam">
    
    <button type="submit" name="submit" class="btn-zoom">Update</button>
    <a href="index.php" class="btn-back" class="btn-zoom">Kembali</a>
</form>
</body>
</html>