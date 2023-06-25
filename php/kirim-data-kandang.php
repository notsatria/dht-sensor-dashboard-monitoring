<?php
include "koneksi.php";

// Tangkap data yang dikirim oleh NodeMCU

$suhu = $_GET['suhu'];
$kelembapan = $_GET['kelembapan'];

// Simpan data di atas ke dalam tabel data_kandang
// dan selalu mulai data dari ID = 1
mysqli_query($conn, "ALTER TABLE data_kandang AUTO_INCREMENT=1");

$sql = mysqli_query($conn, "INSERT INTO data_kandang (suhu, kelembapan) VALUES ('$suhu', '$kelembapan')");

// Berikan respon ke NodeMCU

if ($sql) {
    echo "Data berhasil disimpan";
} else {
    echo "Data gagal disimpan";
}

$sql_fetch_data_alat = "SELECT * FROM data_peralatan WHERE id=1";
$result = mysqli_query($conn, $sql_fetch_data_alat);

if (mysqli_num_rows($result) > 0) {

    $objData = new stdClass;

    while ($row = mysqli_fetch_assoc($result)) {

        $objData->id = $row["id"];
        $objData->fan_1 = $row["FAN_1"];
        $objData->fan_2 = $row["FAN_2"];
        $objData->fan_3 = $row["FAN_3"];
        $objData->cooler = $row["COOLER"];
        $objData->heater = $row["HEATER"];
    }
} else {
    echo "0 results";
}



//konversi data menjadi json
$dataJSON = json_encode($objData, JSON_FORCE_OBJECT);
echo $dataJSON; //menampilkan data sebagai json

if (isset($_POST['FAN1_ON']))            // If press ON
{
    $sql = "UPDATE data_peralatan SET FAN_1 = 1 WHERE id = 1";
    mysqli_query($conn, $sql);
}

if (isset($_POST['FAN1_OFF']))        // If press OFF
{

    $sql = "UPDATE data_peralatan SET FAN_1 = 0 WHERE id = 1";
    mysqli_query($conn, $sql);
}

mysqli_close($conn);
