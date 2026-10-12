<?php
include "config/koneksi.php";

$kode_mapel = $_GET['kode_mapel'] ?? $_POST['kode_mapel'] ?? '';
$error = '';

if (isset($_POST['submit'])) {
    $kode_mapel  = $_POST['kode_mapel'];
    $nama_mapel  = trim($_POST['nama_mapel']);
    $tingkat     = trim($_POST['tingkat']);
    $alokasi_jam = trim($_POST['alokasi_jam']);

    // Validasi Nama Mapel
    if (!preg_match("/^[a-zA-Z\s\.',]+$/", $nama_mapel)) {
        $error = "Nama mata pelajaran hanya boleh berisi huruf!";
    } else {
        $query = "UPDATE mapel SET nama_mapel = '$nama_mapel', tingkat = '$tingkat', alokasi_jam = '$alokasi_jam' WHERE kode_mapel = '$kode_mapel'";
        $update = mysqli_query($koneksi, $query);
        if ($update) {
            header("Location: tampil_mapel.php");
            exit;
        } else {
            $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
        }
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
    <div class="container">
        <div class="update-card" style="margin: 20px auto;">
            <div class="update-header" style="margin-bottom: 20px;">
                <h2><i class="fa-solid fa-book-open"></i> Update Data Mapel</h2>
            </div>

            <?php if (!empty($error)): ?>
                <div style="background-color: #fee2e2; color: #dc2626; padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 15px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-circle-exclamation"></i> <span><?php echo $error; ?></span>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <input type="hidden" name="kode_mapel" value="<?php echo htmlspecialchars($lama['kode_mapel'] ?? $kode_mapel); ?>">

                <div class="form-group">
                    <label>Kode Mapel</label>
                    <div style="padding: 10px 14px; background-color: #f1f5f9; border: 1px solid var(--border-color); border-radius: 8px; font-size: 14px; color: var(--text-muted); font-weight: 600;">
                        <?php echo htmlspecialchars($lama['kode_mapel'] ?? $kode_mapel); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Mata Pelajaran</label>
                    <input type="text" name="nama_mapel" value="<?php echo htmlspecialchars($lama['nama_mapel'] ?? ''); ?>" placeholder="Nama Mata Pelajaran" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Tingkat</label>
                    <input type="text" name="tingkat" value="<?php echo htmlspecialchars($lama['tingkat'] ?? ''); ?>" placeholder="Tingkat" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Alokasi Jam</label>
                    <input type="text" name="alokasi_jam" value="<?php echo htmlspecialchars($lama['alokasi_jam'] ?? ''); ?>" placeholder="Alokasi Jam" required autocomplete="off">
                </div>
                
                <div class="btn-container" style="justify-content: center; gap: 12px; margin-top: 25px;">
                    <button type="submit" name="submit" class="btn-zoom">Update</button>
                    <a href="index.php" class="btn-back">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>