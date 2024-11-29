<?php 
include "header.php"; 

// Mengambil id_kategori dari parameter URL atau default ke kategori tertentu (misal: politik)
$idk = isset($_GET['id_kategori']) ? $_GET['id_kategori'] : 10;

// Berita terbaru dari kategori tersebut
$berita_terbaru = $koneksi->query("SELECT * FROM berita 
    LEFT JOIN kategori ON kategori.id_kategori=berita.id_kategori
    WHERE kategori.id_kategori='$idk' 
    ORDER BY id_berita DESC LIMIT  1 ")->fetch_assoc();

// Berita terbanyak dilihat dari kategori tersebut (kanan dengan scroll bar)
$berita_populer = array();
$ab = $koneksi->query("SELECT * FROM berita 
    LEFT JOIN kategori ON kategori.id_kategori=berita.id_kategori
 WHERE kategori.id_kategori='$idk' 
 ORDER BY lihat DESC LIMIT 6");
while ($db = $ab->fetch_assoc()) {
    $berita_populer[] = $db;
}

// Berita terkait dari kategori yang sama
$berita_terkait = array();
$abt = $koneksi->query("SELECT * FROM berita 
    LEFT JOIN kategori ON kategori.id_kategori=berita.id_kategori
    WHERE kategori.id_kategori='$idk' 
    ORDER BY id_berita DESC LIMIT 6");
while ($dbt = $abt->fetch_assoc()) {
    $berita_terkait[] = $dbt;
}

$short = array();
$as = $koneksi->query ("SELECT * FROM short
WHERE short.id_kategori='$idk'
ORDER BY id_short DESC
LIMIT 6");

while($ds = $as->fetch_assoc())
{
    $short[]= $ds;
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
                                        <p class="card-text"><small class="text-muted"><?php echo tanggal_indo(tanggal_indo(date('Y-m-d H:i:s'))) ?></small></p>
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
            <h2 style="font-style: italic;">Berita <?php echo $berita_terbaru['nama_kategori']; ?></h2>
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
        <section class="py-4">
        <div class="container">
            <h2>Berita Short</h2>
            <div class="row d-flex justify-content-center" >
                <?php foreach ($short as $key => $value): ?>
                    <div class="col-md-4 d-flex justify-content-center mb-4">
                        <div class="card" style="width: 18rem; aspect-ratio: 9/16; border-radius: 10px; overflow: hidden; position: relative;">
                            <img src="assets/img/cover/<?php echo $value['cover'] ?>" class="card-img-top" style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="card-body" style="position: absolute; bottom: 0; left: 0; width: 100%; background: rgba(0, 0, 0, 0.5); padding: 10px;">
                                <h6 class="text-white text-center" style="margin: 0; font-size: 14px;">
                                    <!-- jika jenis short sama dengan link ,maka a href nya larikan ke url short nya  -->


                                <?php if($value['jenis_short']=='link'): ?>
                                
                                <a href="<?php echo $value['isi_short']; ?>" target="_blank">
                                        <?php echo $value['judul_short']; ?></a>

                                        <?php else: ?>  
                                    <!-- selain itu berrarti a href larikan ke halaman short detail -->
                                    <a href="short_detail.php?id=<?php echo $value ['id_short']; ?>" style="color: inherit; text-decoration: none;">
                                        <?php echo $value['judul_short']; ?>
                                    </a>
                                <?php endif ?>
                                </h6>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    </div>
</div>

<?php include "footer.php"; ?>
