<?php 
include "header.php" 
$berita = array();
$ambil = $koneksi->query("SELECT * FROM berita");
while ($detail = $ambil->fetch_assoc()){
	$berita[] = $detail;
}
?>
<div class="card mt-3">
	<div class="card-header bg-info">
		<h6>Tampil Berita</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-striped table-hover table-sm">
			<thead>
				<tr class=""text-center>
					<th>id_Berita</th>
					<th>id_admin</th>
					<th>id_kategori</th>
					<th>Judul Berita</th>
					<th>Tanggal Berita</th>
					<th>Isi Berita</th>
					<th>Foto Berita</th>
					<th>Caption Berita</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($berita as $key => $value): ?>
					<tr>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $value['id_admin']; ?></td>
						<td><?php echo $value['id_kategori'] ?></td>
						<td><?php echo $value['judul_berita'] ?></td>
					</tr>
					
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>