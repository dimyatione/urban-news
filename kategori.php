<?php 
include "header.php";


$kategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");

while ($detail = $ambil->fetch_assoc()){
	$kategori[] = $detail;

	
	
}
error_reporting(E_ALL);
ini_set('display_errors', 1);



 ?>


<div class="card mt-3">
	<div class="card-header bg-info">
		<h6>Tampil Kategori</h6>
	</div>
		<div class="card-body">
			<table class="table table-bordered table-striped table-hover table-sm">
				<thead>
					<tr class="text-center">
						<th>No</th>
						<th>Nama</th>
						<th>Foto</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($kategori as $key => $value): ?>
						
					
					<tr>
						<td> <?php echo $key+1; ?></td>
						<td> <?php echo $value['nama_kategori']; ?></td>
						<td> <img src="../assets/img/kategori/<?php echo $value ['foto_kategori']; ?>"
							width="100"></td>
						<td> 
							<a href="kategori_ubah.php?id=<?php echo $value ['id_kategori']; ?>" class="btn btn-warning btn-sm" title="ubah"><i class="bi bi-pencil-square"></i></a>
							<a href="kategori_hapus.php?id=<?php echo $value ['id_kategori']; ?>" class="btn btn-danger btn-sm" title="ubah"><i class="bi bi-trash"></i></a>
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<a href="kategori_tambah.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i>Tambah</a>
		</div >
	</div>

