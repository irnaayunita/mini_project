<?php
include 'koneksi.php';
$query = "SELECT * FROM mapel";
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
    <h1>Data Mata Pelajaran</h1>
    <table border="1">
        <tr>
            <th>Kode Mapel</th>
            <th>Nama Mata Pelajaran</th>
            <th>Tingkat</th>
            <th>Alokasi Jam</th>
            <th>Pengampu</th>
        </tr>
        <?php foreach ($data as $mapel): ?>
        <tr>
            <td><?php echo $mapel['kode_mapel']; ?></td>
            <td><?php echo $mapel['nama_mapel']; ?></td>
            <td><?php echo $mapel['tingkat']; ?></td>
            <td><?php echo $mapel['alokasi_jam']; ?></td>
            <td><?php echo $mapel['pengampu']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>