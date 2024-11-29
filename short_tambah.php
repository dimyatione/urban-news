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
                
                <label class="form-label">Judul Short</label>
                <input type="text" name="judul_short" class="form-control" required>
                <br>
                
                <label class="form-label">Jenis</label>
                <select name="jenis_short" class="form-control" required>
                    <option value="video"></option>
                    <option value="video">Video</option>
                    <option value="link">Link</option>
                </select>
                <br>
                
                <div class="mb-3">
                    <label class="form-label">File Berita</label>
                    <input type="file" name="isi_short" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Cover</label>
                    <input type="file" name="cover" class="form-control">
                    <span class="text-danger small">Jika tidak ada foto, maka kosongkan.</span>
                </div>
                
                <button name="simpan" class="btn btn-primary">Simpan</button>
                <br>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $id_admin = $_SESSION['admin']['id_admin'];
    $id_kategori = $_POST['id_kategori'];
    $judul_short = $_POST['judul_short'];
    $jenis_short = $_POST['jenis_short'];

    // Proses jenis_short
    if ($jenis_short == 'link') {
        $isi_short = $_POST['isi_short'];
    } else {
        $isi_short = $_FILES['isi_short']['name'];
        $filevideo = $_FILES['isi_short']['tmp_name'];
        move_uploaded_file($filevideo, "../assets/img/short/" . $isi_short);
    }

    // Proses cover
    $cover = $_FILES['cover']['name'];
    $filecover = $_FILES['cover']['tmp_name'];
    if (!empty($cover)) {
        move_uploaded_file($filecover, "../assets/img/cover/" . $cover);
    } else {
        $cover = null; // Jika tidak ada file, kosongkan
    }

    // Simpan data ke database
    $koneksi->query("INSERT INTO short (id_kategori, id_admin, judul_short, jenis_short, isi_short, cover)
        VALUES ('$id_kategori', '$id_admin', '$judul_short', '$jenis_short', '$isi_short', '$cover')");

    echo "<script>
    alert('Berhasil tersimpan');
    window.location.href='berita.php';
    </script>";
}
?>

<?php include "footer.php"; ?>

<script>
    // deklrasi jquery
    $(document).ready(function(){
        $("select[name=jenis_short]").change(function(){
            // langkah mendapatkan value select
            var jenis_short = $(this).val();

            if (jenis_short == 'video') {
                $("input[name=isi_short]").attr('type','file');
            }
            // jika jenis short == link maka ubah type menjadi text
            if (jenis_short == 'link') {
                $("input[name=isi_short]").attr('type','text');
            }
        });
    })
</script>
