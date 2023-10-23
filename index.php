<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPSDMP Kominfo Surabaya - About</title>
    <link rel="shortcut icon" href="logo BPSDMP.png " type="image/x-icon">
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .footer {
            margin-top: auto;
        }

        .card {
            margin-bottom: 20px;
        }

        /* CSS untuk tombol navbar */
        .navbar-nav .nav-link {
            color: #ffffff;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Efek hover: Warna tombol dan teks berubah saat diarahkan */
        .navbar-nav .nav-link:hover {
            background-color: #007bff;
            color: #ffffff;
        }

        /* Menetapkan warna tombol saat halaman aktif */
        .navbar-nav .nav-item.active .nav-link {
            background-color: #007bff;
            color: #ffffff;
        }

        /* Mewarnai tombol paginasi yang aktif */
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-5" href="index.html"><img src="logo BPSDMP.png" alt="BPSDMP Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
            BPSDMP Kominfo Surabaya</a>
        </form>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row" id="home-content">
            <div class="col-md-12 text-center">
                <img src="logo BPSDMP.png" alt="Welcome Logo" class="img-fluid mt-4" width="200">
                <h2 class="mt-3">Welcome to BPSDMP Kominfo Surabaya</h2>
            </div>
            <?php
            require_once "include/koneksi.php";

            // Pagination setup
            $itemsPerPage = 3; // Jumlah item yang akan ditampilkan per halaman
            $currentPage = isset($_GET["page"]) ? $_GET["page"] : 1; // Mendapatkan nomor halaman saat ini dari parameter "page" dalam URL. Jika tidak ada, set halaman saat ini menjadi 1.
            $offset = ($currentPage - 1) * $itemsPerPage; // Menghitung nilai offset, yaitu jumlah baris data yang akan dilewati sebelum menampilkan data pada halaman saat ini.
            


            // Mengambil data dari basis data
            $sql = "SELECT * FROM kegiatan LIMIT $offset, $itemsPerPage";
            $result = $db->query($sql);

            // Menampilkan data yang diambil
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img src="admin/asset/image/' . $row["gambar"] . '" class="card-img-top" alt="' . $row["judul"] . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["judul"] . '</h5>';

                // Deskripsi singkat dan penuh
                $deskripsi = $row["deskripsi"];
                $sebagian_deskripsi = substr($deskripsi, 0, 100);

                echo '<p class="card-text">';
                echo '<span class="short-desc">' . $sebagian_deskripsi . '...</span>';
                echo '<span class="full-desc" style="display:none;">' . $deskripsi . '</span>';
                echo '<a href="#" class="read-more-link">Baca Selengkapnya</a>';
                echo '<a href="#" class="read-less-link" style="display:none;">Tutup</a>';
                echo '<p class="card-text"><small class="text-muted">' . $row["tanggal"] . '</small></p>';
                echo '</div></div></div>';
            }


            // Pagination links
            // Menghitung total jumlah baris dalam tabel kegiatan
            $sqlTotal = "SELECT COUNT(*) as total FROM kegiatan";
            $resultTotal = $db->query($sqlTotal);  // Menjalankan query untuk menghitung total baris
            $rowTotal = $resultTotal->fetch_assoc();  // Mengambil hasil query sebagai asosiatif array
            $totalPages = ceil($rowTotal["total"] / $itemsPerPage);  // Menghitung total halaman yang diperlukan


            $db->close();
            ?>
        </div>
    </div>
    <script>
        // Menemukan semua tautan "Baca Selengkapnya" dan "Tutup"
        const readMoreLinks = document.querySelectorAll('.read-more-link');
        const readLessLinks = document.querySelectorAll('.read-less-link');

        // Menambahkan event listener untuk tautan "Baca Selengkapnya"
        readMoreLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const cardBody = this.parentNode; // Mendapatkan elemen induk dari tautan
                cardBody.querySelector('.short-desc').style.display = 'none'; // Menyembunyikan deskripsi singkat
                cardBody.querySelector('.full-desc').style.display = 'inline'; // Menampilkan deskripsi penuh
                this.style.display = 'none'; // Menyembunyikan tautan "Baca Selengkapnya"
                cardBody.querySelector('.read-less-link').style.display = 'inline'; // Menampilkan tautan "Tutup"
            });
        });

        // Menambahkan event listener untuk tautan "Tutup"
        readLessLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const cardBody = this.parentNode; // Mendapatkan elemen induk dari tautan
                cardBody.querySelector('.short-desc').style.display = 'inline'; // Menampilkan deskripsi singkat kembali
                cardBody.querySelector('.full-desc').style.display = 'none'; // Menyembunyikan deskripsi penuh
                this.style.display = 'none'; // Menyembunyikan tautan "Tutup"
                cardBody.querySelector('.read-more-link').style.display = 'inline'; // Menampilkan tautan "Baca Selengkapnya" kembali
            });
        });
    </script>

    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php
                    // Jika halaman saat ini lebih besar dari 1
                    if ($currentPage > 1) {
                        // Membuat tombol "Sebelumnya" yang mengarahkan ke halaman sebelumnya
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '">Sebelumnya</a></li>';
                    }

                    // Loop untuk membuat nomor halaman dan menandai halaman aktif
                    for ($i = 1; $i <= $totalPages; $i++) {
                        $isActive = ($i == $currentPage) ? "active" : "";
                        echo '<li class="page-item ' . $isActive . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    }

                    // Jika halaman saat ini kurang dari jumlah total halaman
                    if ($currentPage < $totalPages) {
                        // Membuat tombol "Berikutnya" yang mengarahkan ke halaman berikutnya
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '">Berikutnya</a></li>';
                    }
                    ?>
                </ul>

            </nav>
        </div>
    </div>
    </div>
    <footer class="footer bg-dark text-white text-center py-3 mt-auto border">
        <div class="container">
            BPSDMP Kominfo Surabaya&copy; <?php echo date("Y"); ?>. All Rights Reserved.
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="script.js"></script>
</body>

</html>