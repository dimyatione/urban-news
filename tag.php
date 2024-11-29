<?php 
include "header.php";

$tag =  array();
$ambil = $koneksi->query("SELECT * FROM tag");

while ($detail = $ambil->fetch_assoc()){
	$tag[] = $detail;
}

// echo "<pre>";
// print_r($tag);
// echo "</pre>";


?>

<div class="card mt-3">
	<div class="card-header bg-info">
		<h6>Tag</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-striped table-hover table-sm">
			<thead>
				<tr class="text-center">
					<th>Id Tag</th>
					<th>Judul Tag</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($tag as $key => $value): ?>
					<tr>
						<td class="text-center"><?php echo $key+1; ?></td>
						
						<td class="text-center"><?php echo $value['judul_tag']; ?></td>
						<td class="text-center">
							<a href="tag_ubah.php?id=<?php echo $value ['id_tag'] ?>" class="btn btn-warning btn-sm" title="ubah"><i class="bi bi-pencil-square"></i>></a>
							<a href="tag_hapus.php?id=<?php echo $value ['id_tag'] ?>" class="btn btn-danger btn-sm" title="ubah"><i class="bi bi-trash"></i></a>
						</td>
					</tr>
				<?php endforeach ?>

			</tbody>
		</table>
		<a href="tag_tambah.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i>Tambah</a>
	</div>
</div>

<?php include "footer.php" ?>