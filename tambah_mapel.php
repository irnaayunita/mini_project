<?php
include "config/koneksi.php";

$error = "";

if (isset($_POST['submit'])) {
    $kode_mapel  = trim($_POST['kode_mapel']);
    $nama_mapel  = trim($_POST['nama_mapel']);
    $tingkat     = trim($_POST['tingkat']);
    $alokasi_jam = trim($_POST['alokasi_jam']);

    // Validasi Kode Mapel (Harus Angka)
    if (!ctype_digit($kode_mapel)) {
        $error = "Kode Mapel harus berupa angka!";
    }
    // Validasi Nama Mapel (Huruf, Spasi, Titik, Koma, Petik)
    elseif (!preg_match("/^[a-zA-Z\s\.',]+$/", $nama_mapel)) {
        $error = "Nama Mapel hanya boleh berisi huruf dan tidak boleh mengandung angka!";
    } else {
        // Cek apakah Kode Mapel sudah ada
        $cek_kode = mysqli_query($koneksi, "SELECT * FROM mapel WHERE kode_mapel = '$kode_mapel'");
        if (mysqli_num_rows($cek_kode) > 0) {
            $error = "Kode Mapel tersebut sudah terdaftar!";
        } else {
            $query = "INSERT INTO mapel (kode_mapel, nama_mapel, tingkat, alokasi_jam) VALUES ('$kode_mapel', '$nama_mapel', '$tingkat', '$alokasi_jam')";
            $simpan = mysqli_query($koneksi, $query);
            if ($simpan) {
                header("location:tampil_mapel.php");
                exit;
            } else {
                $error = "Gagal menambahkan data: " . mysqli_error($koneksi);
            }
        }
    }
}
?>

<!DOCTYPE html>
  <html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Mapel</title>
  <link rel="stylesheet" href="assets/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="container">
    <div class="form-card" style="margin: 20px auto;">
      <h1 class="form-title" style="margin-bottom: 20px;"><i class="fa-solid fa-book-medical"></i> Tambah Data Mapel</h1>
      
      <?php if (!empty($error)): ?>
          <div style="background-color: #fee2e2; color: #dc2626; padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 15px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
              <i class="fa-solid fa-circle-exclamation"></i> <span><?php echo $error; ?></span>
          </div>
      <?php endif; ?>

      <form action="" method="POST">
        <div class="form-group">
          <label for="kode_mapel">Kode Mapel:</label>
          <input type="text" id="kode_mapel" name="kode_mapel" placeholder="Masukkan Kode Mapel" value="<?php echo htmlspecialchars($_POST['kode_mapel'] ?? ''); ?>" required autocomplete="off">
        </div>

        <div class="form-group">
          <label for="nama_mapel">Nama Mapel:</label>
          <input type="text" id="nama_mapel" name="nama_mapel" placeholder="Masukkan Nama Mapel" value="<?php echo htmlspecialchars($_POST['nama_mapel'] ?? ''); ?>" required autocomplete="off">
        </div>

        <div class="form-group">
          <label for="tingkat">Tingkat:</label>
          <input type="text" id="tingkat" name="tingkat" placeholder="Masukkan Tingkat" value="<?php echo htmlspecialchars($_POST['tingkat'] ?? ''); ?>" required autocomplete="off">
        </div>

        <div class="form-group">
          <label for="alokasi_jam">Alokasi Jam:</label>
          <input type="text" id="alokasi_jam" name="alokasi_jam" placeholder="Masukkan Alokasi Jam" value="<?php echo htmlspecialchars($_POST['alokasi_jam'] ?? ''); ?>" required autocomplete="off">
        </div>

        <div class="btn-container" style="justify-content: center; gap: 12px; margin-top: 25px;">
          <button type="submit" name="submit" class="btn-zoom">Simpan</button>
          <a href="index.php" class="btn-back">Kembali</a>
        </div>
      </form>
      </div>
  </div>
</body>
</html>