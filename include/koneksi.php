<?php
// koneksi ke database
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "157_billiefaiqulizzat";

// Menghubungkan ke database menggunakan mysqli_connect
$db = mysqli_connect($server, $user, $password, $nama_database);
// Memeriksa apakah koneksi berhasil dilakukan
if (!$db) {
    // Jika koneksi gagal, maka script die() akan dieksekusi.
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}


?>