
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>ADMIN | DASHBOARD</title>
    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon-32x32.png" type="image/png" />
    <!-- Vector CSS -->
    <link href="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!--plugins-->
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Roboto&display=swap" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="../assets/css/icons.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="../assets/css/app.css" />
    <link rel="stylesheet" href="../assets/css/dark-sidebar.css" />
    <link rel="stylesheet" href="../assets/css/dark-theme.css" />
    <!-- DataTable CSS -->
    <link href="../assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">

    <style>
        .card {
            box-shadow: 0px 0px 10px black;
        }

        #content {
            transition: margin-left 0.3s;
        }

        .sidebar-collapsed #content {
            margin-left: 0;
            /* Sesuaikan dengan lebar sidebar yang menyusut */
        }

        #content .page-content .col-12 {
            transition: width 0.3s;
        }

        .sidebar-collapsed #content .page-content .col-12 {
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <!--sidebar-wrapper-->
        <div class="sidebar-wrapper" data-simplebar="true" id="sidebar">
            <div class="sidebar-header">
                <div class="img-fluid">
                    <img src="../assets/images/logo.png" class="logo-icon-2 w-75" alt="IF-PERPUS"
                        style="box-shadow:10px 0px 0px yellow; background-color:#00000080; border-radius:20px; padding:.3rem; opacity:100%;" />
                </div>
                <a href="javascript:;" class="toggle-btn ms-auto"> <i class="bx bx-menu"></i></a>
            </div>
            
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="dashboard_pa.php">
                        <div class="parent-icon icon-color-1"><i class="bx bx-home-alt"></i></div>
                        <div class="menu-title">Dashboard </div>
                    </a>
                </li>


                <li class="menu-label">Menu Utama</li>
                <li>
                    <a href="kelola_rak.php">
                        <div class="parent-icon icon-color-2"><i class="bx bx-columns"></i></div>
                        <div class="menu-title">Rak</div>
                    </a>
                </li>
                <li>
                    <a href="kelola_kategori.php">
                        <div class="parent-icon icon-color-3"><i class="bx bx-book"></i></div>
                        <div class="menu-title">Kategori</div>
                    </a>
                </li>
                <li>
                    <a href="kelola_buku.php">
                        <div class="parent-icon icon-color-4"><i class="bx bx-book-open"></i></div>
                        <div class="menu-title">Buku</div>
                    </a>
                </li>
                <li>
                    <a href="kelola_pinjam.php">
                        <div class="parent-icon icon-color-5"><i class="bx bx-message-square-add"></i></div>
                        <div class="menu-title">Kelola Pinjam</div>
                    </a>
                </li>
                <li>
                    <a href="kelola_kembali.php">
                        <div class="parent-icon icon-color-6"><i class="bx bx-message-square-check"></i></div>
                        <div class="menu-title">Kelola Kembali</div>
                    </a>
                </li>
                <li>
                    <a href="kelola_petugas.php">
                        <div class="parent-icon icon-color-7"><i class="bx bx-id-card"></i></div>
                        <div class="menu-title">Kelola Petugas</div>
                    </a>
                </li>
                <li>
                    <a href="kelola_laporan.php">
                        <div class="parent-icon icon-color-8"><i class="bx bx-file"></i></div>
                        <div class="menu-title">Laporan</div>
                    </a>
                </li>
                <li>

        
                <!-- petugas -->
                <li class="menu-label">Menu Utama</li>
                <li>
                    <a href="kelola_rak.php">
                        <div class="parent-icon icon-color-2"><i class="bx bx-columns"></i></div>
                        <div class="menu-title">Rak</div>
                    </a>
                </li>
                <li>
                    <a href="kelola_kategori.php">
                        <div class="parent-icon icon-color-3"><i class="bx bx-book"></i></div>
                        <div class="menu-title">Kategori</div>
                    </a>
                </li>
                <li>
                    <a href="kelola_buku.php">
                        <div class="parent-icon icon-color-4"><i class="bx bx-book-open"></i></div>
                        <div class="menu-title">Buku</div>
                    </a>
                </li>
                <li>
                    <a href="kelola_pinjam.php">
                        <div class="parent-icon icon-color-5"><i class="bx bx-message-square-add"></i></div>
                        <div class="menu-title">Kelola Pinjam</div>
                    </a>
                </li>
                <li>
                    <a href="kelola_kembali.php">
                        <div class="parent-icon icon-color-6"><i class="bx bx-message-square-check"></i></div>
                        <div class="menu-title">Kelola Kembali</div>
                    </a>
                </li>
                <!-- end petugas -->
            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar-wrapper-->
        <!--header-->
        <header class="top-header">
            <nav class="navbar navbar-expand">
                <ul class="list-unstyled ms-auto" style="margin-top: -.5rem;">
                    <li class="nav-item dropdown dropdown-user-profile">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="d-flex user-box align-items-center">
                                <div class="user-info">
                                    <p class="user-name mb-0"><?= $_SESSION['nama_petugas'] ?></p>
                                    <p class="designattion mb-0"><?= $_SESSION['level'] ?></p>
                                </div>
                                <img src="../assets/images/agung.png.jpg" class="user-img" alt="user avatar">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" style="box-shadow:0px 0px 20px red;">
                            <a class="dropdown-item text-center text-danger" href="logout.php"><i
                                    class="bx bx-power-off fs-5 fw-bold"></i><span class="fw-bold">Logout</span></a>
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
                            <div class="row">
                                <div class="col-6 col-lg-3">
                                    <div class="card radius-15 overflow-hidden">
                                        <div class="card-body bg-primary">
                                            <div class=" text-center">
                                                <h4 class="mb-5 mt-2 font-weight-bold"><?php echo $jmlpinjam; ?></h4>
                                                <h5 class="mb-3">Jumlah Peminjaman</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="card radius-15 overflow-hidden">
                                        <div class="card-body bg-warning">
                                            <div class=" text-center">
                                                <h4 class="mb-5 mt-2 font-weight-bold"><?php echo $jmlkembali; ?></h4>
                                                <h5 class="mb-3">Jumlah Pengembalian</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="card radius-15 overflow-hidden">
                                        <div class="card-body bg-danger">
                                            <div class=" text-center">
                                                <h4 class="mb-5 mt-2 font-weight-bold"><?php echo $jmlhilang; ?></h4>
                                                <h5 class="mb-3">Jumlah Buku Hilang</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="card radius-15 overflow-hidden">
                                        <div class="card-body bg-secondary">
                                            <div class=" text-center">
                                                <h4 class="mb-5 mt-2 font-weight-bold"><?php echo $jmlbuku; ?></h4>
                                                <h5 class="mb-3">Jumlah Buku</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                    <!-- Data Table -->
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4 class="mb-0">Booking</h4>
                                            </div>
                                            <hr />
                                            <div class="table-responsive">
                                                <table id="example" class="table table-striped table-bordered"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>No</th>
                                                            <th>Nama Pengguna</th>
                                                            <th>Judul Buku</th>
                                                            <th>Aksi</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                $no = 1;
                                                $query = mysqli_query($koneksi, "SELECT peminjaman.*, buku.judul, pengguna.nama_pengguna FROM peminjaman
                                                INNER JOIN buku ON peminjaman.id_buku = buku.id
                                                INNER JOIN pengguna ON peminjaman.id_pengguna = pengguna.id WHERE peminjaman.status = 'pinjam' AND peminjaman.id_petugas = 0
                                                ORDER BY peminjaman.id DESC");
                                                while ($data = mysqli_fetch_assoc($query)) :
                                                    ?>

                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo $data['nama_pengguna']; ?></td>
                                                            <td><?php echo $data['judul']; ?></td>
                                                            <td>
                                                                <a href="" class="btn btn-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalVerifBooking<?php echo $data['id']; ?>">Verif</a>

                                                                <a href="" class="btn btn-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalHapusBooking<?php echo $data['id']; ?>">Hapus</a>
                                                            </td>

                                                        </tr>

                                                        <!-- Modal for update -->
                                                        <div class="modal fade"
                                                            id="modalVerifBooking<?php echo $data['id']; ?>" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <div
                                                                            class="card border-top border-0 border-4 border-primary p-5">
                                                                            <form action="crud_booking.php"
                                                                                method="post">

                                                                            </form>
                                                                        </div>
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel">Ubah Buku</h5>
                                                                        <button class="btn btn-dark" type="button"
                                                                            class="close" data-bs-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="" method="post">

                                                                            <select name="pilihan" id="pilihan"
                                                                                class="form-select">
                                                                                <option value="opsi1">Pilih Kategori
                                                                                </option>
                                                                                <option value="opsi1">Fiksi</option>
                                                                                <option value="opsi2">Dongeng</option>
                                                                                <option value="opsi3">Non-fiksi
                                                                                </option>
                                                                            </select>

                                                                            <select name="pilihan" id="pilihan"
                                                                                class="form-select">
                                                                                <option value="opsi1">Pilih Rak
                                                                                </option>
                                                                                <option value="opsi1">1</option>
                                                                                <option value="opsi2">2</option>
                                                                                <option value="opsi3">3</option>
                                                                            </select>

                                                                            <input type="text" class="form-control"
                                                                                placeholder="Judul Buku" required
                                                                                autofocus>

                                                                            <input type="text" class="form-control"
                                                                                placeholder="Penulis" required
                                                                                autofocus>

                                                                            <input type="text" class="form-control"
                                                                                placeholder="Penerbit" required
                                                                                autofocus>

                                                                            <select name="pilihan" id="pilihan"
                                                                                class="form-select">
                                                                                <option value="opsi1">Tahun</option>
                                                                                <option value="opsi1">1987</option>
                                                                                <option value="opsi2">2003</option>
                                                                                <option value="opsi3">2023</option>
                                                                            </select>

                                                                            <input type="file" class="form-control"
                                                                                placeholder="Penerbit" required
                                                                                autofocus>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer ">
                                                                        <button type="riset"
                                                                            class="btn btn-danger bx bx-log-out-circle fw-bold"
                                                                            data-bs-dismiss="modal"></button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary bx bx-save fw-bold"></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal for update -->


                                                        <?php endwhile; ?>
                                                        <!-- Data goes here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Data Table -->


                </div>
            </div>
            <!--end page-content-wrapper-->
        </div>
        <!--end page-wrapper-->
        <!--start overlay-->
        <div class="overlay toggle-btn-mobile"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <!--footer -->
        <div class="footer">
            <p class="mb-0">Kelompok 10 @2024 | Developed By : <a href="https://themeforest.net/user/codervent"
                    target="_blank">codervent</a></p>
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
            // Toggle sidebar on menu button click
            $('.toggle-btn').click(function() {
                $('.wrapper').toggleClass('sidebar-collapsed');
                adjustContentWidth();
            });

            // Initialize DataTables
            $('#example').DataTable();
            $('#example2').DataTable();
        });

        function adjustContentWidth() {
            if ($('.wrapper').hasClass('sidebar-collapsed')) {
                $('#content .page-content .col-12').css('width', '100%');
            } else {
                $('#content .page-content .col-12').css('width', '');
            }
        }
    </script>
    <!-- App JS -->
    <script src="../assets/js/app.js"></script>
    <script>
        new PerfectScrollbar('.dashboard-social-list');
        new PerfectScrollbar('.dashboard-top-countries');
    </script>
</body>

</html>
