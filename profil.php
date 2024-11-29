<?php 
include "header.php"; 
if (!isset($_SESSION['user'])){
  echo "<script>alert('anda harus login')location='login.php'</script>";
}
$id_user = $_SESSION['user']['id_user'];
$ambil = $koneksi->query("SELECT * FROM user WHERE id_user='$id_user'");

$detail = $ambil->fetch_assoc();




?>



  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <!-- User Profile Form -->
        <div class="card">
          <div class="card-header text-center">
            <h4>Edit User Profile</h4>
          </div>
          <div class="card-body">
            <!-- User Profile Form -->
            <form  method="POST" enctype="multipart/form-data">
              <!-- Foto Profil -->
              <div class="text-center mb-3">
                <!-- Avatar Icon as Profile Picture -->
                <i class="bi bi-person-circle" style="font-size: 120px;"></i>
              </div>

              <!-- Username -->
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $detail['username'] ?>" required>
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email_user" value="<?php echo $detail['email_user'] ?>" required>
              </div>

              <!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="pasword_user" value="">
              </div>

              <!-- Nama -->
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $detail['nama'] ?>" required>
              </div>

              <!-- Kontak -->
              <div class="mb-3">
                <label for="kontak" class="form-label">Kontak</label>
                <input type="text" class="form-control" id="kontak" name="kontak" value="<?php echo $detail['kontak'] ?>" required>
              </div>

              <!-- Jenis Kelamin -->
              <div class="mb-3">
                <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenisKelamin" name="jenis_kelamin" >
                  <option value="Laki-laki" <?php if ($detail['jenis_kelamin']=='Laki-laki') {
                    echo "selected";
                  } ?> selected>Laki-laki</option>
                  <option value="Perempuan" <?php if ($detail['jenis_kelamin']=='Perempuan') {
                    echo "selected";
                  } ?>>Perempuan</option>
                </select>
              </div>
              <div class="mb-3">

                <img src="assets/img/foto_user/<?php echo $detail['foto']; ?>" width="100">
                <div class="mb-3">
                  <label class="form-label">Foto User</label>
                  <input type="file" name="foto" class="form-control">
                  <span class="text-danger small">Jika Tidak Ada Foto Maka Kosongkan</span>

                </div>
              </div>

              <!-- Submit Button -->
              <div class="text-center">
                <button name="profil" type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="profil.php" class="btn btn-secondary">Batal</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

 


<?php 
if(isset($_POST['profil'])){
  $username = $_POST['username'];
  $email_user = $_POST['email_user'];
  $pasword_user = $_POST['pasword_user'];
  $pw = sha1($pasword_user);
  $nama = $_POST['nama'];
  $kontak = $_POST['kontak'];
  $jenis_kelamin = $_POST['jenis_kelamin'];

// bagian foto
  $nama_foto = $_FILES['foto']['name'];
  $filefoto = $_FILES['foto']['tmp_name'];

  if(empty($filefoto)) {
    if (empty($pasword_user)) {
      $koneksi->query("UPDATE user SET 
        username = '$username',
        email_user = '$email_user',

        nama = '$nama',
        kontak = '$kontak',
        jenis_kelamin = '$jenis_kelamin'

        WHERE id_user = '$id_user'");
    }else {
      $koneksi->query("UPDATE user SET 
        username = '$username',
        email_user = '$email_user',
        pasword_user = '$pw',
        nama = '$nama',
        kontak = '$kontak',
        jenis_kelamin = '$jenis_kelamin'


        WHERE id_user = '$id_user'");
    }
    
  }

  else {
    if (empty($pasword)) {
     move_uploaded_file($filefoto, "assets/img/foto_user/".$nama_foto);
     $koneksi->query("UPDATE user SET 
      username = '$username',
      email_user = '$email_user',
      nama = '$nama',
      kontak = '$kontak',
      jenis_kelamin = '$jenis_kelamin',
      foto = '$nama_foto'
      WHERE id_user = '$id_user'");
   }
   else{
    move_uploaded_file($filefoto, "assets/img/foto_user/".$nama_foto);
    $koneksi->query("UPDATE user SET 
      username = '$username',
      email_user = '$email_user',
      pasword_user = '$pw',
      nama = '$nama',
      kontak = '$kontak',
      jenis_kelamin = '$jenis_kelamin',
      foto = '$nama_foto'
      WHERE id_user = '$id_user'");
  }

}


echo "<script>alert('Berhasil Tersimpan')</script>";
echo "<script>location='profil.php'</script>";


}
?>
 <?php include "footer.php"; ?>