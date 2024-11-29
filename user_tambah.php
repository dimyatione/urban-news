<?php 
include "header.php"; ?>

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
				<input type="text" name="username" class="form-control">
				<label>Nama</label>
				<input type="text" name="nama" class="form-control">
				<label>Email User</label>
				<input type="text" name="email_user" class="form-control">
				<label>Pasword User</label>
				<input type="password" id="pasword_user" name="pasword_user" class="form-control">
				<input type="checkbox" id="show_password" onclick="togglePassword()"> Show Password
				<br>
				
				<label>Kontak</label>
				<input type="number" name="kontak" class="form-control">
				<label>Jenis Kelamin</label>
				<select name="jenis_kelamin">
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
$nama = $_POST['nama'];
$email_user = $_POST['pasword_user'];
$pasword_user =sha1 ($_POST['pasword_user']);

$kontak = $_POST['kontak'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$pasword = $_POST['pasword_user'];

// bagian foto
$nama_foto = $_FILES['foto']['name'];
$filefoto = $_FILES['foto']['tmp_name'];
move_uploaded_file($filefoto, "../assets/img/foto_user/".$nama_foto);
$koneksi->query("INSERT INTO user (username,nama,email_user,pasword_user,,kontak,jenis_kelamin,foto) VALUES ('$username','$nama','$email_user','$pasword_user','$kontak','$jenis_kelamin','$foto')");

echo "<script>
    alert('Berhasil tersimpan');
    window.location.href='user.php';
    </script>";

} ?>

<script>
function togglePassword() {
    var passwordField = document.getElementById("pasword_user");
    var checkBox = document.getElementById("show_password");
    if (checkBox.checked) {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}
</script>

<?php 
include "footer.php";
 ?>