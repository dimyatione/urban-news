<?php 
include "header.php";

$id_kategori = $_GET['id'];
$detail = $koneksi->query("SELECT * FROM kategori WHERE id_kategori= '$id_kategori'")->fetch_assoc();

 ?>
 <div class="card">
	<div class="card-header bg-info">
		<h6>Tambah Data</h6>
	</div>
	<div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<label>Nama Kategori</label>
				<input type="text" name="nama_kategori" value="<?php echo $detail['nama_kategori']
				 ?>" class="form-control" required>
			</div>

			<div class="mb-3">
				<img src="../assets/img/kategori/<?php echo $detail['foto_kategori'] ?>" width='100'>
				<br>
				<label>Foto Kategori</label>
				<input type="file" name="foto_kategori" class="form-control" >
				<span class="text-danger small">Jika Tidak Mengubah Foto Maka Kosongkan</span>
			</div>
			<button class="btn btn-primary" name="simpan">Simpan</button>
		</form></div>
		
	</div>

	<?php 
	if (isset($_POST['simpan'])){


		$nama_kategori = $_POST['nama_kategori'];
		$nama_foto = $_FILES['foto_kategori']['name'];
		
		$filefoto = $_FILES['foto_kategori']['tmp_name'];

		if (empty($filefoto)) {

			$koneksi->query("UPDATE kategori SET 
    nama_kategori = '$nama_kategori',
    foto_kategori = '$foto_kategori'
    WHERE id_kategori = '$id_kategori'");

		}
		else {

	     move_uploaded_file($filefoto, "../assets/img/kategori/".$nama_foto);



		$koneksi->query("UPDATE kategori SET 
    nama_kategori = '$nama_kategori',
    foto_kategori = '$foto_kategori'
    WHERE id_kategori = '$id_kategori'");



		}
	

		echo "<script>alert('Berhasil Tersimpan')</script>";
		echo "<script>location='kategori.php'</script>";
	} ?>
	<?php 
	include "footer.php" ?>

