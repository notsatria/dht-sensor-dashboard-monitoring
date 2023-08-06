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

  <style>
    .right_col h2 {
      font-size: 28px;
      /* Increase or decrease as needed */
    }

    .right_col p {
      font-size: 18px;
      /* Increase or decrease as needed */
    }

    .image-overlay {
      position: relative;
      display: inline-block;
    }


    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 5px;
      color: white;
      opacity: 0;
      /* Tambahkan opacity 0 untuk overlay awal */
      transition: opacity 0.3s;
    }

    .image-overlay:hover .overlay {
      opacity: 1;
      /* Ubah opacity menjadi 1 saat gambar dihover */
    }

    .overlay h3 {
      margin: 0;
      font-size: 24px;
    }
  </style>

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
              <div class="image-overlay">
                <img src="images/brown-chickens-farm.jpg" class="img-fluid rounded w-75 h-auto" alt="Gambar About Us">
                <div class="overlay">
                  <h3>FAJAR FARM</h3>
                </div>
              </div>
            </div>
            <div class="col-md-12 text-center py-5">
              <h2>Tentang Kami</h2>
              <p>
                Peternakan ayam ini memiliki nama fajar farm. Fajar Farm terletak di jalan Cempoko, Gunung Pati, Kota Semarang. Peternakan ayam ini didirikan pada awal tahun 2020 saat pandemi Covid. Fajar Farm memiliki 2 kandang ayam bertingkat dengan luas kandang 12x 60 m. Memiliki jumlah karyawan 2 orang untuk memantau kondisi ayam dan memberi pakan ayam secara berkala. Peternakan ayam ini menernak ayam broiler untuk dikirim di sebuah pt
              </p>
              <a class="btn-primary p-2 rounded"  href="wa.me/6281215701078" target="_blank">Kontak Kami</a>
            </div>

            <div class="col-md-12 text-center ">
              <!-- Tempelkan kode iframe Google Maps di sini -->
              <h2>Alamat Kami</h2>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.5184342964853!2d110.3540098!3d-7.0657261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7089cd59903e5d%3A0x4846373942377537!2sFajar%20Farm!5e0!3m2!1sen!2sid!4v1691309793861!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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