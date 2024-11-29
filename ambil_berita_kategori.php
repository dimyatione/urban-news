<?php 
include "../koneksi.php";

$id_kategori = $_GET['id_kategori'];
if(isset($id_kategori)){



$berita = array();
$ambil = $koneksi->query("SELECT * FROM berita LEFT JOIN kategori ON kategori.id_kategori = berita.id_kategori LEFT JOIN admin ON admin.id_admin = berita.id_admin WHERE berita.id_kategori = '$id_kategori'");
while ($detail = $ambil->fetch_assoc()){
  $berita[] = $detail;
}
?>

        <?php foreach ($berita as $key => $value): ?>
          <tr>
            <td class="text-center"><?php echo $key + 1; ?></td>
            <td><?php echo $value['nama']; ?></td>
            <td><?php echo $value['nama_kategori']; ?></td>
            <td><?php echo $value['judul_berita']; ?></td>
            <td><?php echo date("d/m/Y", strtotime($value['tanggal_berita'])); ?></td>
            <td class="text-center">
              <img src="../assets/img/foto_berita/<?php echo $value['foto_berita']; ?>" class="img-fluid w-50" alt="Foto Berita">
            </td>
            <td nowrap="nowrap" class="text-center">
              <a href="berita_ubah.php?id=<?php echo $value['id_berita']; ?>" class="btn btn-warning btn-sm" title="Ubah">
                <i class="bi bi-pencil-square"></i>
              </a>
              <a href="berita_hapus.php?id=<?php echo $value['id_berita']; ?>" class="btn btn-danger btn-sm" title="Hapus">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php }else{ ?>
        <h1>Tidak ada data yang diambil</h1>
        <?php } ?>