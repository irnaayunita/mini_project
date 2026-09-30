<?php
session_start();
include 'config/koneksi.php';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

$query = "SELECT * FROM mapel";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_all($hasil, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mata Pelajaran</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1 class="form-title">Data Mata Pelajaran</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>Kode Mapel</th>
                <th>Nama Mata Pelajaran</th>
                <th>Tingkat</th>
                <th>Alokasi Jam</th>

                <?php if (strtolower($role) === 'administrator' || strtolower($role) === 'admin'): ?>
                <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $mapel): ?>
            <tr>
                <td><?php echo htmlspecialchars($mapel['kode_mapel']); ?></td>
                <td><?php echo htmlspecialchars($mapel['nama_mapel']); ?></td>
                <td><?php echo htmlspecialchars($mapel['tingkat']); ?></td>
                <td><?php echo htmlspecialchars($mapel['alokasi_jam']); ?></td>

                <?php if (strtolower($role) === 'administrator' || strtolower($role) === 'admin'): ?>
                <td>
                    <a href="update_mapel.php?kode_mapel=<?php echo $mapel['kode_mapel']; ?>" class="update-zoom">🛠️️ Update</a>
                    <a href="delete_mapel.php?kode_mapel=<?php echo $mapel['kode_mapel']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="delete">🗑️ Delete</a>
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