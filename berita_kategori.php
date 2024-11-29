<?php 
include "header.php";

$kategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");

while ($detail = $ambil->fetch_assoc()){
    $kategori[] = $detail;
}
?>
<div class="btn-group py-3" role="group" aria-label="Basic example">
  <a href="berita.php" class="btn btn-outline-primary">Berita</a>
  <a href="berita_kategori.php" class="btn btn-primary">Berita Kategori</a>
  <a href="berita_tag.php" class="btn btn-outline-primary">Berita Tag</a>
</div>
<div class="card mt-3 shadow">
  <div class="card-header bg-white text-dark">
    <form method="post">
      <div class="mb-2">
        <select name="id_kategori" class="form-control">
          <option value="">Filter</option>
          <?php foreach ($kategori as $key => $value): ?>
            <option value="<?php echo $value['id_kategori'] ?>"><?php echo $value ['nama_kategori'] ?></option>
          <?php endforeach ?>
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
          <th>Kategori</th>
          <th>Judul Berita</th>
          <th>Tanggal Berita</th>
          <th>Foto Berita</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        
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
<script>
  // awal deklarasi jqeury
  $(document).ready(function() {

    $("select[name=id_kategori]").change(function(){

      // mendAPATKAN isi dari select
      var id_kategori = $("select[name=id_kategori]").val();

      // deklarasi ajax
      $.ajax({
        type:'GET',
        url:'ambil_berita_kategori.php?id_kategori='+id_kategori,
        success:function(hasil){
          $("tbody").html(hasil);
        }
      });
    });
  })
</script>
