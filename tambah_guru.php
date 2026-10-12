<?php
include "config/koneksi.php";

$error = "";

if (isset($_POST['submit'])) {
    $nip           = trim($_POST['nip']);
    $nama_guru     = trim($_POST['nama_guru']);
    $jenis_kelamin = trim($_POST['jenis_kelamin']);
    $jabatan       = trim($_POST['jabatan']);

    // Validasi NIP (Harus Angka)
    if (!ctype_digit($nip)) {
        $error = "NIP harus berupa angka!";
    }
    // Validasi Nama Guru (Huruf, Spasi, Titik, Koma, Petik)
    elseif (!preg_match("/^[a-zA-Z\s\.',]+$/", $nama_guru)) {
        $error = "Nama Guru hanya boleh berisi huruf dan tidak boleh mengandung angka!";
    } else {
        // Cek apakah NIP sudah ada
        $cek_nip = mysqli_query($koneksi, "SELECT * FROM guru WHERE nip = '$nip'");
        if (mysqli_num_rows($cek_nip) > 0) {
            $error = "NIP tersebut sudah terdaftar!";
        } else {
            $query = "INSERT INTO guru (nip, nama_guru, jenis_kelamin, jabatan) VALUES ('$nip', '$nama_guru', '$jenis_kelamin', '$jabatan')";
            $simpan = mysqli_query($koneksi, $query);
            if ($simpan) {
                header("location:tampil_guru.php");
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
  <title>Tambah Data Guru</title>
  <link rel="stylesheet" href="assets/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="container">
    <div class="form-card" style="margin: 20px auto;">
      <h1 class="form-title" style="margin-bottom: 20px;"><i class="fa-solid fa-user-plus"></i> Tambah Data Guru</h1>
      
      <?php if (!empty($error)): ?>
          <div style="background-color: #fee2e2; color: #dc2626; padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 15px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
              <i class="fa-solid fa-circle-exclamation"></i> <span><?php echo $error; ?></span>
          </div>
      <?php endif; ?>

      <form action="" method="POST">
        <div class="form-group">
          <label for="nip">NIP:</label>
          <input type="text" id="nip" name="nip" placeholder="Masukkan NIP" value="<?php echo htmlspecialchars($_POST['nip'] ?? ''); ?>" required autocomplete="off">
        </div>

        <div class="form-group">
          <label for="nama_guru">Nama Guru:</label>
          <input type="text" id="nama_guru" name="nama_guru" placeholder="Masukkan Nama Guru" value="<?php echo htmlspecialchars($_POST['nama_guru'] ?? ''); ?>" required autocomplete="off">
        </div>

        <div class="form-group">
          <label for="jenis_kelamin">Jenis Kelamin:</label>
          <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki" <?php if(isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
            <option value="Perempuan" <?php if(isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
          </select>
        </div>

        <div class="form-group">
          <label for="jabatan">Jabatan:</label>
          <input type="text" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan" value="<?php echo htmlspecialchars($_POST['jabatan'] ?? ''); ?>" required autocomplete="off">
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