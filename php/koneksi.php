<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "monitoring_ayam";

// Buat koneksi ke database
$conn = mysqli_connect($servername, $username, $password, $db_name);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

