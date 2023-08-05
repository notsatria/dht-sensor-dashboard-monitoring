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

function hapus_user($id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $query = "DELETE FROM users WHERE id = '$id'";
    return mysqli_query($conn, $query);
}
