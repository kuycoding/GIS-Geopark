<?php include_once('auth.php'); ?>

<?php include_once('template/header.php'); ?>
<?php include_once('template/sidebar.php'); ?>
<?php include_once('template/topbar.php'); ?>

<script>
    inputBox = document.getElementById("input"); // Mengambil elemen tempat Input gambar

    inputBox.addEventListener('change', function(input) { // Jika tempat Input Gambar berubah

        var box = document.getElementById("box"); // mengambil elemen box
        var img = input.target.files; // mengambil gambar

        var reader = new FileReader(); // memanggil pembaca file/gambar
        reader.onload = function(e) { // ketika sudah ada
            box.setAttribute('src', e.target.result); // membuat alamat gambar
        }
        reader.readAsDataURL(img[0]); // menampilkan gambar
    });
</script>
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
                <th scope="col">Email</th>
                <th scope="col">Aktif/Non-Aktif</th>
                <th scope="col">Tanggal Dibuat</th>
                <th scope="col">Image</th>

                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($con, "SELECT * FROM user_admin");
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['is_active'] ?></td>
                    <td><?= date('d F Y', $data['date_created']); ?></td>
                    <td>
                        <img src="<?= "assets/img/profile/" . $data['image'] ?>" width="30" alt="">
                    </td>
                    <td>
                        <a href="user.php?id=<?= $data['id_user'] ?>" id="edit_modal" class="btn btn-primary" data-toggle="modal" data-id="<?= $data['id_user'] ?>" data-target="#EditModal">Edit</a>
                        |
                        <a href="hapus_user.php?id=<?= $data['id_user'] ?>" onclick="return confirm('Yakin hapus user?')" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

</div>
<!-- /.container-fluid -->
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
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="is_active" id="is_active" required>
                            <option value="">-- pilih --</option>
                            <option name="is_active" value="Admin">Admin</option>
                            <option name="is_active" value="Member">Member</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" name="gambar" id="gambar" class="form-control-file">
                        <img id="box" " style=" width: 30%;height: 30%" />
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
                $email = $_POST['email'];
                $password = $_POST['password'];
                $is_active = $_POST['is_active'];
                $insertdate = time();

                $file = $_FILES['gambar']['name'];
                $tmp = $_FILES['gambar']['tmp_name'];
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                $image = rand(1000, 1000000) . $file;
                $path = 'assets/img/profile/' . $image;
                move_uploaded_file($tmp, $path);

                $sql = "INSERT INTO user_admin(nama, email, password, is_active, image, date_created) VALUES('$nama','$email','$password','$is_active','$image','$insertdate')";
                $query = mysqli_query($con, $sql) or die(mysqli_error($con));
                if ($query) { ?>
                    <script>
                        alert('Berhasil Ditambah')
                        window.location = 'user.php'
                    </script>

                <?php

            }
        }

        ?>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= $row_one['nama'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" required value="<?= $row_one['email'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required value="<?= $row_one['password'] ?>">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="is_active" id="is_active">
                            <option name="is_active" value="Aktif">Aktif</option>
                            <option name="is_active" value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" name="gambar" id="gambar" class="form-control-file" value="<?= $row_one['image'] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
            <?php
            if (isset($_POST['edit'])) {
                $nama = $_POST['nama'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $is_active = $_POST['is_active'];
                $sql = "INSERT INTO user_admin(nama, email, password, is_active)
        VALUES('$nama','$email','$password','$is_active')";
                $query = mysqli_query($con, $sql) or die(mysqli_error($con));
                if ($query) { ?>
                    <script>
                        alert('User Berhasil ditambah')
                        window.location = 'user.php'
                    </script>
                <?php

            }
        }
        ?>
        </div>
    </div>
</div>
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    $(document).on("click", "edit_modal", function() {
        var id_user = $(this).data('id_user');
    })
</script>

</div>
<!-- End of Main Content -->
<?php include('template/footer.php') ?>