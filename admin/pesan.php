<?php include_once('auth.php'); ?>

<?php include_once('template/header.php'); ?>
<?php include_once('template/sidebar.php'); ?>
<?php include_once('template/topbar.php'); ?>

<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pesan Masuk</h1>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Pesan</th>

                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($con, "SELECT * FROM contact");
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['pesan'] ?></td>

                    <td>
                        <a href="hapusPesan.php?id=<?= $data['id'] ?>" onclick="return confirm('Yakin hapus user?')" class="btn btn-danger">Hapus</a>
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