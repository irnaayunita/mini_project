<?php
include "config/koneksi.php";
$nip = $_GET['nip'];
$query = "DELETE FROM guru WHERE nip = '$nip'";
mysqli_query($koneksi, $query);
header("Location: tampil_guru.php");
exit;
?>