<?php 
include "header.php"; 

$id_user = $_GET['id'];
$detail = $koneksi->query("SELECT * FROM user WHERE id_user= '$id_user' ")->
fetch_assoc();
?>

<div class="card">
	<div class="card-header bg-info">
		<h6>Tambah Data User</h6>
	</div>
	<div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<label>id User</label>
				<input type="number" name="id_user" class="form-control" readonly>
				<label>Username</label>
				<input type="text" name="username" class="form-control" value="<?php echo $detail['username']
			?>" class="form-control" required>
			<label>Email User</label>
			<input type="text" name="email_user" class="form-control" value="<?php echo $detail['email_user']
		?>" class="form-control" required>
		<label>Pasword User</label>
		<input type="password" id="pasword_user" name="pasword_user" class="form-control">
		<input type="checkbox" id="show_password" onclick="togglePassword()"> Show Password
		<br>
		<label>Nama</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $detail['nama']
	?>" class="form-control" required>
	<label>Kontak</label>
	<input type="number" name="kontak" class="form-control" value="<?php echo $detail['kontak']
?>" class="form-control" required>
<label>Jenis Kelamin</label>
<select name="jenis_kelamin" value="<?php echo $detail['jenis_kelamin']
?>" class="form-control" required>
<option>Laki-laki</option>
<option>Perempuan</option>
</select>

</div>
<div class="mb-3">
	<label class="form-label">Foto User</label>
	<input type="file" name="foto" class="form-control">
	<span class="text-danger small">Jika Tidak Ada Foto Maka Kosongkan</span>

</div>
<button class="btn btn-primary" name="simpan">Simpan</button>
</form>
</div>
</div>

<?php 
if(isset($_POST['simpan'])){
	$username = $_POST['username'];
	$email_user = $_POST['email_user'];
	$pasword_user = $_POST['pasword_user'];
	$nama = $_POST['nama'];
	$kontak = $_POST['kontak'];
	$jenis_kelamin = $_POST['jenis_kelamin'];

// bagian foto
	$nama_foto = $_FILES['foto']['name'];
	$filefoto = $_FILES['foto']['tmp_name'];

	if(empty($filefoto)) {

		$koneksi->query("UPDATE user SET 
			username = '$username',
			email_user = '$email_user',
			pasword_user = '$pasword_user',
			nama = '$nama',
			kontak = '$kontak',
			jenis_kelamin = '$jenis_kelamin',
			foto = '$nama_foto'
			WHERE id_user = '$id_user'");
	}

	else {

		move_uploaded_file($filefoto, "../assets/img/foto_user/".$nama_foto);
		$koneksi->query("UPDATE user SET 
			username = '$username',
			email_user = '$pasword_user',
			nama = '$nama',
			kontak = '$kontak',
			jenis_kelamin = '$jenis_kelamin'
			foto = '$nama_foto'
			WHERE id_user = '$id_user'");
	}


	echo "<script>alert('Berhasil Tersimpan')</script>";
	echo "<script>location='user.php'</script>";


}
?>