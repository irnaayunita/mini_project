<?php
session_start();
include 'config/koneksi.php';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

$query = "SELECT * FROM guru";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_all($hasil, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1 class="form-title">Data Guru</h1>
    <table border="1">
        <tr>
            <th>NIP</th>
            <th>Nama Guru</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>

            <?php if (strtolower($role) === 'administrator' || strtolower($role) === 'admin'): ?>
            <th>Aksi</th>
            <?php endif; ?>
        </tr>
        <?php foreach ($data as $guru): ?>
        <tr>
            <td><?php echo $guru['nip']; ?></td>
            <td><?php echo $guru['nama_guru']; ?></td>
            <td><?php echo $guru['jenis_kelamin']; ?></td>
            <td><?php echo $guru['jabatan']; ?></td>

             <?php if (strtolower($role) === 'administrator' || strtolower($role) === 'admin'): ?>
            <td>
                <a href="update_guru.php?nip=<?php echo $guru['nip']; ?>" class="update-zoom">🛠️Update</a>
                <a href="delete_guru.php?nip=<?php echo $guru['nip']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="delete">🗑️Delete</a>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>