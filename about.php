<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPSDMP Kominfo Surabaya - About</title>
    <link rel="shortcut icon" href="logo BPSDMP.png" type="image/x-icon">
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

        /* Penataan konten */
        .container {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        /* Font untuk judul */
        h1 {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            text-align: center;
        }

        /* Font untuk teks */
        p {
            font-family: 'Calibri', sans-serif;
            text-align: justify;
        }

        /* Simbol */
        .symbol {
            font-size: 24px;
            color: #007bff;
        }
    </style>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-5" href="index.html"><img src="admin/asset/image/logo BPSDMP.png" alt="BPSDMP Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
            BPSDMP Kominfo Surabaya</a>
        </form>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <img src="admin/asset/image/logo BPSDMP.png" alt="BPSDMP Logo" width="150">
        </div>
        <h1>About BPSDMP Kominfo Surabaya</h1>
        <p>
            Balai Pengembangan Sumber Daya Manusia dan Penelitian Komunikasi dan Informatika Surabaya (BPSDMP Kominfo Surabaya) merupakan bagian dari Badan Penelitian dan Pengembangan Sumber Daya Manusia (Balitbang SDM) di bawah Kementerian Komunikasi dan Informatika Republik Indonesia.
        </p>
        <p>
            <span class="symbol">&#128204;</span> Alamat: Jl. Raya Ketajen No.36, Ketajen, Kec. Gedangan, Kabupaten Sidoarjo, Jawa Timur 61254
        </p>
        <p>
            <span class="symbol">&#128222;</span> Telepon: (031) 8011944
        </p>
        <p>
            <span class="symbol">&#127757;</span> Provinsi: Jawa Timur
        </p>
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
