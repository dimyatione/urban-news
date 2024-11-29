<?php 
include "../koneksi.php";

$id_kategori = $_GET['id'];
$detail = $koneksi->query("SElECT * FROM kategori WHERE id_kategori='$id_kategori'")->fetch_assoc();

unlink("../assets/img/kategori/".$detail['foto_kategori']);

$koneksi->query("DELETE FROM kategori WHERE id_kategori='$id_kategori'");


echo "<script>alert('berhasil terhapus')</script>";
echo "<script>location='kategori.php'</script>";
 ?>