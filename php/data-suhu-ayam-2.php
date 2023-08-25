<?php
include "koneksi.php";

// Baca data ID tertinggi dari tabel data_kandang
$sql_id = mysqli_query($conn, "SELECT MAX(ID) AS MAX_ID FROM data_ayam");
// tangkap nilainya ke dalam variabel
$data_id = mysqli_fetch_array($sql_id);

$id_akhir = $data_id['MAX_ID'];
$id_awal = $id_akhir - 4;

$suhu_normal = mysqli_query($conn, "SELECT suhu_normal FROM data_ayam WHERE id >= '$id_awal' AND id <= '$id_akhir' ORDER BY id ASC");

$suhu_normal_terbaru = mysqli_query($conn, "SELECT suhu_normal FROM data_ayam ORDER BY id DESC LIMIT 1");

$suhu_rendah = mysqli_query($conn, "SELECT suhu_rendah FROM data_ayam WHERE id >= '$id_awal' AND id <= '$id_akhir' ORDER BY id ASC");

$suhu_rendah_terbaru = mysqli_query($conn, "SELECT suhu_rendah FROM data_ayam ORDER BY id DESC LIMIT 1");

$suhu_tinggi = mysqli_query($conn, "SELECT suhu_tinggi FROM data_ayam WHERE id >= '$id_awal' AND id <= '$id_akhir' ORDER BY id ASC");

$suhu_tinggi_terbaru = mysqli_query($conn, "SELECT suhu_tinggi FROM data_ayam ORDER BY id DESC LIMIT 1");

$tanggal = mysqli_query($conn, "SELECT tanggal FROM data_ayam WHERE id >= '$id_awal' AND id <= '$id_akhir' ORDER BY id ASC");
?>


<h2 class="pt-3">Jumlah Ayam</h2>

<div class="row">
    <div class="card w-100 mb-2">
        <div class="row align-items-center">
            <div class="card-body col-7">
                <h5 class="card-text">Suhu Normal</h5>
                <h4 class="card-title"><strong>
                        <?php
                        while ($data_suhu_normal_terbaru = mysqli_fetch_array($suhu_normal_terbaru)) {
                            echo $data_suhu_normal_terbaru['suhu_normal'];
                        }
                        ?> Ekor</strong></h4>
            </div>
            <div class="col-5 text-center">
                <img src="images/hot.png" width="70px" alt="">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card w-100 mb-2">
        <div class="row align-items-center">
            <div class="card-body col-7">
                <h5 class="card-text">Suhu Rendah</h5>
                <h4 class="card-title"><strong>
                        <?php
                        while ($data_suhu_rendah_terbaru = mysqli_fetch_array($suhu_rendah_terbaru)) {
                            echo $data_suhu_rendah_terbaru['suhu_rendah'];
                        }
                        ?> Ekor</strong></h4>
            </div>
            <div class="col-5 text-center">
                <img src="images/hot.png" width="70px" alt="">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card w-100 mb-2">
        <div class="row align-items-center">
            <div class="card-body col-7">
                <h5 class="card-text">Suhu Tinggi</h5>
                <h4 class="card-title"><strong>
                        <?php
                        while ($data_suhu_tinggi_terbaru = mysqli_fetch_array($suhu_tinggi_terbaru)) {
                            echo $data_suhu_tinggi_terbaru['suhu_tinggi'];
                        }
                        ?> Ekor</strong></h4>
            </div>
            <div class="col-5 text-center">
                <img src="images/hot.png" width="70px" alt="">
            </div>
        </div>
    </div>
</div>





</div>