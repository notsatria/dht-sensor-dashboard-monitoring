<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "monitoring_ayam";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql_fetch_data_alat = "SELECT * FROM coba WHERE id=1";
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
        $objData->otomatis = $row["OTOMATIS"];
    }
} else {
    echo "0 results";
}



//konversi data menjadi json
$dataJSON = json_encode($objData, JSON_FORCE_OBJECT);
echo $dataJSON; //menampilkan data sebagai json



mysqli_close($conn);
