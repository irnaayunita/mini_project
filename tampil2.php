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
</head>
<body>
    <h1>Data Mata Pelajaran</h1>
    <table border="1">
        <tr>
            <th>Kode Mapel</th>
            <th>Nama Mapel</th>
            <th>Tingkat</th>
            <th>Alokasi Waktu</th>
            <th>Pengampu</th>
        </tr>
        <?php foreach ($data as $row): ?>
        <tr>
            <td><?php echo $row['kode_mapel']; ?></td>
            <td><?php echo $row['nama_mapel']; ?></td>
            <td><?php echo $row['tingkat']; ?></td>
            <td><?php echo $row['alokasi_jam']; ?></td>
            <td><?php echo $row['pengampu']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>