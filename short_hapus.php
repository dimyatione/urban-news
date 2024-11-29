<?php 
include "../koneksi.php"; 
$id_short = $_GET['id'];
$detail = $koneksi->query("SELECT * FROM short WHERE id_short='$id_short'")->fetch_assoc();
unlink("../assets/img/cover".$detail['cover']);
$koneksi->query("DELETE FROM short WHERE id_short = '$id_short'");
echo "<script>
    alert('Berhasil Terhapus');
    window.location.href='short.php';
    </script>";

?>