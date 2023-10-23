<?php
// Memasukkan file yang diperlukan
require_once "../include/koneksi.php";
require_once "../include/sessions.php";
require_once "../include/functions.php";

// Judul halaman
$tittle = "BPSDMP Kominfo Surabaya";

// Memasukkan header, navbar, dan sidebar
require_once "template/header.php";
require_once "template/navbar.php";
require_once "template/sidebar.php";
?>

<!-- Konten Utama -->
<div id="layoutSidenav_content">
    <main>
        <div class="container">
            <!-- Judul halaman -->
            <h1 class="mt-5">Daftar Kegiatan</h1>

            <!-- Menampilkan pesan sukses atau pesan error (jika ada) -->
            <?php echo Message();
            echo SuccessMessage();
            ?>

            <!-- Breadcrumb -->
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Kegiatan</li>
            </ol>

            <!-- Tabel responsif untuk menampilkan daftar kegiatan -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        global $db;
                        // Mengambil dan menampilkan data kegiatan dari database
                        $ViewQuery = "SELECT * FROM kegiatan ORDER BY id ASC";
                        $Execute = mysqli_query($db, $ViewQuery);
                        $No = 1;
                        while ($DataRows = mysqli_fetch_array($Execute)) {
                            $Id = $DataRows["id"];
                            $Judul = $DataRows["judul"];
                            $Deskripsi = $DataRows["deskripsi"];
                            $Tanggal = $DataRows["tanggal"];
                            $Gambar = "asset/image/" . $DataRows["gambar"];
                        ?>
                            <!-- Menampilkan data kegiatan dalam baris tabel -->
                            <tr>
                                <td><?php echo $No++; ?></td>
                                <td><?php echo $Judul; ?></td>
                                <td><?php echo $Deskripsi; ?></td>
                                <td><?php echo $Tanggal; ?></td>
                                <td>
                                    <img src="<?php echo $Gambar; ?>" alt="Gambar" width="100">
                                </td>
                                <td>
                                    <!-- Tombol untuk mengedit dan menghapus data -->
                                    <a href="editdata.php?Edit=<?php echo $Id; ?>" class="btn btn-primary">Edit</a>
                                    <a href="deletedata.php?Delete=<?php echo $Id; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data Ini?')">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Tombol untuk menambah data kegiatan -->
            <p><a href="tambah.php" class="btn btn-success">Tambah Data</a></p>
        </div>
    </main>
    
    <!-- Memasukkan footer -->
    <?php
    require_once "template/footer.php";
    ?>
</div>
