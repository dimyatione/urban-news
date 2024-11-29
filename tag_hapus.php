<?php 
include "../koneksi.php";
$id_tag = $_GET['id'];
$detail = $koneksi->query("SELECT * FROM tag WHERE id_tag='$id_tag'")->fetch_assoc();

$koneksi->query("DELETE FROM tag WHERE id_tag ='$id_tag'");


echo "<script>alert('berhasil terhapus')</script>";
echo "<script>location='tag.php'</script>";
 ?>
 ?>