<?php
include 'koneksi.php';
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
    <style> 
    </style>
</head>
<body>
    <h1>Data Guru</h1>
    <table border="1">
        <tr>
            <th>NIP</th>
            <th>Nama Guru</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Mata Pelajaran diampu</th>
        </tr>
        <?php foreach ($data as $guru): ?>
        <tr>
            <td><?php echo $guru['nip']; ?></td>
            <td><?php echo $guru['nama_guru']; ?></td>
            <td><?php echo $guru['jenis_kelamin']; ?></td>
            <td><?php echo $guru['jabatan']; ?></td>
            <td><?php echo $guru['mapel_diampu']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>