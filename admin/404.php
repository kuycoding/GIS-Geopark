<?php
header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
?>

<?php include('auth.php') ?>
<?php include('template/header.php') ?>
<?php include_once('template/sidebar.php'); ?>
<?php include_once('template/topbar.php'); ?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Page Not Found</p>
        <p class="text-gray-500 mb-0">Halaman yang anda cari tidak ada atau telah rusak ...</p>
        <a href="index.php">&larr; Back to Dashboard</a>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<?php include('template/footer.php') ?> 