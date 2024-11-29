<?php 
include "header.php";


$id_short = $_GET['id'];


$ambil = $koneksi->query("SELECT * FROM short WHERE id_short = '$id_short'");
$detail = $ambil->fetch_assoc();


$kategori = array();
$ambil_kategori = $koneksi->query("SELECT * FROM kategori");
while($row = $ambil_kategori->fetch_assoc()) {
    $kategori[] = $row;
}
?>

<div class="card">
    <div class="card-header bg-info">
        <h6 class="text-white">Ubah Data</h6>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="id_kategori" class="form-control">
                    <option value="0">Pilih</option>
                    <?php foreach ($kategori as $value): ?>
                        <option value="<?php echo $value['id_kategori']; ?>" 
                            <?php echo ($detail['id_kategori'] == $value['id_kategori']) ? 'selected' : ''; ?>>
                            <?php echo $value['nama_kategori']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
                
                <label class="form-label">Judul Short</label>
                <input type="text" name="judul_short" class="form-control" value="<?php echo $detail['judul_short']; ?>" required>
                <br>
                
                <label class="form-label">Jenis</label>
                <select name="jenis_short" class="form-control" required>
                    <option value="video" <?php echo ($detail['jenis_short'] == 'video') ? 'selected' : ''; ?>>Video</option>
                    <option value="link" <?php echo ($detail['jenis_short'] == 'link') ? 'selected' : ''; ?>>Link</option>
                </select>
                <br>
                
                <div class="mb-3">
                    <label class="form-label">File Berita</label>
                    <input type="<?php echo ($detail['jenis_short'] == 'link') ? 'text' : 'file'; ?>" 
                        name="isi_short" 
                        class="form-control"
                        value="<?php echo ($detail['jenis_short'] == 'link') ? $detail['isi_short'] : ''; ?>">
                    <?php if ($detail['jenis_short'] == 'video'): ?>
                        <small class="text-muted"><?php echo $detail['isi_short']; ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Cover</label>
                    <input type="file" name="cover" class="form-control">
                    <small class="text-muted"><?php echo $detail['cover']; ?></small>
                </div>
                
                <button name="ubah" class="btn btn-primary">Ubah</button>
                <br>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['ubah'])) {
    $id_kategori = $_POST['id_kategori'];
    $judul_short = $_POST['judul_short'];
    $jenis_short = $_POST['jenis_short'];
    
    
    if ($jenis_short == 'link') {
        $isi_short = $_POST['isi_short'];
    } else {
        if (!empty($_FILES['isi_short']['name'])) {
            $isi_short = $_FILES['isi_short']['name'];
            $filevideo = $_FILES['isi_short']['tmp_name'];
            move_uploaded_file($filevideo, "../assets/img/short/" . $isi_short);
        } else {
            $isi_short = $detail['isi_short']; 
        }
    }

    // Proses cover
    if (!empty($_FILES['cover']['name'])) {
        $cover = $_FILES['cover']['name'];
        $filecover = $_FILES['cover']['tmp_name'];
        move_uploaded_file($filecover, "../assets/img/cover/" . $cover);
    } else {
        $cover = $detail['cover']; 
    }

   
    $koneksi->query("UPDATE short SET 
        id_kategori = '$id_kategori', 
        judul_short = '$judul_short', 
        jenis_short = '$jenis_short', 
        isi_short = '$isi_short', 
        cover = '$cover' 
        WHERE id_short = '$id_short'");

    echo "<script>
    alert('Data berhasil diubah');
    window.location.href='berita.php';
    </script>";
}
?>

<?php include "footer.php"; ?>

<script>
    // Deklarasi jQuery
    $(document).ready(function(){
        $("select[name=jenis_short]").change(function(){
            
            var jenis_short = $(this).val();

            if (jenis_short == 'video') {
                $("input[name=isi_short]").attr('type','file').val('');
            }
            if (jenis_short == 'link') {
                $("input[name=isi_short]").attr('type','text').val('');
            }
        });
    });
</script>
