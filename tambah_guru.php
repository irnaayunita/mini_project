<?php
include "config/koneksi.php";

if (isset($_POST['submit'])) {
  $nip = $_POST['nip'];
  $nama_guru = $_POST['nama_guru'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $jabatan = $_POST['jabatan'];

  $query = "INSERT INTO guru (nip, nama_guru, jenis_kelamin, jabatan) VALUES ('$nip', '$nama_guru', '$jenis_kelamin', '$jabatan')";
  $simpan = mysqli_query($koneksi, $query);

  if ($simpan) {
    header("location:tampil_guru.php");
    exit;
  } else {
    echo "<script>alert('Gagal menambahkan data!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Guru</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="form-card">
  <h1 class="form-title">Tambah Data Guru</h1>
  <form action="" method="POST">
    <div class="form-group">
      <label for="nip">NIP:</label>
      <input type="text" id="nip" name="nip" placeholder="Masukkan NIP" required>
    </div>

    <div class="form-group">
      <label for="nama_guru">Nama Guru:</label>
      <input type="text" id="nama_guru" name="nama_guru" placeholder="Masukkan Nama Guru" required>
    </div>

    <div class="form-group">
      <label for="jenis_kelamin">Jenis Kelamin:</label>
      <select id="jenis_kelamin" name="jenis_kelamin" required>
        <option value="">Pilih Jenis Kelamin</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
    </div>

    <div class="form-group">
      <label for="jabatan">Jabatan:</label>
      <input type="text" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan" required>
    </div>
  
    <div class="btn-container">
      <button type="submit" name="submit" class="btn-zoom">Simpan</button>
      <a href="index.php" class="btn-back" class="btn-zoom">Kembali</a>
    </div>
  </form>
  </div>
</body>
</html>