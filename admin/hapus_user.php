<?php include "config/koneksi.php";
include "auth.php";

$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM user") or die(mysqli_error($sql));
$data = mysqli_fetch_array($sql);

$query = mysqli_query($con, "DELETE FROM user_admin WHERE id_user = '$id'")
    or die(mysqli_error($con));
$path = 'assets/img/profile/' . $data['image'];

if (file_exists($path)) {
    unlink($path);
}
if ($query) { ?>
    <script>
        alert('User Berhasil Dihapus');
        window.location = 'user.php';
    </script>
<?php

}
?>