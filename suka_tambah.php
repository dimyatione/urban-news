<?php 
include "koneksi.php";
$id_berita = $_GET['idb'];
$id_user = $_SESSION['user']['id_user'];

// cek user yang sudah like
$cek_user = $koneksi->query("SELECT * FROM `like` WHERE id_user='$id_user' AND id_berita='$id_berita'")->fetch_assoc();
 
// validasi apakah user sudah login
if(empty($_SESSION['user'])){
echo "<script>alert('anda harus login');location='login.php?id=$id_berita'</script>";

}

// validasi dislike
elseif (isset($cek_user)) {
	$koneksi->query("DELETE FROM `like` WHERE id_user='$id_user' AND id_berita='$id_berita'");
echo "<script>alert('dislike berhasil');location='berita_detail.php?id=$id_berita'</script>";
}

// validasi bila belum ada data maka nambha ke tabel like

else{
	$id_user = $_SESSION['user']['id_user'];
	$koneksi->query("INSERT INTO `like` (id_berita,id_user) VALUES ('$id_berita','$id_user')");
	echo "<script>alert('anda berhasil like');location='berita_detail.php?id=$id_berita'</script>";

}
 ?>



