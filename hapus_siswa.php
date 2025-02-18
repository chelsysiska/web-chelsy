<?php
include 'koneksi.php';

// Ambil ID siswa dari URL
$id_siswa = $_GET['id'];

// Proses penghapusan data siswa
$query = "DELETE FROM siswa WHERE id_siswa = '$id_siswa'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Data siswa berhasil dihapus!'); window.location.href='index.php';</script>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>