<?php 
include "header.php";
$id_admin = $_SESSION['kontributor']['id_admin'];
$berita = array();
$ambil = $koneksi->query("SELECT * FROM berita LEFT JOIN kategori ON kategori.id_kategori = berita.id_kategori
 LEFT JOIN admin ON admin.id_admin = berita.id_admin WHERE berita.id_admin = '$id_admin'");
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
        <tr class="text-center">
          <th>no</th>
          <th>nama admin</th>
          <th>kategori</th>
          <th>Judul Berita</th>
          <th>Tanggal Berita</th>
          
          <th>Foto Berita</th>
          
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($berita as $key => $value): ?>
          <tr>
            <td><?php echo $key+1; ?></td>
            
            <td><?php echo $value['nama']; ?></td>
            <td><?php echo $value['nama_kategori']; ?></td>
            <td><?php echo $value['judul_berita']; ?></td>
            <td><?php echo date("d/m/Y ",strtotime($value['tanggal_berita'])); ?></td>
           
            <td><img src="../assets/img/foto_berita/<?php echo $value['foto_berita'];?>" class="img-fluid w-50 btn-sm"></td>
            
            <td nowrap="nowrap"><a href="berita_ubah.php?id=<?php echo $value ['id_berita']; ?>" class="btn btn-warning btn-sm" title="ubah"><i class="bi bi-pencil-square"></i></a>
              <a href="berita_hapus.php?id=<?php echo $value ['id_berita']; ?>" class="btn btn-danger btn-sm" title="hapus"><i class="bi bi-trash"></i></a></td>

          </tr>
          
        <?php endforeach ?>
      </tbody>
    </table>
    <a href="berita_tambah.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i>Tambah Data</a>
  </div>
</div>
<style>
  <style>
.card {
  border-radius: 10px;
  overflow: hidden;
}

.card-header {
  background-color: #007bff;
}

.card-header h6 {
  font-weight: bold;
}

.table {
  border-radius: 10px;
  overflow: hidden;
}

.table th {
  background-color: #007bff;
  color: white;
}

.table td {
  vertical-align: middle;
}

.table-hover tbody tr:hover {
  background-color: rgba(0, 123, 255, 0.1);
}

.img-fluid {
  border-radius: 5px;
  transition: transform 0.2s ease;
}

.img-fluid:hover {
  transform: scale(1.05); /* Efek perbesar hanya pada gambar */
}

.btn {
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn:hover {
  transform: translateY(-2px);
}
</style>

</style>


<?php include "footer.php" ?>

      

      

      
      
    