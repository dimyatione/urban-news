<?php 
include "header.php"; ?>

<div class="single-news">
	<div class="container">
		<?php 
		// Ambil berita terpopuler berdasarkan kolom 'lihat' terbesar
		$berita_terpopuler = $koneksi->query("SELECT * FROM berita ORDER BY lihat DESC LIMIT 1")->fetch_assoc();

		// Ambil daftar berita terkait, urutkan berdasarkan jumlah tampilan dari terbesar ke terkecil
		$berita_terkait = array();
		$abt = $koneksi->query("SELECT * FROM berita
			LEFT JOIN admin ON admin.id_admin = berita.id_admin 
			ORDER BY lihat DESC
			LIMIT 6"); // Menampilkan 6 berita terkait paling banyak dilihat
		while ($dbt = $abt->fetch_assoc()) {
			$berita_terkait[] = $dbt;
		}
		?>
		<div class="row">
			<!-- Kolom konten berita utama -->
			<div class="col-md-8">
				<div class="sn-container">
					<div class="sn-img">
						<img src="assets/img/foto_berita/<?php echo $berita_terpopuler['foto_berita'] ?>" class="img-fluid" />
					</div>
					<div class="sn-content">
						<h1 class="sn-title"><?php echo $berita_terpopuler['judul_berita'] ?></h1>
						<p>
							<?php echo $berita_terpopuler['isi_berita'] ?>
						</p>
					</div>
				</div>
			</div>

			<!-- Kolom daftar berita di sebelah kanan dengan scroll -->
			<?php 
			$bb = array();
			$ab = $koneksi->query("SELECT * FROM berita LEFT JOIN admin ON admin.id_admin=berita.id_admin ORDER BY id_berita DESC LIMIT 6");
			while($db = $ab->fetch_assoc()) {
				$bb[] = $db;
			} ?>

			<div class="col-md-4">
				<h4 class="mb-3" style="font-style: italic;">Berita Terbaru</h4>

				<div style="max-height: 600px; overflow-y: scroll;">
					<?php foreach ($bb as $vb): ?>
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
				<?php foreach ($berita_terkait as $value): ?>
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

		<?php include "footer.php"; ?>
