<?php
require_once "../include/koneksi.php";
require_once "../include/sessions.php";
require_once "../include/functions.php";

$tittle = "BPSDMP Kominfo Surabaya";
require_once "template/header.php";

// Jika tombol "Submit" pada form di tekan
if (isset($_POST["Submit"])) {
    $EditFromURL = $_GET['Edit'];
    $Judul = mysqli_real_escape_string($db, $_POST["judul"]);
    $Deskripsi = mysqli_real_escape_string($db, $_POST["deskripsi"]);
    $Tanggal = mysqli_real_escape_string($db, $_POST["tanggal"]);

    $Gambar = $_FILES['gambar']['name'];
    $OldGambar = ""; // Inisialisasi variabel gambar lama

    // Query untuk mendapatkan nama gambar lama dari basis data
    $Query = "SELECT gambar FROM kegiatan WHERE id='$EditFromURL'";
    $Result = mysqli_query($db, $Query);
    if ($Row = mysqli_fetch_assoc($Result)) {
        $OldGambar = $Row['gambar'];
    }

    // Pengecekan jika ada gambar baru diunggah
    if (!empty($Gambar)) {
        $Target = "asset/image/" . basename($_FILES['gambar']['name']);
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $Target)) {
            // Gambar berhasil diunggah
            // Update variabel $Gambar
            $Gambar = $_FILES['gambar']['name'];
        } else {
            echo "Gagal mengunggah gambar.";
        }
    } else {
        $Gambar = $OldGambar; // Gunakan gambar lama
    }

    // Query untuk mengupdate data kegiatan
    $UpdateQuery = "UPDATE kegiatan SET judul='$Judul', deskripsi='$Deskripsi', tanggal='$Tanggal', gambar='$Gambar' WHERE id='$EditFromURL'";
    $Execute = mysqli_query($db, $UpdateQuery);

    // Penanganan pesan sesuai hasil eksekusi query
    if ($Execute) {
        $_SESSION["SuccessMessage"] = "Data berhasil di-edit";
        Redirect_to("kegiatan.php");
    } else {
        $_SESSION["ErrorMessage"] = "Data gagal di-edit, Coba Lagi!";
        Redirect_to("kegiatan.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Kegiatan</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Data Kegiatan</h2>
    <?php
    $EditFromURL = $_GET['Edit'];
    $Query = "SELECT * FROM kegiatan WHERE id='$EditFromURL'";
    $Execute = mysqli_query($db, $Query);
    while ($DataRows = mysqli_fetch_array($Execute)) {
        $JudulUpdated = $DataRows['judul'];
        $DeskripsiUpdated = $DataRows['deskripsi'];
        $TanggalUpdated = $DataRows['tanggal'];
        $GambarUpdated = $DataRows['gambar'];
    }
    ?>
    <!-- Form untuk mengedit data kegiatan -->
    <form action="editdata.php?Edit=<?php echo $EditFromURL; ?>" method="post" enctype="multipart/form-data">
        <!-- Input untuk judul -->
        <div class="form-group">
            <label for="judul">Judul:</label>
            <input value="<?php echo $JudulUpdated ?>" type="text" id="judul" name="judul" class="form-control" required placeholder="Judul Kegiatan">
        </div>

        <!-- Input untuk deskripsi -->
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" required placeholder="Deskripsi Kegiatan"><?php echo $DeskripsiUpdated ?></textarea>
        </div>

        <!-- Input untuk tanggal -->
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control" required value="<?php echo $TanggalUpdated ?>">
        </div>

        <!-- Input untuk gambar -->
        <div class="form-group">
            <label for="gambar">Gambar:</label>
            <input type="file" id="gambar" name="gambar" class="form-control-file" accept="image/*">
            <p class="mt-2">Gambar saat ini: <?php echo $GambarUpdated; ?></p>
        </div>

        <!-- Tombol untuk mengirim form -->
        <button name="Submit" type="Submit" class="btn btn-primary">Edit</button>
        <!-- Tombol untuk kembali ke halaman kegiatan -->
        <a href="kegiatan.php"><button type="button" class="btn btn-primary">Kembali</button></a>
    </form>
</div>

<!-- Link Bootstrap JS (untuk beberapa fitur Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
