<?php include_once('auth.php'); ?>

<?php include('template/header.php'); ?>
<?php include('template/sidebar.php'); ?>
<?php include('template/topbar.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card mb-3 card border-left-danger shadow h-100 py-2" style="max-width: 540px;">
        <div class="row no-gutters">
            <?php
            $query = mysqli_query($con, "SELECT * FROM user_admin WHERE id_user='$_SESSION[id_user]'");
            while ($row = mysqli_fetch_array($query)) {
                ?>
                <div class="col-md-4">
                    <img src="<?= "assets/img/profile/" . $row['image'] ?>" class="card-img" alt="">
                </div>
                <div class="col-md-8">
                    <div class="card-body">

                        <h5 class="card-title"><?= $row['nama']; ?></h5>
                        <p class="card-text"><?= $row['email'] ?>.</p>
                        <p class="card-text"><small class="text-muted">Terakhir di buat <?= date('d F Y', $row['date_created']); ?></small></p>

                    </div>
                </div>
            <?php
        } ?>
        </div>
    </div>
</div>
</div>
<?php include('template/footer.php') ?>