<?php
include "config/koneksi.php";
$kode_mapel = $_GET['kode_mapel'] ?? $_POST['kode_mapel'] ?? '';
$error = '';

if (isset($_POST['submit'])) {
    $kode_mapel = $_POST['kode_mapel'];
    $nama_mapel = $_POST['nama_mapel'];
    $tingkat = $_POST['tingkat'];
    $alokasi_jam = $_POST['alokasi_jam'];

    // Validasi Nama mapel hanya boleh berisi huruf dan karakter nama umum
    if (!preg_match("/^[a-zA-Z\s.,]+$/", $nama_mapel)) {
        $error = "Nama mata pelajaran harus diisi dengan huruf!";
    } else {
        $query = "UPDATE mapel SET kode_mapel = '$kode_mapel', nama_mapel = '$nama_mapel', tingkat = '$tingkat', alokasi_jam = '$alokasi_jam' WHERE kode_mapel = '$kode_mapel'";
        mysqli_query($koneksi, $query);
        header("Location: tampil_mapel.php");
        exit;
    }
}

$query_lama = "SELECT * FROM mapel WHERE kode_mapel = '$kode_mapel'";
$hasil_lama = mysqli_query($koneksi, $query_lama);
$lama = mysqli_fetch_assoc($hasil_lama);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Mapel</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="update-card">
        <div class="update-header">
            <h2><i class="fa-solid fa-book-open"></i> Update Data Mapel</h2>
            <p>Mohon lengkapi formulir di bawah ini untuk mengupdate data mapel.</p>
        </div>

        <?php if (!empty($error)): ?>
            <div style="background-color: #fee2e2; color: #dc2626; padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 15px; font-weight: 600;">
                <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Kode Mapel</label>
                <input type="text" name="kode_mapel" value="<?php echo htmlspecialchars($lama['kode_mapel'] ?? ''); ?>" readonly placeholder="Kode Mapel">
            </div>
            <div class="form-group">
                <label>Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" value="<?php echo htmlspecialchars($lama['nama_mapel'] ?? ''); ?>" placeholder="Nama Mata Pelajaran" required>
            </div>
            <div class="form-group">
                <label>Tingkat</label>
                <input type="text" name="tingkat" value="<?php echo htmlspecialchars($lama['tingkat'] ?? ''); ?>" placeholder="Tingkat" required>
            </div>
            <div class="form-group">
                <label>Alokasi Jam</label>
                <input type="text" name="alokasi_jam" value="<?php echo htmlspecialchars($lama['alokasi_jam'] ?? ''); ?>" placeholder="Alokasi Jam" required>
            </div>
            
            <div class="btn-container" style="justify-content: flex-start; gap: 10px;">
                <button type="submit" name="submit" class="btn-zoom">Update</button>
                <a href="tampil_mapel.php" class="btn-back">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>