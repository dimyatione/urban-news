<?php 
include "../koneksi.php";

$id_tag = $_GET['id_tag'];

if (isset($id_tag)) {

    $berita = array();

   
    $ambil = $koneksi->query("
        SELECT berita.id_berita, berita.judul_berita, berita.tanggal_berita, 
               berita.foto_berita, kategori.nama_kategori, admin.nama
        FROM tag_berita
        LEFT JOIN berita ON tag_berita.id_berita = berita.id_berita
        LEFT JOIN kategori ON berita.id_kategori = kategori.id_kategori
        LEFT JOIN admin ON admin.id_admin = berita.id_admin
        WHERE tag_berita.id_tag = '$id_tag'
    ");

    while ($detail = $ambil->fetch_assoc()) {
        $berita[] = $detail;
    }
?>

<?php if (!empty($berita)): ?>
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
<?php else: ?>
    <tr>
        <td colspan="7" class="text-center">Tidak ada data yang ditemukan.</td>
    </tr>
<?php endif; ?>

<?php 
} else {
    echo "<h1>Tidak ada data yang diambil</h1>";
} 
?>
