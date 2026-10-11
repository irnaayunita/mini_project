<?php
include "config/koneksi.php";
$nip = $_GET['nip'] ?? $_POST['nip'] ?? '';
$error = '';

if (isset($_POST['submit'])) {
    $nip = $_POST['nip'];
    $nama_guru = $_POST['nama_guru'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jabatan = $_POST['jabatan'];

    // Validasi Nama guru hanya boleh berisi huruf dan spasi/titik/koma
    if (!preg_match("/^[a-zA-Z\s.,]+$/", $nama_guru)) {
        $error = "Nama guru harus diisi dengan huruf!";
    } else {
        $query = "UPDATE guru SET nama_guru = '$nama_guru', jenis_kelamin = '$jenis_kelamin', jabatan = '$jabatan' WHERE nip = '$nip'";
        mysqli_query($koneksi, $query);
        header("Location: tampil_guru.php");
        exit;
    }
}

$query_lama = "SELECT * FROM guru WHERE nip = '$nip'";
$hasil_lama = mysqli_query($koneksi, $query_lama);
$lama = mysqli_fetch_assoc($hasil_lama);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Guru</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="update-card" style="margin: 20px auto;">
            <div class="update-header" style="margin-bottom: 20px;">
                <h2><i class="fa-solid fa-user-edit"></i> Update Data Guru</h2>
            </div>

            <?php if (!empty($error)): ?>
                <div style="background-color: #fee2e2; color: #dc2626; padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 15px; font-weight: 600;">
                    <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <!-- NIP disembunyikan untuk proses update, dan ditampilkan sebagai teks statis -->
                <input type="hidden" name="nip" value="<?php echo htmlspecialchars($lama['nip'] ?? ''); ?>">
                
                <div class="form-group">
                    <label>NIP</label>
                    <div style="padding: 10px 14px; background-color: #f1f5f9; border: 1px solid var(--border-color); border-radius: 8px; font-size: 14px; color: var(--text-muted); font-weight: 600;">
                        <?php echo htmlspecialchars($lama['nip'] ?? ''); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Guru</label>
                    <input type="text" name="nama_guru" value="<?php echo htmlspecialchars($lama['nama_guru'] ?? ''); ?>" placeholder="Nama Guru" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="jenis_kelamin" value="<?php echo htmlspecialchars($lama['jenis_kelamin'] ?? ''); ?>" placeholder="Jenis Kelamin" required>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" value="<?php echo htmlspecialchars($lama['jabatan'] ?? ''); ?>" placeholder="Jabatan" required>
                </div>
                
                <div class="btn-container" style="justify-content: flex-start; gap: 10px; margin-top: 20px;">
                    <button type="submit" name="submit" class="btn-zoom">Update</button>
                    <a href="tampil_guru.php" class="btn-back">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>