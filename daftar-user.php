<?php
require 'php/koneksi.php';

// Inisialisasi session
session_start();

// Periksa apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Function untuk mendapatkan daftar user dari database
function getDaftarUser()
{
    global $conn;
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    return $result;
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

    <title>Monitoring | Daftar User</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet" />
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet" />

    <style>
        /* tambahkan gaya kustom di sini jika diperlukan */
    </style>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <!-- Bagian sisi kiri sama dengan halaman registrasi-user.php -->
                <!-- ... -->
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0">
                            <a href="index.html" class="site_title"><span>Sistem Monitoring</span></a>
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
            </div>

            <!-- top navigation -->
            <!-- Bagian navigasi atas sama dengan halaman registrasi-user.php -->
            <!-- ... -->
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
                <div class="m-5" style="color: transparent;">.</div>
                <div class="container">
                    <h2>Daftar User</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Tanggal Registrasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $daftarUser = getDaftarUser();
                            while ($user = mysqli_fetch_assoc($daftarUser)) {
                                echo "<tr>";
                                echo "<td>" . $user['nama'] . "</td>";
                                echo "<td>" . $user['username'] . "</td>";
                                echo "<td>" . $user['role'] . "</td>";
                                echo "<td>" . $user['created_at'] . "</td>";
                                echo '<td>
                                <form action="" method="POST" onsubmit="return confirmDelete();">
                                  <input type="hidden" name="id_user" value="' . $user['id'] . '">
                                  <button type="submit" name="hapus" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                              </td>';
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="m-5" style="color: transparent;">.</div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <!-- Bagian footer sama dengan halaman registrasi-user.php -->
            <!-- ... -->
            <!-- /footer content -->
        </div>
    </div>

    <?php
    if (isset($_POST['hapus'])) {
        $id_user = $_POST['id_user'];
        if (hapus_user($id_user)) {
            echo "<script>
                    alert('User berhasil dihapus!');
                    window.location.href = 'tampil-daftar-user.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menghapus user!');
                  </script>";
        }
    }
    ?>

    <script>
        // Function untuk menampilkan kotak dialog konfirmasi sebelum menghapus user
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus user ini?");
        }
    </script>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
</body>

</html>