<?php
include "config/koneksi.php";
$nip =$_GET['nip'] ?? $_POST['nip'] ?? '';
// var_dump($nip);
if (isset($_POST['submit'])) {
    $nip = $_POST['nip'];
    $nama_guru = $_POST['nama_guru'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jabatan = $_POST['jabatan'];

    $query = "UPDATE guru SET nip = '$nip', nama_guru = '$nama_guru', jenis_kelamin = '$jenis_kelamin', jabatan = '$jabatan' where nip ='$nip'";
    mysqli_query($koneksi, $query);
    header("Location:tampil_guru.php");
    exit;
}
    $query_lama = "SELECT * FROM guru WHERE nip ='$nip'";
    $hasil_lama = mysqli_query($koneksi, $query_lama);
    $lama = mysqli_fetch_assoc($hasil_lama);
   // var_dump($lama);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data guru</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="update-card">
        <div class="update-header">
            <h2><i class="fa-solid fa-user-edit"></i> Update Data guru</h2>
            <p>Mohon lengkapi formulir di bawah ini untuk mengupdate data guru.</p>
        </div>
    <form action="" method="POST">
    <!-- Menggunakan isset/null coalescing agar tidak mencetak warning di value -->
    <input type="text" name="nip" value="<?php echo $lama['nip'] ?? ''; ?>" readonly placeholder="nip">
    <input type="text" name="nama_guru" value="<?php echo $lama['nama_guru'] ?? ''; ?>" placeholder="Nama Mata Pelajaran">
    <input type="text" name="jenis_kelamin" value="<?php echo $lama['jenis_kelamin'] ?? ''; ?>" placeholder="Tingkat">
    <input type="text" name="jabatan" value="<?php echo $lama['jabatan'] ?? ''; ?>" placeholder="Alokasi Jam">
    
    <button type="submit" name="submit" class="btn-zoom">Update</button>
    <a href="index.php" class="btn-back" class="btn-zoom">Kembali</a>
</form>
</body>
</html>