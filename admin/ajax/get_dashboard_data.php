<?php
include '../../includes/koneksi.php'; // Sertakan file koneksi ke database

// Ambil data untuk dashboard
$data1 = mysqli_query($koneksi, "SELECT COUNT(*) AS total_kandidat FROM kandidat");
$kandidat = mysqli_fetch_assoc($data1);
$total_kandidat = $kandidat['total_kandidat'];

$data2 = mysqli_query($koneksi, "SELECT COUNT(*) AS total_voters FROM voters");
$voters = mysqli_fetch_assoc($data2);
$total_voters = $voters['total_voters'];

$data3 = mysqli_query($koneksi, "SELECT * FROM voters WHERE status = 'Belum Memilih'");
$belum_memilih = mysqli_num_rows($data3);

$data4 = mysqli_query($koneksi,"SELECT * FROM voters WHERE status = 'Sudah Memilih'");
$sudah_memilih = mysqli_num_rows($data4);

// Kirim data sebagai JSON
echo json_encode([
    'total_kandidat' => $total_kandidat,
    'total_voters' => $total_voters,
    'belum_memilih' => $belum_memilih,
    'sudah_memilih' => $sudah_memilih
]);
?>
