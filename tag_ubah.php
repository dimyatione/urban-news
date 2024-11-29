<?php 
include "header.php";

$id_tag = $_GET['id'];


$detail = $koneksi->query("SELECT * FROM tag WHERE id_tag='$id_tag'")->fetch_assoc();


?>

<div class="card">
	<div class="card-header bg-info">
		<h6>Ubah Data Tag</h6>
	</div>
	<div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<label>Judul Tag</label>
				<input type="text" name="judul_tag" value="<?php echo htmlspecialchars($detail['judul_tag']); ?>" class="form-control" required>
			</div>
			<button class="btn btn-primary" name="simpan">Simpan</button>
		</form>
	</div>
</div>

<?php 
if (isset($_POST['simpan'])) {
	$judul_tag = $_POST['judul_tag'];

	
	$koneksi->query("UPDATE tag SET judul_tag='$judul_tag' WHERE id_tag='$id_tag'");

	echo "<script>alert('Berhasil Tersimpan')</script>";
	echo "<script>location='tag.php'</script>"; }?>

	<?php 
	include "footer.php"; 
	?>
