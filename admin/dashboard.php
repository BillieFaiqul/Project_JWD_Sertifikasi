<?php
require_once "../include/koneksi.php";

$tittle = "BPSDMP Kominfo Surabaya";
require_once "template/header.php";
require_once "template/navbar.php";
require_once "template/sidebar.php";

// Mengambil data semua kegiatan dari database
$queryKegiatan = mysqli_query($db, "SELECT * FROM kegiatan");
$jumlahKegiatan = mysqli_num_rows($queryKegiatan);

// Mengambil data jumlah kegiatan berdasarkan bulan dari database
$query = "SELECT DATE_FORMAT(tanggal, '%M') AS bulan, COUNT(*) AS jumlah_kegiatan FROM kegiatan GROUP BY bulan";
$result = mysqli_query($db, $query);

// Membuat array untuk menyimpan data jumlah kegiatan per bulan
$data = array();

// Melakukan loop untuk mengambil data dari hasil query
while ($row = mysqli_fetch_assoc($result)) {
    // Menyimpan jumlah kegiatan ke dalam array dengan bulan sebagai indeks
    $data[$row['bulan']] = $row['jumlah_kegiatan'];
}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Jumlah Kegiatan</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="kegiatan.php"><?php echo $jumlahKegiatan . ' kegiatan' ?></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Bar Chart Kegiatan Perbulan
                        </div>
                        <div class="card-body"><canvas id="myBarChart" height="60"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script>
      // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Ambil data dari PHP dan konversi menjadi format yang sesuai untuk grafik
var bulanLabels = <?php echo json_encode(array_keys($data)); ?>;
var jumlahKegiatanData = <?php echo json_encode(array_values($data)); ?>;

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: bulanLabels,
    datasets: [{
      label: "Number of Activities",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: jumlahKegiatanData,
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: Math.max(...jumlahKegiatanData) + 5, // Maksimal nilai Y ditambah 5 agar tidak terlalu mendekati atas
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
    </script>
    <?php
    require_once "template/footer.php";
    ?>