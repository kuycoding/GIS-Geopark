<?php include_once('auth.php'); ?>

<?php include_once('template/header.php'); ?>
<?php include_once('template/sidebar.php'); ?>
<?php include_once('template/topbar.php'); ?>

<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Request Geopark</h1>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Nama Geopark</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Informasi</th>
                <th scope="col">Latitude</th>
                <th scope="col">Longitude</th>
                <th scope="col">Gambar</th>

                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($con, "SELECT nama,id_request,nama_geo,deskripsi,info,lat,lon,gambar FROM user,request");
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['nama_geo'] ?></td>
                    <td><?= $data['deskripsi'] ?></td>
                    <td><?= $data['info'] ?></td>
                    <td><?= $data['lat'] ?></td>
                    <td><?= $data['lon'] ?></td>
                    <td>
                        <img src="<?= "../assets/img/upload/" . $data['gambar'] ?>" width="100" alt="">
                    </td>

                    <td>
                        <a href="hapus_req.php?id=<?= $data['id_request'] ?>" onclick="return confirm('Yakin hapus user?')" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

</div>
</div>
<!-- End of Main Content -->
<?php include('template/footer.php') ?>