<?php
// Koneksi ke database (ganti dengan informasi koneksi database Anda)
include "koneksi.php";

// Proses permintaan POST dari NodeMCU
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai-nilai dari permintaan POST
    $fan_1 = $_POST["fan_1"];
    $fan_2 = $_POST["fan_2"];
    $fan_3 = $_POST["fan_3"];
    $cooler = $_POST["cooler"];

    // Update data di database (misalnya tabel bernama "data_control")
    $sql = "UPDATE data_peralatan SET fan_1='$fan_1', fan_2='$fan_2', fan_3='$fan_3', cooler='$cooler' WHERE id=1";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui data: " . $conn->error;
    }
}

$conn->close();
