<?php include "header.php" ?>
<?php 
$id_admin = $_SESSION['kontributor']['id_admin'];

$detail = $koneksi->query("SELECT * FROM admin WHERE id_admin= '$id_kontributor'")->fetch_assoc();
?>
<div class="card">
	<div class="card_header">
		<h6>Profil Kontributor</h6>
	</div>
	<div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<label>Username</label>
				<input type="text" name="username" value="<?php echo $detail['username'] ?>" class="form-control">
			</div>
			<div class="mb-3">
				<label>Pasword</label>
				<input type="password" name="pasword" value="" class="form-control">
			</div>
			<div class="mb-3">
				<label>Nama</label>
				<input type="text" name="nama" value="<?php echo $detail['nama'] ?>" class="form-control">
			</div>
			<div class="mb-3">
				<img src="../assets/img/kontributor/<?php echo $detail['foto'] ?>" width='100'>
				<br>
				<label>Foto Admin</label>
				<input type="file" name="foto" class="form-control">
				
				<button class="btn btn-primary" name="simpan">Simpan</button>
			</div>
		</form>
	</div>
</div>

<?php 
if (isset($_POST['simpan'])) {
	

	$username = $_POST['username'];
	$nama = $_POST['nama'];
	$pasword = $_POST['pasword'];
	$pw=sha1($pasword);

	$namafoto = $_FILES['foto']['name'];
	$filefoto = $_FILES['foto']['tmp_name'];

	if (empty($filefoto)) {
		
		if (empty($pasword)) {
			$koneksi->query("UPDATE admin SET username='$username',
				nama='$nama' WHERE id_admin = '$id_admin'");
		} else {


			$koneksi->query("UPDATE admin SET username='$username',
				nama='$nama',pasword='$pw' WHERE id_admin= '$id_admin'");
		}

	} else {
		if (empty($pasword)) {
			move_uploaded_file($filefoto,"../assets/img/kontributor/".$namafoto);
			$koneksi->query("UPDATE admin SET username='$username',nama='$nama',
				foto='$namafoto' WHERE id_admin= '$id_admin'");
		}else {
			move_uploaded_file($filefoto,"../assets/img/admin/".$namafoto);
			$koneksi->query("UPDATE admin SET username='$username',nama='$nama',
				pasword='$pw',
				foto='$namafoto' WHERE id_admin= '$id_admin'");
		}
	}
	  echo "<script>
    alert('Berhasil terubah');
    window.location.href='profile.php';
    </script>";
}
?>
















<?php include "footer.php" ?>