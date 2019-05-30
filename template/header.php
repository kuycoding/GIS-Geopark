<?php include_once("config/koneksi.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="shortcut icon" href="assets/img/gis.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GIS Geopark</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="assets/vendor/jquery/jquery.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <a class="navbar-brand" href="index.php">
                        <img src="assets/img/logo_geopark.png" height="30" class="d-inline-block align-top" alt="" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav" style="font-family: 'roboto' , regular;">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                <div id="tampung"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="maps.php?id=1">Maps</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact</a>
                                <div id="kontak"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.php">About</a>
                            </li>
                            <?php
                            if (isset($_SESSION['id_user'])) { ?>
                                <?php
                                $query = mysqli_query($con, "SELECT * FROM user WHERE id_user='$_SESSION[id_user]'");
                                while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="request.php">Request</a>
                                    </li>
                                <?php } ?>
                            <?php
                        } ?>
                        </ul>
                    </div>
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Cari geopark..." aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" id="button-search" type="button">Search</button>
                    </form>

                    <ul class="navbar-nav ml-auto">
                        <?php
                        if (isset($_SESSION['id_user'])) { ?>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM user WHERE id_user='$_SESSION[id_user]'");
                                    while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $row['nama'] ?></span>
                                        <img class="img-profile rounded-circle" src="<?= "assets/img/upload/" . $row['image'] ?>">
                                    <?php
                                } ?>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="profile.php">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        <?php
                    } else { ?>

                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Login</span>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <form class="px-4 py-3" method="post" action="">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email" placeholder="Enter Email Address..." required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block" required>
                                            Login
                                        </button>
                                    </form>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="register.php">Belum punya akun? Sign Up</a>
                                </div>
                                <?php
                                if (isset($_POST['login'])) {
                                    $email = $_POST['email'];
                                    $pass = md5($_POST['password']);
                                    $query_one = mysqli_query($con, "SELECT * FROM user WHERE email = '$email' AND password = '$pass'") or die(mysqli_error($con));
                                    // echo mysqli_num_rows($query_one);
                                    if (mysqli_num_rows($query_one) > 0) {
                                        $row_one = mysqli_fetch_array($query_one);
                                        $_SESSION['id_user'] = $row_one['id_user'];
                                        ?>
                                        <script>
                                            alert('Login berhasil');
                                            window.location = '/';
                                        </script>
                                    <?php
                                } else {
                                    ?>
                                        <script>
                                            alert('Login gagal');
                                        </script>
                                    <?php
                                }
                            }
                            ?>
                            </li>
                        <?php
                    } ?>
                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->