<?php
include "koneksi.php";

// Baca data ID tertinggi dari tabel data_kandang
$sql_id = mysqli_query($conn, "SELECT MAX(ID) AS MAX_ID FROM data_kandang");
// tangkap nilainya ke dalam variabel
$data_id = mysqli_fetch_array($sql_id);

$id_akhir = $data_id['MAX_ID'];
$id_awal = $id_akhir - 4;

$suhu = mysqli_query($conn, "SELECT suhu FROM data_kandang WHERE id >= '$id_awal' AND id <= '$id_akhir' ORDER BY id ASC");

$suhu_terbaru = mysqli_query($conn, "SELECT suhu FROM data_kandang ORDER BY id DESC LIMIT 1");

$kelembapan = mysqli_query($conn, "SELECT kelembapan FROM data_kandang WHERE id >= '$id_awal' AND id <= '$id_akhir' ORDER BY id ASC");

$kelembapan_terbaru = mysqli_query($conn, "SELECT kelembapan FROM data_kandang ORDER BY id DESC LIMIT 1");

$tanggal = mysqli_query($conn, "SELECT tanggal FROM data_kandang WHERE id >= '$id_awal' AND id <= '$id_akhir' ORDER BY id ASC");

// Ambil data peralatan

$fan_1 = mysqli_query($conn, "SELECT FAN_1 FROM data_peralatan WHERE id=1");
$fan_2 = mysqli_query($conn, "SELECT FAN_2 FROM data_peralatan WHERE id=1");
$fan_3 = mysqli_query($conn, "SELECT FAN_3 FROM data_peralatan WHERE id=1");
$fan_4 = mysqli_query($conn, "SELECT COOLER FROM data_peralatan WHERE id=1");
$heater = mysqli_query($conn, "SELECT HEATER FROM data_peralatan WHERE id=1");
$otomatis = mysqli_query($conn, "SELECT OTOMATIS FROM data_peralatan WHERE id=1");

$data_fan1 = mysqli_fetch_array($fan_1);
$data_fan2 = mysqli_fetch_array($fan_2);
$data_fan3 = mysqli_fetch_array($fan_3);
$data_fan4 = mysqli_fetch_array($fan_4);
$data_heater = mysqli_fetch_array($heater);
$data_otomatis = mysqli_fetch_array($otomatis);
?>


<div class="col-md-12 col-sm-12">
    <div class="dashboard_graph">
        <div class="row x_title">
            <div class="col-md-6 mx-auto">
                <h4>Grafik Data Suhu dan Kelembapan Kandang Ayam</h4>
            </div>

        </div>

        <div class="row">

            <div class="col-md-9 col-sm-9 align-self-center">
                <canvas id="chartKandang" class="demo-placeholder">

                </canvas>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="col">
                    <div class="card w-100">
                        <div class="row align-items-center">

                            <div class="card-body col-7 px-4">
                                <h4 class="card-title"><strong><?php
                                                                while ($data_suhu_terbaru = mysqli_fetch_array($suhu_terbaru)) {
                                                                    echo $data_suhu_terbaru['suhu'];
                                                                }
                                                                ?>°C</strong></h4>
                                <p class="card-text">Suhu</p>
                            </div>

                            <div class="col-5">
                                <img src="images/hot.png" width="75px" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="card w-100 my-2">
                        <div class="row align-items-center">

                            <div class="card-body col-7 px-4">
                                <h4 class="card-title"><strong><?php
                                                                while ($data_kelembapan_terbaru = mysqli_fetch_array($kelembapan_terbaru)) {
                                                                    echo $data_kelembapan_terbaru['kelembapan'];
                                                                }
                                                                ?>%</strong></h4>
                                <p class="card-text">Kelembapan</p>
                            </div>

                            <div class="col-5 px-4">
                                <img src="images/humidity.png" width="70px" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="card w-100 my-2">
                        <div class="row align-items-center">

                            <div class="card-body col-7 px-4">
                                <h4 class="card-title"><strong>FAN 1</strong></h4>
                                <p class="card-text">Status: <?php echo ($data_fan1['FAN_1'] == '1') ? "On" : "Off" ?></p>
                            </div>


                            <div class="col-5 px-2">
                                <form action="php/update-peralatan.php" method="POST">
                                    <button type="submit" name="FAN1_ON" class="btn btn-info btn-rounded btn-sm">On</button>
                                    <button type="submit" name="FAN1_OFF" class="btn btn-info btn-rounded btn-sm">Off</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card w-100 my-2">
                        <div class="row align-items-center">

                            <div class="card-body col-7 px-4">
                                <h4 class="card-title"><strong>FAN 2</strong></h4>
                                <p class="card-text">Status: <?php echo ($data_fan2['FAN_2'] == '1') ? "On" : "Off" ?></p>
                            </div>


                            <div class="col-5 px-2">
                                <form action="php/update-peralatan.php" method="POST">
                                    <button type="submit" name="FAN2_ON" class="btn btn-info btn-rounded btn-sm">On</button>
                                    <button type="submit" name="FAN2_OFF" class="btn btn-info btn-rounded btn-sm">Off</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card w-100 my-2">
                        <div class="row align-items-center">

                            <div class="card-body col-7 px-4">
                                <h4 class="card-title"><strong>FAN 3</strong></h4>
                                <p class="card-text">Status: <?php echo ($data_fan3['FAN_3'] == '1') ? "On" : "Off" ?></p>
                            </div>


                            <div class="col-5 px-2">
                                <form action="php/update-peralatan.php" method="POST">
                                    <button type="submit" name="FAN3_ON" class="btn btn-info btn-rounded btn-sm">On</button>
                                    <button type="submit" name="FAN3_OFF" class="btn btn-info btn-rounded btn-sm">Off</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card w-100 my-2">
                        <div class="row align-items-center">

                            <div class="card-body col-7 px-4">
                                <h4 class="card-title"><strong>FAN 4</strong></h4>
                                <p class="card-text">Status: <?php echo ($data_fan4['COOLER'] == '1') ? "On" : "Off" ?></p>
                            </div>


                            <div class="col-5 px-2">
                                <form action="php/update-peralatan.php" method="POST">
                                    <button type="submit" name="COOLER_ON" class="btn btn-info btn-rounded btn-sm">On</button>
                                    <button type="submit" name="COOLER_OFF" class="btn btn-info btn-rounded btn-sm">Off</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card w-100 my-2">
                        <div class="row align-items-center">

                            <div class="card-body col-7 px-4">
                                <h4 class="card-title"><strong>OTOMATIS</strong></h4>
                                <p class="card-text">Status: <?php echo ($data_otomatis['OTOMATIS'] == '1') ? "On" : "Off" ?></p>
                            </div>


                            <div class="col-5 px-2">
                                <form action="php/update-peralatan.php" method="POST">
                                    <button type="submit" name="OTOMATIS_ON" class="btn btn-info btn-rounded btn-sm">On</button>
                                    <button type="submit" name="OTOMATIS_OFF" class="btn btn-info btn-rounded btn-sm">Off</button>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

            </div>


        </div>


        <div class="clearfix"></div>
    </div>
