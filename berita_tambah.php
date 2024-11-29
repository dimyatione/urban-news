<?php 
include "header.php";

$kategori =  array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while($detail = $ambil->fetch_assoc()){
    $kategori[]=$detail;
}


?>


<div class="card">
    <div class="card-header bg-info">
        <h6 class="text-white">Tambah Data</h6>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">

                <br>
                <label class="form-label">Kategori</label>
                <select name="id_kategori" class="form-control">
                    <option value="0">Pilih</option>
                    <?php foreach ($kategori as $key => $value): ?>
                        <option value="<?php echo $value['id_kategori'] ?>">
                            <?php echo $value['nama_kategori'] ?>

                        </option>
                    <?php endforeach ?>
                </select>
                <br>
                <label class="form-label">Judul Berita</label>
                <input type="text" name="judul_berita" class="form-control">
                <br>
                <label class="form-label">Tanggal Berita</label>
                <input type="datetime-local" name="tanggal_berita" class="form-control">
                <br>
                <label for="isi_berita"  class="form-label">Isi Berita</label>
                <textarea id="editor1" name="isi_berita" rows="4" cols="50" class="form-control"></textarea>
                <br>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Berita</label>
                <input type="file" name="foto_berita" class="form-control">
                <span class="text-danger small">Jika Tidak Ada Foto Maka Kosongkan</span>
                <br>
                <label class="form-label">Caption Foto</label>
                <input type="text" name="caption_foto" class="form-control">
            </div>
            <div class="mb-3">
                <label>Tag</label>
                <?php 
                $tag=array();
                $ambil=$koneksi->query ("SELECT * FROM tag"); 
                while ($detail = $ambil->fetch_assoc()){
                    $tag[]=$detail;}

                    ?>
                    <?php foreach ($tag as $key => $value): ?>
                        <label><?php echo $value['judul_tag'] ?></label>
                        <input type="checkbox" name="tag[]" value="<?php echo $value ['id_tag'] ?>">
                        
                    <?php endforeach ?>
            </div>
            <button class="btn btn-primary" name="simpan">Simpan</button>
        </form>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
  
    $id_admin = $_SESSION['kontributor']['id_admin'];
    $id_kategori = $_POST['id_kategori'];
    $judul_berita = $_POST['judul_berita'];
    $tanggal_berita = $_POST['tanggal_berita'];
    $isi_berita = $_POST['isi_berita'];
    $caption_foto = $_POST['caption_foto'];

    $nama_foto = $_FILES['foto_berita']['name'];
    $filefoto = $_FILES['foto_berita']['tmp_name'];

    if (empty($nama_foto)) {
        // Tambah data tanpa foto
        $koneksi->query("INSERT INTO berita 
            ( id_admin, id_kategori, judul_berita, tanggal_berita, isi_berita, caption_foto) 
            VALUES 
            ( '$id_admin', '$id_kategori', '$judul_berita', '$tanggal_berita', '$isi_berita', '$caption_foto')");
    } else {
        // Tambah data dengan foto
        move_uploaded_file($filefoto, "../assets/img/foto_berita/".$nama_foto);
        $koneksi->query("INSERT INTO berita 
    ( id_admin, id_kategori, judul_berita, tanggal_berita, isi_berita, caption_foto, foto_berita) 
    VALUES 
    ( '$id_admin', '$id_kategori', '$judul_berita', '$tanggal_berita', '$isi_berita', '$caption_foto', '$nama_foto')");

    }

    echo "<script>
    alert('Berhasil tersimpan');
    window.location.href='berita.php';
    </script>";
}
?>
<script>
        CKEDITOR.replace('editor1'); // Memanggil CKEditor pada textarea
    </script>

<?php include "footer.php"; ?>
