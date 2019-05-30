<?php include_once('auth.php'); ?>

<?php include_once('template/header.php'); ?>
<?php include_once('template/sidebar.php'); ?>
<?php include_once('template/topbar.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Managemen User</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TambahModal">
            Tambah User
        </button>

    </div>
    <!-- Content Row -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Description</th>
                <th scope="col">Information</th>
                <th scope="col">Image</th>

                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($con, "SELECT * FROM data_geo");
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $data['nama_geo'] ?></td>
                    <td><?= $data['deskripsi'] ?></td>
                    <td><?= $data['info'] ?></td>
                    <td>
                        <img src="<?= "assets/img/upload/" . $data['image'] ?>" width="100" alt="">
                    </td>
                    <td>
                        <a href="data_geo.php?id=<?= $data['id_geo'] ?>" id="edit_modal" class="btn btn-primary btn-sm" data-toggle="modal" data-id="<?= $data['id_geo'] ?>" data-target="#EditModal">Edit</a> |
                        <a href="hapus_geo.php?id=<?= $data['id_geo'] ?>" onclick="return confirm('Yakin hapus data geopark?')" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

</div>
<!-- Modal -->
<div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="TambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TambahModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama geopark" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Description" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="info" id="info" placeholder="Information" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="lat" id="lat" placeholder="Latitude" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longtitude" required>
                    </div>

                    <div class="form-group">
                        <input type="file" name="gambar" id="gambar" class="form-control-file">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
            <?php
            if (isset($_POST['tambah'])) {
                $nama = $_POST['nama'];
                $dek = $_POST['deskripsi'];
                $info = $_POST['info'];
                $lat = $_POST['lat'];
                $long = $_POST['longitude'];
                $insertdate = time();

                $file = $_FILES['gambar']['name'];
                $tmp = $_FILES['gambar']['tmp_name'];
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                $image = rand(1000, 1000000) . $file;
                $path = 'assets/img/upload/' . $image;
                move_uploaded_file($tmp, $path);

                $sql = "INSERT INTO data_geo(nama_geo, deskripsi, info, lat, longitude, image, date_created) VALUES('$nama','$dek','$info','$lat','$long','$image','$insertdate')";
                $query = mysqli_query($con, $sql) or die(mysqli_error($con));
                if ($query) { ?>
                    <script>
                        alert('Berhasil Ditambah')
                        window.location = 'data_geo.php'
                    </script>

                <?php

            }
        }

        ?>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->
<?php include('template/footer.php') ?>