<?php 
include "header.php";
 ?>
<?php 
$saran = array();
$ambil = $koneksi->query("SELECT * FROM saran");

while ($detail = $ambil->fetch_assoc()){
$saran[] = $detail;

}
 ?>

 <div class="card mt-3">
	<div class="card-header bg-info">
		<h6>Saran</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-striped table-hover table-sm">
			<thead>
				<tr class="text-center">
					<th>No</th>
					<th>Email</th>
					<th>Saran</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($saran as $key => $value): ?>
					<tr>
						<td class="text-center"><?php echo $key+1; ?></td>
						
						<td class="text-center"><?php echo $value['email']; ?></td>
						<td class="text-center"><?php echo $value['isi'] ?>
							
						</td>
					</tr>
				<?php endforeach ?>

			</tbody>
		</table>
		<a href="tag_tambah.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i>Tambah</a>
	</div>
</div>



 <?php 
include "footer.php";
  ?>