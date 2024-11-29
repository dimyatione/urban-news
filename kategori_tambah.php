<?php 

include "header.php"?>


<div class="card">
	<div class="card-header bg-info">
		<h6>Tambah Data</h6>
	</div>
	<div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<label>Nama Kategori</label>
				<input type="text" name="nama_kategori" class="form-control" required>
			</div>

			<div class="mb-3">
				<label>Foto Kategori</label>
				<input type="file" name="foto_kategori" class="form-control" required>
			</div>
			<button class="btn btn-primary" name="simpan">Simpan</button>
		</form></div>
		
	</div>

	<?php 
	if (isset($_POST['simpan'])){


		$nama_kategori = $_POST['nama_kategori'];
		$nama_foto = $_FILES['foto_kategori']['name'];
		
		$filefoto = $_FILES['foto_kategori']['tmp_name'];
		move_uploaded_file($filefoto, "../assets/img/kategori/".$nama_foto);
		$koneksi->query("INSERT INTO kategori (nama_kategori,foto_kategori) VALUES ('$nama_kategori','$nama_foto') ") ;


		 echo "<script>
    alert('Berhasil tersimpan');
    window.location.href='kategori.php';
    </script>";
	} ?>
	<?php 
	include "footer.php" ?>