</div>



<!-- Gambar grafik suhu dan kelembapan kandang ayam -->

<script type="text/javascript">
    var canvas = document.getElementById('chartKandang');

    // Inisialisasi data tanggal dan suhu (Grafik suhu)
    var data = {
        labels: [
            <?php
            while ($data_tanggal = mysqli_fetch_array($tanggal)) {
                echo '"' . $data_tanggal['tanggal'] . '",';
            }
            ?>
        ],
        datasets: [{
                label: "Suhu",
                fill: true,
                lineTension: 0.5,
                backgroundColor: "rgba(221, 247, 227, 0.5)",
                data: [
                    <?php
                    while ($data_suhu = mysqli_fetch_array($suhu)) {
                        echo $data_suhu['suhu'] . ',';
                    }
                    ?>
                ],
            },
            {
                label: "Kelembapan",
                fill: true,
                lineTension: 0.5,
                backgroundColor: "rgba(93, 156, 89, 0.7)",
                data: [
                    <?php
                    while ($data_kelembapan = mysqli_fetch_array($kelembapan)) {
                        echo $data_kelembapan['kelembapan'] . ',';
                    }
                    ?>
                ],
            },
        ],
    };

    // Opsi grafik
    var option = {
        showLines: true,
        animation: {
            duration: 0,
        },
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 100
                }
            }]
        }

    };

    // Inisialisasi grafik

    var chartKandang = Chart.Line(canvas, {
        data: data,
        options: option
    });
</script>

<!-- jQuery -->
<script src="../../vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="../../vendors/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src="../../vendors/fastclick/lib/fastclick.js" type="text/javascript"></script>
<!-- NProgress -->
<script src="../../vendors/nprogress/nprogress.js" type="text/javascript"></script>
<!-- Chart.js -->
<script src="../../vendors/Chart.js/dist/Chart.min.js" type="text/javascript"></script>
<!-- gauge.js -->
<script src="../../vendors/gauge.js/dist/gauge.min.js" type="text/javascript"></script>
<!-- bootstrap-progressbar -->
<script src="../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="../../vendors/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- Skycons -->
<script src="../../vendors/skycons/skycons.js" type="text/javascript"></script>
<!-- Flot -->
<script src="../../vendors/Flot/jquery.flot.js" type="text/javascript"></script>
<script src="../../vendors/Flot/jquery.flot.pie.js" type="text/javascript"></script>
<script src="../../vendors/Flot/jquery.flot.time.js" type="text/javascript"></script>
<script src="../../vendors/Flot/jquery.flot.stack.js" type="text/javascript"></script>
<script src="../../vendors/Flot/jquery.flot.resize.js" type="text/javascript"></script>
<!-- Flot plugins -->
<script src="../../vendors/flot.orderbars/js/jquery.flot.orderBars.js" type="text/javascript"></script>
<script src="../../vendors/flot-spline/js/jquery.flot.spline.min.js" type="text/javascript"></script>
<script src="../../vendors/flot.curvedlines/curvedLines.js" type="text/javascript"></script>
<!-- DateJS -->
<script src="../../vendors/DateJS/build/date.js" type="text/javascript"></script>
<!-- JQVMap -->
<script src="../../vendors/jqvmap/dist/jquery.vmap.js" type="text/javascript"></script>
<script src="../../vendors/jqvmap/dist/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="../../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js" type="text/javascript"></script>
<!-- bootstrap-daterangepicker -->
<script src="../../vendors/moment/min/moment.min.js" type="text/javascript"></script>
<script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js" type="text/javascript"></script>

<!-- Jquery latest -->
<script src="js/jquery-latest.js" type="text/javascript"></script>