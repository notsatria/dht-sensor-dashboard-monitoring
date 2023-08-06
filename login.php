<?php

require 'php/koneksi.php';

session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);

        // Cek password
        if (password_verify($password, $data['password'])) {
            // Buat session
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $data['role'];
            header("location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Username atau Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Monitoring | Login</title>
    <link rel="icon" href="images/dashboard-logo.png" type="image/ico" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        h1 {
            font-size: 42px;
            font-weight: bold;
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            line-height: 20px;
        }

        body {
            background-color: #f8f9fa;
            background-image: url('https://images.unsplash.com/photo-1630090374791-c9eb7bab3935?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1172&q=80');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 150px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #1ABB9C;
            color: #fff;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            width: 100%;
            background-color: #1ABB9C;
            border-color: #1ABB9C;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #1A293A;
            border-color: #1A293A;
        }
    </style>
</head>

<body>
    <div class="m-5">
        <h1 class=" text-center text-white text-uppercase">Website Monitoring</h1>
        <h1 class="text-center text-white text-uppercase">Peternakan FAJAR FARM</h1>
    </div>
    <div class="container my-auto">
        <div class="card">
            <div class="card-header">
                <h2>Halaman Login</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>