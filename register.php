<?php require_once("config/koneksi.php");
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <title>Register - Geopark</title>
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style-login.css">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>

<body class="fullpage">
    <div id="form-section" class="container-fluid signin">
        <div class="website-logo">
            <a href="index-2.html">
                <div class="logo" style="width:62px;height:18px"></div>
            </a>
        </div>
        <div class="row">
            <div class="info-slider-holder">
                <div class="info-holder">
                    <div class="sidebar-brand-icon rotate-n-15" style="color:white">
                        <a href="index.php">
                            <h3 style="color:white"><i class=" fas fa-map-marked-alt"></i>
                                GIS GEOPARK</h3>
                        </a>
                        <br>
                    </div>
                    <div>
                        <img src="assets/img/maps.png" width="400" class="rounded" alt="">
                    </div>
                    <div class="mini-testimonials-slider">
                        <div class="details-holder">
                            <img class="photo" src="images/person1.jpg" alt="">
                            <h4>Sistem Informasi Geografis</h4>
                            <p>“adalah sistem komputer yang memiliki kemampuan untuk membangun, menyimpan, mengelola dan menampilkan informasi berefrensi geografis.”</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-holder">
                <div class="menu-holder">
                    <ul class="main-links">
                        <li><a class="normal-link" href="login.php">Don’t have an account?</a></li>
                        <li><a class="sign-button" href="login.php">Sign In</a></li>
                    </ul>
                </div>
                <div class="signin-signup-form">
                    <div class="form-items">
                        <div class="form-title">Sign up for new account</div>
                        <form id="signupform" method="post" action="">
                            <div class="form-text">
                                <input type="text" name="nama" placeholder="Full name" required>
                            </div>
                            <div class="form-text">
                                <input type="text" name="email" placeholder="E-mail Address" required>
                            </div>
                            <div class="form-text">
                                <input type="password" name="password" placeholder="Password" required>
                            </div>

                            <div class="form-button">
                                <button id="daftar" type="submit" name="daftar" class="ybtn ybtn-accent-color">Create new account</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                if (isset($_POST['daftar'])) {
                    $nama = $_POST['nama'];
                    $email = $_POST['email'];
                    $pass = md5($_POST['password']);
                    $insertdate = time();

                    $sql = "INSERT INTO user(nama, email, password, date_created, image)
        VALUES('$nama','$email','$pass','$insertdate','default')";
                    $query = mysqli_query($con, $sql) or die(mysqli_error($con));
                    if ($query) { ?>
                        <script>
                            alert('Daftar Berhasil')
                            window.location = 'login.php'
                        </script>
                    <?php

                }
            }
            ?>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstarp/js/bootstrap.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
</body>

</html>