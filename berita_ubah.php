<?php 
include "header.php";
$id_berita = $_GET['id'];
$detail = $koneksi->query("SELECT * FROM berita WHERE id_berita= '$id_berita'")->fetch_assoc(); 
$kategori =  array();

$ambil_kategori= $koneksi->query("SELECT * FROM kategori");
while($detail_kategori = $ambil_kategori->fetch_assoc()){
    $kategori[]=$detail_kategori;
}
?>


<div class="card">
	<div class="card-header bg-info">
		<h6 class="text-white">Ubah Data</h6>
	</div>
	<div class="card-body">
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="id_berita" value="<?php echo $detail['id_berita']; ?>"> 
			<div class="mb-3">
				
				<label class="form-label">Kategori</label>
                <select name="id_kategori" class="form-control">
                    <option value="0">Pilih</option>
                    <?php foreach ($kategori as $key => $value): ?>
                        <option value="<?php echo $value['id_kategori'] ?>"  <?php if($detail['id_kategori']==$value['id_kategori']) {echo "selected";}
                    ?>>
                            <?php echo $value['nama_kategori'] ?>

                        </option>
                    <?php endforeach ?>
                </select>
				<br>
				
				<label class="form-label">Judul Berita</label>
				<input type="text" name="judul_berita" class="form-control" value="<?php echo $detail['judul_berita']; ?>">
				<br>
				<label class="form-label">Tanggal Berita</label>
				<input type="datetime-local" name="tanggal_berita" class="form-control" value="<?php echo $detail['tanggal_berita']; ?>">
				<br>
				<label for="isi_berita" class="form-label">Isi Berita</label>
				<textarea id="isi_berita" name="isi_berita" rows="4" cols="50" class="form-control"><?php echo $detail['isi_berita']; ?></textarea>
				<br>
			</div>
			<div class="mb-3">
				<img src="../assets/img/foto_berita/<?php echo $detail['foto_berita']; ?>" width="100">
				<br>
				<label class="form-label">Foto Berita</label>
				<input type="file" name="foto_berita" class="form-control">
				<span class="text-danger small">Jika Tidak Mengubah Foto Maka Kosongkan</span>
				<br>
				<label class="form-label">Caption Foto</label>
				<input type="text" name="caption_foto" class="form-control" value="<?php echo $detail['caption_foto']; ?>">
			</div>
			<button class="btn btn-primary" name="simpan">Simpan</button>
		</form>
	</div>
</div>

<?php
if (isset($_POST['simpan'])) {
  
    $id_kategori = $_POST['id_kategori'];
    $judul_berita = $_POST['judul_berita'];
    $tanggal_berita = $_POST['tanggal_berita'];
    $isi_berita = $_POST['isi_berita'];
    $caption_foto = $_POST['caption_foto'];

    $nama_foto = $_FILES['foto_berita']['name'];
    $filefoto = $_FILES['foto_berita']['tmp_name'];

    if (empty($nama_foto)) {
        
    	$koneksi->query("UPDATE berita SET 
    		
    		id_kategori = '$id_kategori',
    		judul_berita = '$judul_berita',
    		tanggal_berita = '$tanggal_berita',
    		isi_berita = '$isi_berita',
    		caption_foto = '$caption_foto'
    		WHERE id_berita = '$id_berita'");
    } else {
        
    	move_uploaded_file($filefoto, "../assets/img/foto_berita/".$nama_foto);
    	$koneksi->query("UPDATE berita SET 
    		
    		id_kategori = '$id_kategori',
    		judul_berita = '$judul_berita',
    		tanggal_berita = '$tanggal_berita',
    		isi_berita = '$isi_berita',
    		caption_foto = '$caption_foto',
    		foto_berita = '$nama_foto'
    		WHERE id_berita = '$id_berita'");
    }

    echo "<script>
    alert('Berhasil tersimpan');
    window.location.href='berita.php';
    </script>";
}
?>






