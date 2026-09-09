<?php
include "koneksi.php";

if (isset($_POST['submit'])) {
  $kode_mapel = $_POST['kode_mapel'];
  $nama_mapel = $_POST['nama_mapel'];
  $tingkat = $_POST['tingkat'];
  $alokasi_jam = $_POST['alokasi_jam'];
  $pengampu = $_POST['pengampu'];

  $query = "INSERT INTO mapel (kode_mapel, nama_mapel, tingkat, alokasi_jam, pengampu) VALUES ('$kode_mapel', '$nama_mapel', '$tingkat', '$alokasi_jam', '$pengampu')";
  $simpan = mysqli_query($koneksi, $query);

  if ($simpan) {
    header("location:tampil.php");
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
  <title>Tambah Data Mapel</title>
</head>
<body>
  <div class="card">
  <h1>Tambah Data Mapel</h1>
  <form action="" method="POST">
    <div class="form-group">
      <label for="kode_mapel">Kode Mapel:</label>
      <input type="text" id="kode_mapel" name="kode_mapel" placeholder="Masukkan Kode Mapel" required>
    </div>

    <div class="form-group">
      <label for="nama_mapel">Nama Mapel:</label>
      <input type="text" id="nama_mapel" name="nama_mapel" placeholder="Masukkan Nama Mapel" required>
    </div>

    <div class="form-group">
      <label for="tingkat">Tingkat:</label>
      <input type="text" id="tingkat" name="tingkat" placeholder="Masukkan Tingkat" required>
    </div>

    <div class="form-group">
      <label for="alokasi_jam">Alokasi Jam:</label>
      <input type="text" id="alokasi_jam" name="alokasi_jam" placeholder="Masukkan Alokasi Jam" required>
    </div>

    <div class="form-group">
      <label for="pengampu">Pengampu:</label>
      <input type="text" id="pengampu" name="pengampu" placeholder="Masukkan Pengampu" required>
    </div>

    <div class="btn-container">
      <button type="submit" name="submit" class="btn-zoom">Simpan</button>
      <a href="tampil.php" class="btn-back" class="btn-zoom">Kembali</a>
    </div>
  </form>
  </div>
</body>
</html>