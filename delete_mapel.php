<?php
include "config/koneksi.php";
$kode_mapel = $_GET['kode_mapel'];
$query = "DELETE FROM mapel WHERE kode_mapel = '$kode_mapel'";
mysqli_query($koneksi, $query);
header("Location: tampil_mapel.php");
exit;
?>