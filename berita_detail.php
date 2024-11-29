<?php 
include "header.php";
?>
<?php 
$id_berita = $_GET['id'];
$berita = $koneksi->query ("SELECT * FROM berita LEFT JOIN admin ON berita.id_admin = admin.id_admin WHERE id_berita = '$id_berita'")->fetch_assoc();

$like = [];
$al = $koneksi->query ("SELECT * FROM `like` LEFT JOIN user ON user.id_user = like.id_user WHERE like.id_berita =  $id_berita");
while ($dl = $al->fetch_assoc())
{
	$like[]= $dl;
}

$komentar = [];
$ak = $koneksi->query ("SELECT * FROM `komentar` LEFT JOIN user ON user.id_user = komentar.id_user WHERE komentar.id_berita =  $id_berita");
while ($dk = $ak->fetch_assoc())
{
	$komentar[]= $dk;
}

$tag_berita = [];
$at = $koneksi->query ("SELECT * FROM tag_berita LEFT JOIN tag ON tag.id_tag = tag_berita.id_tag WHERE tag_berita.id_berita = $id_berita");
while ($dt = $at->fetch_assoc())

{
	$tag_berita[] = $dt;
}
?>


<div class="card">
	<div class="card-header">
		Berita Detail
	</div>
	<div class="card-body">
		<img src="../assets/img/foto_berita/<?php echo $berita ['foto_berita'] ?>" class="img-fluid w-100">
		<p class="text-muted fst-italic"><?php echo $berita ['caption_foto'] ?></p>
		<h3><?php echo $berita ['judul_berita'] ?></h3>
		<p><?php echo tanggal_indo($berita['tanggal_berita']); ?></p>
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modallike">
			<i class="bi bi-heart"></i>Like
		</button>
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalkomentar">
			<i class="bi bi-chat"></i>Komentar
		</button>

		<br>
		<p style="text-align: justify;">
			<?php echo $berita ['isi_berita'] ?>
		</p>
		<p>
			<?php foreach ($tag_berita as $key => $value): ?>
				<span class="text_primary">
					#&nbsp <?php echo $value['judul_tag'] ?>
				
				</span>
			<?php endforeach ?>
		</p>
	</div>
</div>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modallike" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?php foreach ($like as $key => $value): ?>
					<img src="../assets/img/foto_user/<?php echo $value['foto'] ?>" width="50" class="rounded-circle">&nbsp; |&nbsp;<?php echo $value ['nama'] ?>     	
				<?php endforeach ?>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalkomentar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">data komentar</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?php foreach ($komentar as $key => $value): ?>
					<img src="../assets/img/foto_user/<?php echo $value['foto'] ?>" width="50" class="rounded-circle">&nbsp; |&nbsp;<?php echo $value ['nama'] ?> 
					<br>
					<?php echo $value['isi_komentar'] ?>  
					<br>
					<span><?php echo date('d/m/Y', strtotime($value['waktu_komentar'])) ?></span>  	
				<?php endforeach ?>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

			</div>
		</div>
	</div>
</div>
<?php 
include "footer.php"; ?>