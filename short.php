<?php 
include "header.php";

$short = array();
$ambil = $koneksi->query("SELECT * FROM short LEFT JOIN kategori ON kategori.id_kategori = short.id_kategori LEFT JOIN admin ON admin.id_admin = short.id_admin ORDER BY id_short DESC");
while ($detail = $ambil->fetch_assoc()){
  $short[] = $detail;
}
?>

<div class="card mt-3 shadow">
  <div class="card-header bg-white text-dark">
    <h6 class="m-0">Tampil short</h6>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-striped table-hover table-sm">
      <thead>
        <tr class="text-center">
          <th>No</th>
          <th>Kategori</th>
          <th>Admin</th>
          <th>Judul</th>
          <th>Jenis</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($short as $key => $value): ?>
          <tr>
            <td class="text-center"><?php echo $key + 1; ?></td>
            <td><?php echo $value['id_kategori'] ?></td>
            <td><?php echo $value['nama']; ?></td>
            <td><?php echo $value['judul_short']; ?></td>
            <td><?php echo $value['jenis_short']; ?></td>
            
            
            <td nowrap="nowrap" class="text-center">
              <a href="short_ubah.php?id=<?php echo $value['id_short']; ?>" class="btn btn-warning btn-sm" title="Ubah">
                <i class="bi bi-pencil-square"></i>
              </a>
              <a href="short_hapus.php?id=<?php echo $value['id_short']; ?>" class="btn btn-danger btn-sm" title="Hapus">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="text-end">
      <a href="short_tambah.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Data
      </a>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

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