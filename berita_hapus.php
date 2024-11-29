<?php 
include "../koneksi.php"; 
$id_berita = $_GET['id'];
$detail = $koneksi->query("SELECT * FROM berita WHERE id_berita='$id_berita'")->fetch_assoc();
unlink("../assets/img/foto_berita".$detail['foto_berita']);
$koneksi->query("DELETE FROM berita WHERE id_berita = '$id_berita'");
echo "<script>
    alert('Berhasil Terhapus');
    window.location.href='index.php';
    </script>";

?>