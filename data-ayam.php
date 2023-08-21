<?php
// Inisialisasi session
session_start();

// Periksa apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, redirect ke halaman login
    header("Location: login.php");
    exit();
}
// Buat function untuk periksa siapa yang login
function checkAccess($role)
{
    if (in_array($_SESSION['role'], $role)) {
        return true;
    } else {
        return false;
    }
}

$username = strtoupper($_SESSION['username']);

?>

<!DOCTYPE html>
<html lang="en">


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Monitoring | Data Ayam</title>

<link rel="icon" href="images/dashboard-logo.png" type="image/ico" />
<!-- Bootstrap -->
<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
<!-- Font Awesome -->
<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!-- NProgress -->
<link href="vendors/nprogress/nprogress.css" rel="stylesheet" />
<!-- iCheck -->
<link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet" />

<!-- bootstrap-progressbar -->
<link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" />
<!-- JQVMap -->
<link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
<!-- bootstrap-daterangepicker -->
<link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />

<!-- Custom Theme Style -->
<link href="build/css/custom.min.css" rel="stylesheet" />

<!-- Data table -->
<!-- <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" /> -->

<!-- Lightbox -->
<link href="vendors/dist-lightbox/css/lightbox.min.css" rel="stylesheet" />

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0">
                        <a href="dashboard.php" class="site_title" style="font-size: 14pt"><span>Monitoring & Controlling</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_info">
                            <span>Selamat Datang,</span>
                            <h2><?php echo $username ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Menu</h3>
                            <ul class="nav side-menu">

                                <li>
                                    <a href="dashboard.php"><i class="fa fa-bar-chart-o"></i> Dashboard </a>
                                </li>

                                <li>
                                    <a href="data-ayam.php"><i class="fa fa-desktop"></i> Suhu Ayam </a>
                                </li>
                                <li>
                                    <a href="kandang-ayam.php"><i class="fa fa-desktop"></i> Suhu Kandang Ayam </a>
                                </li>
                                <?php
                                // Hanya bisa diakses oleh admin
                                if (checkAccess(['admin'])) {
                                    echo '  <li>
                  <a href="registrasi-user.php"><i class="fa fa-user"></i> Tambah User </a>
                </li>';
                                }
                                ?>
                                <?php
                                // Hanya bisa diakses oleh admin
                                if (checkAccess(['admin'])) {
                                    echo '  <li>
                  <a href="daftar-user.php"><i class="fa fa-user"></i> Daftar    User </a>
                </li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="menu_section"></div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <form action="php/logout.php" method="POST">
                            <button data-toggle="tooltip" data-placement="top" title="Logout" type="submit" class="btn btn-danger btn-block">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle py-2">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col vh-100" role="main">
                <div class="row">
                    <div class="col-md-6">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Citra AI</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table id="fileTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'php/koneksi.php';

                                        $sql = "SELECT * FROM test_gambar";
                                        $result = mysqli_query($conn, $sql);

                                        $num = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>' . $num . '</td>';
                                            echo '<td><a href="uploads/' . $row["images"] . '" data-lightbox="gallery"><img src="uploads/' . $row["images"] . '" alt="' . $row["images"] . '" width="150"></a></td>';
                                            echo '</tr>';
                                            $num++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="pull-right">Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a></div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
    </div>


    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    <!-- Tambahkan JavaScript untuk DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#fileTable').DataTable();
        });
    </script>

    <!-- JS Lightbox -->
    <script src="vendors/dist-lightbox/js/lightbox.min.js"></script>
</body>

</html>