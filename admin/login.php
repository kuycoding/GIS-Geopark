<?php require_once("config/koneksi.php"); ?>

<?php
session_start(); // Start session nya
// Kita cek apakah user sudah login atau belum
// Cek nya dengan cara cek apakah terdapat session username atau tidak
if (isset($_SESSION['id_user'])) { // Jika session username ada berarti dia sudah login
    header("location: index.php"); // Kita Redirect ke halaman welcome.php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - GIS Geopark</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login GIS!</h1>
                                    </div>
                                    <form action="" method="post" class="user">
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
                                    <?php
                                    if (isset($_POST['login'])) {
                                        $email = $_POST['email'];
                                        $pass = $_POST['password'];
                                        $query_one = mysqli_query($con, "SELECT * FROM user_admin WHERE email = '$email' AND password = '$pass'") or die(mysqli_error($con));
                                        // echo mysqli_num_rows($query_one);
                                        if (mysqli_num_rows($query_one) > 0) {
                                            $row_one = mysqli_fetch_array($query_one);
                                            $_SESSION['id_user'] = $row_one['id_user'];
                                            ?>
                                            <script>
                                                alert('Login berhasil');
                                                window.location = 'index.php';
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
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!--Bootstrap core JavaScri pt-->
    <scripts rc="assets/vendor/jquery/jquery.min.js">
        </script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!--C ore  plug in Java Script-->
        <script src="assets/vendor/jquery-easing/jquery.easing.min.js">
        </script>
        <!--Cu stom sc r ipts fo all pag e -->
        <script src="assets/js/sb-admin-2.min.js">
        </script>
</body>

</html>