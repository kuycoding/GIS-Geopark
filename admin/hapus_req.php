<?php include "config/koneksi.php";
include "auth.php";

$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM request") or die(mysqli_error($sql));
$data = mysqli_fetch_array($sql);

$query = mysqli_query($con, "DELETE FROM request WHERE id_request = '$id'")
    or die(mysqli_error($con));

if ($query) { ?>
    <script>
        alert('Data Geopark Berhasil Dihapus');
        window.location = 'req.php';
    </script>
<?php

}
?>