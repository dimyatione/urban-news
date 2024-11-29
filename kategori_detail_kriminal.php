<?php 
include "header.php"; 

// Mengambil id_kategori dari parameter URL atau default ke kategori tertentu (misal: politik)
$idk = isset($_GET['id_kategori']) ? $_GET['id_kategori'] : 11;

// Berita terbaru dari kategori tersebut
$berita_terbaru = $koneksi->query("SELECT * FROM berita 
                                   WHERE id_kategori='$idk' 
                                   ORDER BY id_berita DESC LIMIT 1")->fetch_assoc();

// Berita terbanyak dilihat dari kategori tersebut (kanan dengan scroll bar)
$berita_populer = array();
$ab = $koneksi->query("SELECT * FROM berita 
                       WHERE id_kategori='$idk' 
                       ORDER BY lihat DESC LIMIT 6");
while ($db = $ab->fetch_assoc()) {
    $berita_populer[] = $db;
}

// Berita terkait dari kategori yang sama
$berita_terkait = array();
$abt = $koneksi->query("SELECT * FROM berita 
                        WHERE id_kategori='$idk' 
                        ORDER BY id_berita DESC LIMIT 6");
while ($dbt = $abt->fetch_assoc()) {
    $berita_terkait[] = $dbt;
}
?>

<div class="single-news">
    <div class="container">
        <div class="row">
            <!-- Kolom konten berita utama -->
            <div class="col-md-8">
                <div class="sn-container">
                    <div class="sn-img">
                        <img src="assets/img/foto_berita/<?php echo $berita_terbaru['foto_berita'] ?>" class="img-fluid" />
                    </div>
                    <div class="sn-content">
                        <h1 class="sn-title"><?php echo $berita_terbaru['judul_berita'] ?></h1>
                        <p><?php echo $berita_terbaru['isi_berita'] ?></p>
                    </div>
                </div>
            </div>

            <!-- Kolom berita terbanyak dilihat dalam kategori (kanan dengan scroll bar) -->
            <div class="col-md-4">
                <h4 class="mb-3" style="font-style: italic;">Berita Populer</h4>
                <div style="max-height: 600px; overflow-y: scroll;">
                    <?php foreach ($berita_populer as $vb): ?>
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
                                        <p class="card-text"><small class="text-muted"><?php echo $vb['tanggal_berita'] ?></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Kolom berita terkait (di bawah) -->
        <div class="sn-related">
            <h2 style="font-style: italic;">Berita <?php echo $berita_terbaru['id_kategori']; ?></h2>
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
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
