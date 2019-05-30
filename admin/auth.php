<?php
session_start(); // Start session nya
// Kita cek apakah user sudah login atau belum
// Cek nya dengan cara cek apakah terdapat session username atau tidak
if (!isset($_SESSION['id_user'])) { // Jika tidak ada session username berarti dia belum login
    header("location: login.php"); // Kita Redirect ke halaman index.php karena belum login
}
