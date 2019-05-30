<?php include "config/koneksi.php";
include "auth.php";

$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM data_geo") or die(mysqli_error($sql));
$data = mysqli_fetch_array($sql);

$query = mysqli_query($con, "DELETE FROM data_geo WHERE id_geo = '$id'")
    or die(mysqli_error($con));

if ($query) { ?>
    <script>
        alert('Data Geopark Berhasil Dihapus');
        window.location = 'data_geo.php';
    </script>
<?php

}
?>