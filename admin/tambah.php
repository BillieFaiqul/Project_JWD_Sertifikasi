<?php
require_once "../include/koneksi.php";
require_once "../include/sessions.php";
require_once "../include/functions.php";
$tittle = "BPSDMP Kominfo Surabaya";
require_once "template/header.php";

// Saat tombol "Submit" ditekan
if(isset($_POST["Submit"])){
    // Mengambil dan membersihkan data yang diinputkan
    $Judul = mysqli_real_escape_string($db, $_POST["judul"]);
    $Deskripsi = mysqli_real_escape_string($db, $_POST["deskripsi"]);
    $Tanggal = mysqli_real_escape_string($db, $_POST["tanggal"]);

    // Mengambil nama gambar yang diunggah dan menentukan target penyimpanan
    $Gambar = $_FILES['gambar']['name'];
    $Target = "asset/image/" . basename($_FILES['gambar']['name']);
    
    // Mengunggah gambar ke lokasi target
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $Target)) {
        // Jika gambar berhasil diunggah, lanjutkan proses lain (misalnya menyimpan ke database)
    } else {
        // Jika gambar gagal diunggah
        echo "Gagal mengunggah gambar.";
    }

    // Membuat query untuk menyimpan data kegiatan ke dalam database
    $Query = "INSERT INTO kegiatan(judul, deskripsi, tanggal, gambar) VALUES ('$Judul', '$Deskripsi', '$Tanggal', '$Gambar')";
    // Mengeksekusi query
    $Execute = mysqli_query($db, $Query);
    // Memeriksa apakah query berhasil dieksekusi
    if($Execute){
        // Jika berhasil, tampilkan pesan sukses dan arahkan kembali ke halaman "kegiatan.php"
        $_SESSION["SuccessMessage"] = "Data berhasil ditambahkan";
        Redirect_to("kegiatan.php");
    } else {
        // Jika gagal, tampilkan pesan kesalahan dan arahkan kembali ke halaman "kegiatan.php"
        $_SESSION["ErrorMessage"] = "Data gagal ditambahkan, Coba Lagi!";
        Redirect_to("kegiatan.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Kegiatan Baru</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Kegiatan Baru</h2>
    <form action="tambah.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" class="form-control" required placeholder="Judul Kegiatan">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" required placeholder="Deskripsi Kegiatan"></textarea>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="gambar">Gambar:</label>
            <input type="file" id="gambar" name="gambar" class="form-control-file" required accept="image/*">
        </div>

        <!-- Tombol "Daftar" untuk submit, tombol "Ulangi" untuk mereset form, dan tombol "Kembali" untuk kembali ke halaman "kegiatan.php" -->
        <button name="Submit" type="submit" class="btn btn-primary">Daftar</button>
        <button name="Submit" type="reset" class="btn btn-primary">Ulangi</button>
        <a href="kegiatan.php"><button type="button" class="btn btn-primary">Kembali</button></a>
    </form>
</div>

<!-- Link Bootstrap JS (untuk beberapa fitur Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
