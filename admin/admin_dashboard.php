<?php
session_start();
require '../includes/koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: admin_login.php');
    exit();
}

// Ambil data untuk dashboard
$data1 = mysqli_query($koneksi, "SELECT COUNT(*) AS total_kandidat FROM kandidat");
$kandidat = mysqli_fetch_assoc($data1);
$total_kandidat = $kandidat['total_kandidat'];

$data2 = mysqli_query($koneksi, "SELECT COUNT(*) total_voters FROM voters");
$voters = mysqli_fetch_assoc($data2);
$total_voters = $voters['total_voters'];


$data3 = mysqli_query($koneksi, "SELECT * FROM voters WHERE status = 'Belum Memilih'");
$belum_memilih = mysqli_num_rows($data3);

$data4 = mysqli_query($koneksi,"SELECT * FROM voters WHERE status = 'Sudah Memilih'");
$sudah_memilih = mysqli_num_rows($data4);



// Query untuk mendapatkan data suara dari tabel kandidat
$query = "SELECT no_urut, jumlah_suara FROM kandidat ORDER BY no_urut ASC";
$result = mysqli_query($koneksi, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8"/>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <title>DASHBOARD PEMILIHAN</title>

        <!--favicon-->
        <link rel="icon" href="../assets/images/osis.png" type="image/png"/>
        <!-- Vector CSS -->
        <link
            href="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.css"
            rel="stylesheet"/>
        <!--plugins-->
        <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
        <link
            href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css"
            rel="stylesheet"/>
        <link
            href="../assets/plugins/metismenu/css/metisMenu.min.css"
            rel="stylesheet"/>
        <!-- loader-->
        <link href="../assets/css/pace.min.css" rel="stylesheet"/>
        <script src="../assets/js/pace.min.js"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css"/>
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Roboto&display=swap"/>
        <!-- Icons CSS -->
        <link rel="stylesheet" href="../assets/css/icons.css"/>
        <!-- App CSS -->
        <link rel="stylesheet" href="../assets/css/app.css"/>
        <link rel="stylesheet" href="../assets/css/dark-sidebar.css"/>
        <link rel="stylesheet" href="../assets/css/dark-theme.css"/>
        <!-- DataTable CSS -->
        <link
            href="../assets/plugins/datatable/css/dataTables.bootstrap4.min.css"
            rel="stylesheet"
            type="text/css">
        <link
            href="../assets/plugins/datatable/css/buttons.bootstrap4.min.css"
            rel="stylesheet"
            type="text/css">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin="crossorigin">
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;1,700&family=Ruslan+Display&family=Sarpanch:wght@400;500;600;700;800;900&family=Slackey&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Spicy+Rice&family=Trade+Winds&display=swap"
            rel="stylesheet">
        <!-- My Style -->
        <style>
            * {
                font-family: poppins;
            }

            .footer p {
                font-family: Sarpanch;
            }

            /* CSS untuk menu aktif */
            #menu .active > a {
                background-color: #f0f0f0;
                /* Warna latar belakang untuk menu aktif */
                color: #000;
                /* Warna teks untuk menu aktif */
            }

            .progress-bar {
                margin-bottom: 20px;
                background-color: #164554;
                border-radius: 15px;

            }

            .progress-label {
                font-weight: bold;
                display: flex;
                justify-content: space-between;
                margin-bottom: .4rem;
            }

            .progress {
                height: 27px;
                background-image: linear-gradient(to bottom right, #FFE500, #998A00);
                /* box-shadow: 0px 0px 10px ; */
                border-radius: 15px;
            }
        </style>
        <!-- End My Style -->
    </head>

    <body>
        <!-- wrapper -->
        <div class="wrapper">
            <!--sidebar-wrapper-->
            <div class="sidebar-wrapper" data-simplebar="true" id="sidebar">
                <div class="sidebar-header">
                    <div class="img-fluid">
                        <img
                            src="../assets/images/logo-osis.png"
                            class="logo-icon-2 w-75"
                            alt="IF-PERPUS"
                           />
                    </div>
                    <a href="javascript:;" class="toggle-btn ms-auto">
                        <i class="bx bx-menu"></i>
                    </a>
                </div>

                <!--navigation-->
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="#">
                            <div class="parent-icon icon-color-1">
                                <i class="bx bxs-dashboard"></i>
                            </div>
                            <div class="menu-title">Dashboard
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="" href="pemilih.php">
                            <div class="parent-icon icon-color-1">
                                <i class="bx bx-user"></i>
                            </div>
                            <div class="menu-title">Pemilih</div>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <div class="parent-icon icon-color-1">
                                <i class="bx bx-log-out"></i>
                            </div>
                            <div class="menu-title">Logout
                            </div>
                        </a>
                    </li>
                </ul>
                <!--end navigation-->
            </div>
            <!--end sidebar-wrapper-->
            <!--header-->
            <header class="top-header">
                <nav class="navbar navbar-expand">
                    <ul class="list-unstyled ms-auto" style="margin-top: -.5rem;">
                        <li class="nav-item dropdown dropdown-user-profile">
                            <a
                                class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                                href="javascript:;"
                                data-bs-toggle="dropdown">
                                <div class="d-flex user-box align-items-center">
                                    <div class="user-info">
                                        <p class="user-name mb-0"><?= $_SESSION['username'] ?></p>
                                        <p class="designattion mb-0"><?= $_SESSION['role'] ?></p>
                                    </div>
                                    <img src="" class="user-img" alt="user avatar">
                                </div>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-end"
                                style="box-shadow:0px 0px 20px red;">
                                <a class="dropdown-item text-center text-danger">
                                    <i class="bx bx-user fs-5 fw-bold"></i>
                                    <span class="fw-bold">Hi I'm
                                        <?= $_SESSION['username'] ?>
                                    </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </header>
            <!--end header-->
            <!--page-wrapper-->
            <div class="page-wrapper" id="content">
                <!--page-content-wrapper-->
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="container-fluid">
                            <div class="container">
                                <div class="row  text-white">
                                     <div class="col-6 col-lg-3">
                                        <div class="card radius-15 overflow-hidden">
                                            <div class="card-body bg-primary">
                                                <div class="text-center">
                                                    <h1 class="mb-4 mt-2 fw-bold"><span id="total_kandidat"></span></h1>
                                                    <h5 class="mb-3">Jumlah Kandidat</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-lg-3">
                                        <div class="card radius-15 overflow-hidden">
                                            <div class="card-body bg-dark">
                                                <div class="text-center">
                                                    <h1 class="mb-4 mt-2 fw-bold"><span id="total_voters"></span></h1>
                                                    <h5 class="mb-3">Jumlah Pemilih</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-lg-3">
                                        <div class="card radius-15 overflow-hidden">
                                            <div class="card-body bg-success">
                                                <div class="text-center">
                                                    <h1 class="mb-4 mt-2 fw-bold"><span id="sudah_memilih"></span></h1>
                                                    <h5 class="mb-3">Sudah Memilih</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-lg-3">
                                        <div class="card radius-15 overflow-hidden">
                                            <div class="card-body bg-danger">
                                                <div class="text-center">
                                                    <h1 class="mb-4 mt-2 fw-bold"><span id="belum_memilih"></span></h1>
                                                    <h5 class="mb-3">Belum Memilih</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Progress -->
                                <div class="row mt-3">
                                    <div class="col-12">
                                       <div class="card">
                                        <div class="card-body">
                                        <div class="progress-container">
                                            <h4 class="mb-3">Kemajuan Suara</h4>
                                            <div id="vote-progress"></div>
                                        </div>
                                        </div>
                                       </div>
                                    </div>
                                </div>
                                <!-- end Progress -->
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <!--end page-content-wrapper-->
            </div>
            <!--end page-wrapper-->
            <!--start overlay-->
            <div class="overlay toggle-btn-mobile"></div>
            <!--end overlay-->
            <!--Start Back To Top Button-->
            <a href="javaScript:;" class="back-to-top">
                <i class='bx bxs-up-arrow-alt'></i>
            </a>
            <!--End Back To Top Button-->
            <!--footer -->
            <div class="footer">
                <p class="mb-0 fw-bold">Dibuat oleh Reffy And Tataq &copy; 2024
                </p>
            </div>
            <!-- end footer -->
        </div>
        <!-- end wrapper -->

        <!-- JavaScript -->
        <!-- Bootstrap JS -->
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
        <!-- Vector map JavaScript -->
        <script src="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../assets/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
        <script src="../assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
        <script src="../assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
        <script src="../assets/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>
        <script src="../assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
        <script src="../assets/js/index.js"></script>
        <!--Data Tables js-->
        <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script>
        $(document).ready(function() {
    $('#menu').metisMenu();
});
    // Fungsi untuk memuat data suara kandidat
    function loadVoteData() {
        $.ajax({
            url: 'ajax/get_vote_data.php', // Path ke file PHP yang mengembalikan data suara
            method: 'GET',
            success: function(response) {
                var data = JSON.parse(response);
                var maxVotes = 1000;
                var voteProgressHtml = '';

                data.forEach(function(kandidat) {
                    var percentage = (parseInt(kandidat.jumlah_suara) / maxVotes) * 100;
                    voteProgressHtml += '<div class="progress-label">Kandidat ' + kandidat.no_urut + 
                                        '<span>(' + kandidat.jumlah_suara + ' Suara)</span></div>';
                    voteProgressHtml += '<div class="progress-bar">';
                    voteProgressHtml += '<div class="progress" style="width: ' + percentage + '%;"></div>';
                    voteProgressHtml += '</div>';
                });

                $('#vote-progress').html(voteProgressHtml);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error (Vote Data):", status, error);
            }
        });
    }

    // Fungsi untuk memuat data dashboard
    function loadDashboardData() {
        $.ajax({
            url: 'ajax/get_dashboard_data.php', // Path ke file PHP yang mengembalikan data dashboard
            method: 'GET',
            success: function(response) {
                var data = JSON.parse(response);
                $('#total_kandidat').text(data.total_kandidat);
                $('#total_voters').text(data.total_voters);
                $('#belum_memilih').text(data.belum_memilih);
                $('#sudah_memilih').text(data.sudah_memilih);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error (Dashboard Data):", status, error);
            }
        });
    }

    // Load data saat halaman pertama kali di-load
    $(document).ready(function() {
        loadVoteData();
        loadDashboardData();

        // Update data setiap 5 detik
        setInterval(loadVoteData, 5000);
        setInterval(loadDashboardData, 5000);
    });



</script>
        <!-- App JS -->
        <script src="../assets/js/app.js"></script>
        <script>
            new PerfectScrollbar('.dashboard-social-list');
            new PerfectScrollbar('.dashboard-top-countries');
        </script>

    </body>

</html>