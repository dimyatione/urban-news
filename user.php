<?php 
include "header.php";

$user = array();
$ambil = $koneksi->query('SELECT * FROM user');
while ($detail = $ambil->fetch_assoc()){
    $user[] = $detail;
}
?>

<div class="card mt-3 shadow">
    <div class="card-header bg-white text-dark">
        <h6 class="m-0">Data User</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead>
                <tr class="text-center">
                    <th>Id User</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Email User</th>
                    <th>Password User</th>
                    <th>Kontak</th>
                    <th>Jenis Kelamin</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['username']; ?></td>
                        <td><?php echo $value['nama']; ?></td>
                        <td><?php echo $value['email_user']; ?></td>
                        <td><?php echo str_repeat('*', strlen($value['pasword_user'])); ?></td>
                        <td><?php echo $value['kontak']; ?></td>
                        <td><?php echo $value['jenis_kelamin']; ?></td>
                        <td><img src="../assets/img/foto_user/<?php echo $value['foto']; ?>" class="img-fluid" width="100" alt="Foto User"></td>
                        <td class="text-center">
                            <a href="user_ubah.php?id=<?php echo $value['id_user']; ?>" class="btn btn-warning btn-sm" title="Ubah">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="user_hapus.php?id=<?php echo $value['id_user']; ?>" class="btn btn-danger btn-sm" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-end">
            <a href="user_tambah.php" class="btn btn-primary">
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

.btn {
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}
</style>
