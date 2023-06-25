<?php
include "koneksi.php";

$image_file = $_FILES['images']['hot.png'];

$image_data = file_get_contents($image_file);

$sql = "INSERT INTO test_gambar (images) VALUES ('$image_data');";

$conn->query($sql);

$conn->close();
