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
    false;
  }
}

$username = strtoupper($_SESSION['username']);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="images/dashboard-logo.png" type="image/ico" />

  <title>Monitoring | Home</title>

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

</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0">
            <a href="home.php" class="site_title"><span>Sistem Monitoring</span></a>
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
                  <a href="home.php"><i class="fa fa-home"></i> Home </a>
                </li>
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
      <div class="right_col" role="main">
        <section class="about-us py-5">
          <div class="container ">
            <div class="col-12 text-center">
              <img src="images/anak-ayam.webp" class="img-fluid rounded w-75 h-auto" alt="Gambar About Us">

            </div>
            <div class="col-md-12 text-center">
              <h2>Tentang Kami</h2>
              <p>
                Tuliskan teks atau deskripsi tentang perusahaan atau tim Anda di sini.
                Ini adalah contoh teks yang bisa digunakan sebagai pengganti gambar.
                Sesuaikan dengan informasi yang ingin Anda tampilkan.
              </p>
            </div>

            <div class="col-md-12 text-center">
              <!-- Tempelkan kode iframe Google Maps di sini -->
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15838.540137600436!2d110.4353347!3d-7.0521006!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708c0396ceec97%3A0x10b388f0c8411e72!2sPoliteknik%20Negeri%20Semarang!5e0!3m2!1sen!2sid!4v1691211114905!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

          </div>
        </section>

      </div>

      <!-- Tombol Sebelumnya dan Selanjutnya -->

      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a></div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
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

  <!-- JQVMap -->
  <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
  <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="vendors/moment/min/moment.min.js"></script>
  <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="build/js/custom.min.js"></script>
</body>

</html>