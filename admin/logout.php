<?php
// Memulai sesi.
session_start();

// Mengosongkan nilai username dan password pada sesi.
$_SESSION['session_username'] = "";
$_SESSION['session_password'] = "";

// Menghapus seluruh data sesi.
session_destroy();

// Mengarahkan pengguna kembali ke halaman login.
header("location:../index.php");
?>
