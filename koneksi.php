<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "sekolah";

// Membuat Koneksi ke Databases
$koneksi = mysqli_connect($host, $user, $pass, $db);

// cek koneksi
if(!$koneksi){
    die("Koneksi gagal : ". mysqli_connect_error());
}

?>