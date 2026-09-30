<?php
session_start();
include 'config/koneksi.php';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

$query = "SELECT * FROM guru";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_all($hasil, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Guru</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1 class="form-title">Data Guru</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama Guru</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>

                <?php if (strtolower($role) === 'administrator' || strtolower($role) === 'admin'): ?>
                <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $guru): ?>
            <tr>
                <td><?php echo htmlspecialchars($guru['nip']); ?></td>
                <td><?php echo htmlspecialchars($guru['nama_guru']); ?></td>
                <td><?php echo htmlspecialchars($guru['jenis_kelamin']); ?></td>
                <td><?php echo htmlspecialchars($guru['jabatan']); ?></td>

                <?php if (strtolower($role) === 'administrator' || strtolower($role) === 'admin'): ?>
                <td>
                    <a href="update_guru.php?nip=<?php echo $guru['nip']; ?>" class="update-zoom">🛠️ Update</a>
                    <a href="delete_guru.php?nip=<?php echo $guru['nip']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="delete">🗑️ Delete</a>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="btn-container">
        <a href="index.php" class="btn-back btn-zoom">Kembali</a>
    </div>
</body>
</html>