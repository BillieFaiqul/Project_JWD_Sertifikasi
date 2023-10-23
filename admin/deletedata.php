<?php
// Mengimpor file koneksi database
include '../include/koneksi.php';

// Mengambil nilai dari parameter URL "Delete" menggunakan metode GET
$DeleteFromURL = $_GET['Delete'];

// Melakukan query SELECT untuk mendapatkan nama file gambar yang akan dihapus
$result = mysqli_query($db, "SELECT gambar FROM kegiatan WHERE id='$DeleteFromURL'");
$row = mysqli_fetch_assoc($result);
$gambarToDelete = $row['gambar'];

// Menghapus data kegiatan dari database
mysqli_query($db, "DELETE FROM kegiatan WHERE id='$DeleteFromURL'");

// Menghapus file gambar dari direktori
if ($gambarToDelete) {
    $gambarPath = "asset/image/" . $gambarToDelete;
    if (file_exists($gambarPath)) {
        unlink($gambarPath);
    }
}

// Mengarahkan pengguna kembali ke halaman "kegiatan.php" setelah penghapusan selesai
header("location: kegiatan.php");
?>
