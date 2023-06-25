<?php
include "koneksi.php";

$sql = "SELECT images FROM test_gambar WHERE id = 1;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $image_data = $result->fetch_assoc()['image'];

    echo '<img src="data:image/png;base64,' . base64_encode($image_data) . '">';
} else {
    echo "The image was not found";
}

$conn->close();

?>


<div class="col-md-12 col-sm-12">


    <div class="row p-4">
        <!-- Tabs navs -->
        <ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex3-tab-1" data-mdb-toggle="tab" href="#ex3-tabs-1" role="tab" aria-controls="ex3-tabs-1" aria-selected="true">Link</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex3-tab-2" data-mdb-toggle="tab" href="#ex3-tabs-2" role="tab" aria-controls="ex3-tabs-2" aria-selected="false">Very very very very long link</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex3-tab-3" data-mdb-toggle="tab" href="#ex3-tabs-3" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">Another link</a>
            </li>
        </ul>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex2-content">
            <div class="tab-pane fade show active" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">

            </div>
            <div class="tab-pane fade" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
                Tab 2 content
            </div>
            <div class="tab-pane fade" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">
                Tab 3 content
            </div>
        </div>
        <!-- Tabs content -->
    </div>


    <div class="clearfix"></div>

</div>





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