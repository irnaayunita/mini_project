<?php
include 'config/koneksi.php';
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
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1 class="form-title">Data Mata Pelajaran</h1>
    <table border="1">
        <tr>
            <th>Kode Mapel</th>
            <th>Nama Mata Pelajaran</th>
            <th>Tingkat</th>
            <th>Alokasi Jam</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($data as $mapel): ?>
        <tr>
            <td><?php echo $mapel['kode_mapel']; ?></td>
            <td><?php echo $mapel['nama_mapel']; ?></td>
            <td><?php echo $mapel['tingkat']; ?></td>
            <td><?php echo $mapel['alokasi_jam']; ?></td>
            <td>
                <a href="update_mapel.php?kode_mapel=<?php echo $mapel['kode_mapel']; ?>" class="update-zoom">🛠️Update</a>
                <a href="delete_mapel.php?kode_mapel=<?php echo $mapel['kode_mapel']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="delete">🗑️Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>