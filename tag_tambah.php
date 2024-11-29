<?php 
include "header.php"


?>

<div class="card">
	<div class="card-header bg-info">
		<h6>Tambah Data</h6>
	</div>
	<div class="card-body">
		<form method="post" enctype="multipart form-data">
			<div class="mb-3">
				<label>Judul Tag</label>
				<input type="text" name="judul_tag" class="form-control" required>
			</div>

			<button class="btn btn-primary" name="simpan">Simpan</button>
		</form>
	</div>
</div>



<?php 
if (isset($_POST['simpan'])){
   $judul_tag = $_POST['judul_tag'];
   
   
   $koneksi->query("INSERT INTO tag (judul_tag) VALUES ('$judul_tag')");
   
   
   echo "<script>
            alert('berhasil tersimpan');
            window.location.href='tag.php';
         </script>";
}
?>



<?php 
include "footer.php"
 ?>