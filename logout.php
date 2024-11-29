<?php include "../koneksi.php";

session_destroy();
unset($_SESSION['kontributor']);

echo "<script>alert('berhasil logout')</script>";
echo "<script>location='index.php'</script>";

?>
