<?php
session_start();

unset($_SESSION['id_user']);
?>

<script>
    alert('Logout berhasil');
    window.location = 'login.php';
</script> 