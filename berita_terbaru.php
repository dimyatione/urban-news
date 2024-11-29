<?php 
include "header.php"; ?>

<div class="single-news">
	<div class="container">
		<?php 
		$berita_terbaru=$koneksi->query("SELECT * FROM berita ORDER BY id_berita DESC")->fetch_assoc(); 
		$idk = $berita_terbaru['id_kategori'];

		$berita_terkait = array();
		$abt = $koneksi->query("SELECT * FROM berita
			LEFT JOIN kategori ON kategori.id_kategori = berita.id_kategori
			LEFT JOIN admin ON admin.id_admin = berita.id_admin 
			WHERE kategori.id_kategori='$idk'
			ORDER by id_berita DESC
			LIMIT 6");
		while ($dbt = $abt->fetch_assoc()){
			$berita_terkait[] = $dbt;
		}
		?>
		<div class="row">
			<!-- Kolom konten berita utama -->
			<div class="col-md-8">
				<div class="sn-container">
					<div class="sn-img">
						<img src="assets/img/foto_berita/<?php echo $berita_terbaru['foto_berita'] ?>" class="img-fluid" />
					</div>
					<div class="sn-content">
						<h1 class="sn-title"><?php echo $berita_terbaru['judul_berita'] ?></h1>
						<p>
							<?php echo $berita_terbaru['isi_berita'] ?>
						</p>
					</div>
				</div>
			</div>


			<!-- Kolom daftar berita di sebelah kanan dengan scrall -->
			<?php 
			$bb=array();
			$ab=$koneksi->query("SELECT * FROM berita LEFT JOIN admin ON admin.id_admin=berita.id_admin ORDER by id_berita DESC LIMIT 6");
			while($db = $ab->fetch_assoc())
			{
				$bb[]=$db;
			} ?>

			<div class="col-md-4">
				<!-- Judul di luar div yang memiliki scroll -->
				<h4 class="mb-3" style="font-style: italic;">Berita Terbaru</h4>


				<!--  daftar card yang bisa di-scroll -->
				<div style="max-height: 600px; overflow-y: scroll;">
					<?php foreach ($bb as $kb => $vb): ?>
						<div class="card mb-3 shadow-sm">
							<div class="row g-0">
								<div class="col-md-4">
									<img src="assets/img/foto_berita/<?php echo $vb['foto_berita'] ?>" class="img-fluid rounded-start" alt="Image for <?php echo $vb['judul_berita']; ?>">
								</div>
								<div class="col-md-8">
									<div class="card-body">
										<h6 class="card-title">
											<a href="berita_detail.php?id=<?php echo $vb['id_berita'] ?>" class="text-decoration-none text-dark"><?php echo $vb['judul_berita'] ?></a>
										</h6>
										<p class="card-text"><small class="text-muted"><?php echo tanggal_indo(tanggal_indo(date('Y-m-d H:i:s'))) ?></small></p>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

		</div>




		<div class="sn-related">
			<h2 style="font-style: italic;">Berita Terkait</h2>
			<div class="row sn-slider">
				<?php foreach ($berita_terkait as $key => $value): ?>


					<div class="col-md-4">
						<div class="sn-img">
							<img src="assets/img/foto_berita/<?php echo $value['foto_berita'] ?>" />
							<div class="sn-title">
								<a href="berita_detail.php?id=<?php echo $value['id_berita'] ?>" style="color: white"><?php echo $value['judul_berita'] ?></a>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>




			<?php 
			include "footer.php"; ?>