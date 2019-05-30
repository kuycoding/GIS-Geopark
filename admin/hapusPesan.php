<?php include "config/koneksi.php";
include "auth.php";

$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM contact") or die(mysqli_error($sql));
$data = mysqli_fetch_array($sql);

$query = mysqli_query($con, "DELETE FROM contact WHERE id = '$id'")
    or die(mysqli_error($con));

if ($query) { ?>
    <script>
        alert('Pesan Berhasil Dihapus');
        window.location = 'pesan.php';
    </script>
<?php

}
?>