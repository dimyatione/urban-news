<?php 
include "header.php";
 ?>
<?php 
$id_short = $_GET['id'];

$short = $koneksi->query("SELECT * FROM short WHERE id_short='$id_short'")->fetch_assoc(); ?>


<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="video-container" style="width: 100%; max-width: 320px; aspect-ratio: 9/16; overflow: hidden; position: relative; border-radius: 10px; border: 1px solid #ccc;">
        <video class="w-100" controls autoplay>
            <source src="assets/img/short/<?php echo $short['isi_short']; ?>" type="video/mp4">
        </video>
    </div>
</div>



 <?php 
 include "footer.php";
  ?>