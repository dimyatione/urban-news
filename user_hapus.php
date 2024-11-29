<?php 
include "../koneksi.php";

$id_user = $_GET['id'];
$detail = $koneksi->query("SElECT * FROM user WHERE id_user='$id_user'")->fetch_assoc();

unlink("../assets/img/foto_user/".$detail['foto_user']);

$koneksi->query("DELETE FROM user WHERE id_user='$id_user'");


echo "<script>alert('berhasil terhapus')</script>";
echo "<script>location='user.php'</script>";
 ?>