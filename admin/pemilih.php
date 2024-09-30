<?php
session_start();
require '../includes/koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: admin_login.php');
    exit();
}

// Fungsi untuk menambahkan pemilih
if (isset($_POST['add_voter'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $kelas = $_POST['kelas'];
    $token = $_POST['token'];
    $status = $_POST['status'];

    try {
        $sql = 'INSERT INTO voters (nama_lengkap, kelas, token, status) VALUES (?, ?, ?, ?)';
        $stmt = $koneksi->prepare($sql);

        // Bind parameter
        $stmt->bind_param("ssss", $nama_lengkap, $kelas, $token, $status);

        // Execute statement
        $stmt->execute();

        if($stmt) {
            echo "<script>alert('Data berhasil ditambahkan'); document.location = 'pemilih.php';</script>";
        } else {
            echo "<script>alert('Data gagal ditambahkan');</script>";
        }
    } catch (mysqli_sql_exception $e) {
        // Jika terjadi error karena token duplikat
        if ($e->getCode() == 1062) {  // Error code 1062 adalah kode untuk Duplicate Entry
            echo "<script>alert('Token sudah digunakan. Silakan gunakan token lain.'); document.location = 'pemilih.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan.'); document.location = 'pemilih.php'</script>";
        }
    }
    $stmt->close();
    $koneksi->close();
    exit();
}


// Fungsi untuk mengupdate pemilih
if (isset($_POST['update'])) {
  // Mengambil dan membersihkan data dari form
  $id = intval($_POST['id']);
  $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
  $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
  $token = mysqli_real_escape_string($koneksi, $_POST['token']);
  $status = mysqli_real_escape_string($koneksi, $_POST['status']);
  $hasil = mysqli_real_escape_string($koneksi, $_POST['hasil']);

  // Membuat query update
  $query = "UPDATE voters SET 
              nama_lengkap = '$nama_lengkap', 
              kelas = '$kelas', 
              token = '$token', 
              status = '$status', 
              hasil = '$hasil' 
            WHERE id = $id";

  // Menjalankan query
  if(mysqli_query($koneksi, $query)){
      echo "<script>alert('Data Berhasil Diubah'); window.location.href='pemilih.php';</script>";
  } else {
      echo "<script>alert('Data Gagal Diubah: ".mysqli_error($koneksi)."'); window.location.href='pemilih.php';</script>";
  }
}

// Fungsi untuk menghapus suara
if (isset($_GET['delete_vote_id'])) {
    $id = $_GET['delete_vote_id'];

    // Logika untuk menghapus suara terkait dengan pemilih
    $sql = 'UPDATE voters SET status = "Belum Memilih", hasil = NULL WHERE id = ?';
    $stmt = $koneksi->prepare($sql);
    $stmt->execute([$id]);

    header('Location: pemilih.php');
    exit();
}

// Fungsi untuk menghapus akun
if (isset($_GET['delete_account_id'])) {
    $id = $_GET['delete_account_id'];

    // Hapus akun pemilih
    $sql = 'DELETE FROM voters WHERE id = ?';
    $stmt = $koneksi->prepare($sql);
    $stmt->execute([$id]);

    header('Location: pemilih.php');
    exit();
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
        <title>DATA PEMILIH</title>

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

            .label {
                opacity: 40%;
                font-family: Sarpanch;
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
                            alt="OSIS IFSU"
                            />
                    </div>
                    <a href="javascript:;" class="toggle-btn ms-auto">
                        <i class="bx bx-menu"></i>
                    </a>
                </div>

                <!--navigation-->
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="admin_dashboard.php">
                            <div class="parent-icon icon-color-1">
                                <i class="bx bxs-dashboard"></i>
                            </div>
                            <div class="menu-title">Dashboard
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="" href="#">
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
                    <h4 class="text-dark" style="margin-top: -.5rem; ">Data Pemilih Tahun 2025/2026</h4>
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
                                    <img src="../assets/images/agung.png.jpg" class="user-img" alt="user avatar">
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
                        <div class="container">
                            <!-- Data Table -->
                            <div class="row">
                                <div class="col-12">
                                    <!-- Table -->
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <!-- Button Tambah Data -->
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addVoterModal">
                                                    Tambah Pemilih
                                                </button>
                                                <hr>
                                                <!-- End Button Tambah Data -->
                                            </div>
                                          <div class="table-responsive">
                                        <table id="votersTable" class="table table-bordered table-striped" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Nama Lengkap</th>
                                                    <th class="text-center">Profesi/Kelas</th>
                                                    <th class="text-center">Token</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Hasil</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $no = 1;
                                                    $result = mysqli_query($koneksi, "SELECT * FROM voters ORDER BY id ASC");
                                                ?>
                                                <?php while ($voter = mysqli_fetch_assoc($result)) : ?>

                                                <!-- Warna text pada field status -->
                                                <?php
                                                    // Tentukan class berdasarkan status menggunakan if-else
                                                    if ($voter['status'] === 'Belum Memilih') {
                                                        $statusClass = 'bg-danger p-1 rounded text-white';
                                                    } elseif ($voter['status'] === 'Sudah Memilih') {
                                                        $statusClass = 'bg-success p-1 rounded text-white';
                                                    } else {
                                                        $statusClass = ''; // class default jika status tidak dikenali
                                                    }
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                    <td><?php echo htmlspecialchars($voter['nama_lengkap']); ?></td>
                                                    <td><?php echo htmlspecialchars($voter['kelas']); ?></td>
                                                    <td><?php echo htmlspecialchars($voter['token']); ?></td>
                                                    <td>
                                                        <span class="<?= htmlspecialchars($statusClass); ?>">
                                                            <?php echo htmlspecialchars($voter['status']); ?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($voter['hasil'] ?? ''); ?></td>
                                                    <td>
                                                        <button
                                                            class="btn btn-info btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editVoterModal<?= $voter['id']; ?>">
                                                            <i class="bx bx-edit-alt"></i>
                                                        </button>
                                                        <!-- Tombol Hapus Suara dan Hapus Akun -->
                                                        <a
                                                            href="?delete_vote_id=<?php echo $voter['id']; ?>"
                                                            class="btn btn-warning btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus suara pemilih ini?');">
                                                            Hapus Suara
                                                        </a>
                                                        <a
                                                            href="?delete_account_id=<?php echo $voter['id']; ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus akun pemilih ini?');">
                                                            Hapus Akun
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- Modal Edit Pemilih -->
                                                <div
                                                    class="modal fade"
                                                    id="editVoterModal<?= $voter['id']; ?>"
                                                    tabindex="-1"
                                                    aria-labelledby="editVoterModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editVoterModalLabel">Edit Pemilih</h5>
                                                                <button
                                                                    type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <form action="" method="POST">
                                                                <!-- Input hidden untuk ID pemilih -->
                                                                <input type="hidden" name="id" value="<?= htmlspecialchars($voter['id']); ?>">
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="edit_nama_lengkap" class="form-label">Nama Lengkap</label>
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            id="edit_nama_lengkap"
                                                                            name="nama_lengkap"
                                                                            required="required"
                                                                            value="<?= htmlspecialchars($voter['nama_lengkap']); ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="edit_kelas" class="form-label">Profesi</label>
                                                                        <select name="kelas" id="edit_kelas" class="form-select">
                                                                            <option value="Guru" <?= $voter['kelas'] == 'Guru' ? 'selected' : ''; ?>>Guru</option>
                                                                            <option value="Staff" <?= $voter['kelas'] == 'Staff' ? 'selected' : ''; ?>>Staff</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="edit_token" class="form-label">Token</label>
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            id="edit_token"
                                                                            name="token"
                                                                            required="required"
                                                                            value="<?= htmlspecialchars($voter['token']); ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="edit_status" class="form-label">Status</label>
                                                                        <select class="form-select" id="edit_status" name="status" required="required">
                                                                            <option value="Belum Memilih" <?= $voter['status'] == 'Belum Memilih' ? 'selected' : ''; ?>>Belum Memilih</option>
                                                                            <option value="Sudah Memilih" <?= $voter['status'] == 'Sudah Memilih' ? 'selected' : ''; ?>>Sudah Memilih</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="edit_hasil" class="form-label">Hasil</label>
                                                                        <input type="text" class="form-control" id="edit_hasil" name="hasil" value="<?= htmlspecialchars($voter['hasil'] ?? ''); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-primary" name="update">Simpan Perubahan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal Edit -->

                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                        </div>
                                    </div>
                                    <!-- End Table -->
                                </div>
                            </div>
                            <!-- End Data Table -->
                        </div>
                        <!-- Modal Tambah Pemilih -->
                        <div
                            class="modal fade"
                            id="addVoterModal"
                            tabindex="-1"
                            aria-labelledby="addVoterModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addVoterModalLabel">Tambah Data Guru & Staff</h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="nama_lengkap"
                                                    name="nama_lengkap"
                                                    required="required">
                                            </div>
                                            <div class="mb-3">
                                                <label for="kelas" class="form-label">Profesi</label>
                                                <select class="form-select" id="kelas" name="kelas" required="required">
                                                    <option value="Guru">Guru</option>
                                                    <option value="Staff">Staff</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="token" class="form-label">Token</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="token"
                                                    name="token"
                                                    required="required">
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required="required">
                                                    <option value="Belum Memilih">Belum Memilih</option>
                                                    <option value="Sudah Memilih">Sudah Memilih</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary" name="add_voter">Tambah Pemilih</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                <p class="mb-0 fw-bold">Dibuat oleh Reffy And Tataq  &copy; 2024
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
            $(document).ready(function () {
                // Toggle sidebar on menu button click
                $('.toggle-btn').click(function () {
                    $('.wrapper').toggleClass('sidebar-collapsed');
                    adjustContentWidth();
                });

                // Initialize DataTables
                $('#votersTable').DataTable({
                    "pageLength": 5, // Set jumlah default yang ditampilkan
                    "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ] 
                });
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