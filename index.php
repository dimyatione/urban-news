
<?php 
include "header.php"; ?>

<?php 
$ak = $koneksi->query("SELECT COUNT('id_kategori') AS jumlah_kategori FROM kategori")->fetch_assoc();
?>
<br><br>

<!-- Card bagian kategori dengan shadow dan efek hover -->
<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card shadow-card">
      <div class="card-body">
        <h5 class="card-title">Jumlah Kategori</h5>
        <h2 class="card-text"><?php echo $ak['jumlah_kategori']; ?></h2>
        <a href="kategori.php" class="btn btn-primary">Lihat Data</a>
      </div>
    </div>
  </div>
  
  <div class="col-sm-6">
    <?php 
    $ab = $koneksi->query("SELECT COUNT('id_berita') AS jumlah_berita FROM berita")->fetch_assoc(); 
    ?>
    <div class="card shadow-card">
      <div class="card-body">
        <h5 class="card-title">Jumlah Berita</h5>
        <h2 class="card-text"><?php echo $ab['jumlah_berita']; ?></h2>
        <a href="berita.php" class="btn btn-primary">Lihat Data</a>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>  

