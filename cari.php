<?php 
include "header.php";

$keyword = $_POST['keyword'];


$cari = [];
// Menampilkan data dari tabel berita berdasarkan kolom judul_berita dan isi_berita yang mirip dengan $keyword 
$ac = $koneksi->query("SELECT * FROM berita 
WHERE judul_berita LIKE '%$keyword%' 
OR isi_berita LIKE '%$keyword%'");

while ($dc = $ac->fetch_assoc()) {
    $cari[] = $dc;
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <?php if (!empty($cari)): ?>
                <?php foreach ($cari as $berita): ?>
                    <div class="card mb-4 sn-container">
                        <img src="assets/img/foto_berita/<?php echo $berita['foto_berita']; ?>" class="card-img-top sn-img" alt="<?php echo $berita['judul_berita']; ?>">
                        <div class="card-body sn-content">
                            <h5 class="sn-title"><?php echo $berita['judul_berita']; ?></h5>
                            <p class="sn-description"><?php echo substr($berita['isi_berita'], 0, 100) . '...'; ?></p>
                            <a href="berita_detail.php?id=<?php echo $berita['id_berita']; ?>" class="btn btn-info">Baca Selengkapnya</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada berita yang ditemukan untuk kata kunci "<?php echo $keyword; ?>".</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .sn-container {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .sn-container:hover {
        transform: scale(1.02);
    }

    .sn-img {
        height: 200px;
        object-fit: cover;
    }

    .sn-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
    }

    .sn-description {
        color: #666;
        font-size: 0.9rem;
    }
</style>

<?php include "footer.php"; ?>
