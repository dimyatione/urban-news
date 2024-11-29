<?php 
include "header.php";

$tag = array();
$ambil = $koneksi->query("SELECT * FROM tag");
while ($detail = $ambil->fetch_assoc()){
    $tag[] = $detail;
}
?>

<!-- UI Components -->
<div class="btn-group py-3" role="group" aria-label="Basic example">
  <a href="berita.php" class="btn btn-outline-primary">Berita</a>
  <a href="berita_kategori.php" class="btn btn-outline-primary">Berita Kategori</a>
  <a href="berita_tag.php" class="btn btn-primary">Berita Tag</a>
</div>

<div class="card mt-3 shadow">
  <div class="card-header bg-white text-dark">
    <form method="post">
      <div class="mb-2">
        <select name="id_tag" class="form-control">
          <option value="">Filter</option>
          <?php foreach ($tag as $value): ?>
            <option value="<?php echo $value['id_tag'] ?>"><?php echo $value['judul_tag'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </form>
    <h6 class="m-0">Tampil Berita</h6>
  </div>
  
  <div class="card-body">
    <table class="table table-bordered table-striped table-hover table-sm">
      <thead>
        <tr class="text-center">
          <th>No</th>
          <th>Admin</th>
          <th>Judul_tag</th>
          <th>Berita</th>
          <th>Tanggal</th>
          <th>Foto</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data yang akan diisi oleh AJAX -->
      </tbody>
    </table>
    <div class="text-end">
      <a href="berita_tambah.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Data
      </a>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

<script>
  $(document).ready(function() {
    $("select[name=id_tag]").change(function() {
      var id_tag = $(this).val();

      $.ajax({
        type: 'GET',
        url: 'ambil_berita_tag.php?id_tag=' + id_tag,
        success: function(hasil) {
          $("tbody").html(hasil);
        }
      });
    });
  });
</script>
