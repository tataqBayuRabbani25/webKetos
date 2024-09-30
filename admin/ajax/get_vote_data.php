<?php
include '../../includes/koneksi.php'; // Pastikan sudah menyertakan file koneksi

// Query untuk mendapatkan data suara dari tabel kandidat
$query = "SELECT no_urut, jumlah_suara FROM kandidat ORDER BY no_urut ASC";
$result = mysqli_query($koneksi, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Mengembalikan data dalam bentuk JSON
echo json_encode($data);
?>
