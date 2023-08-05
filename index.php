<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring | Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="images/dashboard-logo.png" type="image/ico" />

    <style>
        /* Gaya tambahan untuk carousel */
        .carousel-item {
            position: relative;
        }

        .carousel-item img {
            height: 100vh;
            object-fit: cover;
        }

        .carousel-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Ubah tingkat kegelapan di sini */
        }

        .carousel-item .carousel-caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            text-align: center;
            width: 100%;
        }

        .carousel-item .carousel-caption h1 {
            font-size: 56px;
            /* Ukuran teks "Selamat Datang" */
            font-weight: bold;
            margin-bottom: 20px;
            line-height: 20px;
            margin-top: 90px;
            text-transform: uppercase;
        }

        .carousel-item .carousel-caption p {
            font-size: 24px;
            /* Ukuran teks "Web Monitoring Kandang Ayam" */
            margin-bottom: 0;
        }

        .carousel-item .carousel-caption a {
            width: 15%;
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <div class="row">
        <div class="col-12">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://img.freepik.com/free-photo/brown-chickens-farm_335224-1154.jpg?w=996&t=st=1688043410~exp=1688044010~hmac=3d93fc0e6e56958b70dafbb56405c87277e6e81c8ac03bbd2a89a45813cf7601" class="d-block w-100" alt="Ayam Makan">
                        <div class="overlay"></div>
                        <div class="carousel-caption d-none d-md-block">
                            <h1>Selamat Datang</h1>
                            <p>Web Monitoring Kandang Ayam</p>
                            <a href="login.php" class="btn btn-outline-info">Masuk</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://img.freepik.com/free-photo/brown-hens-farm_335224-1152.jpg?w=996&t=st=1688043436~exp=1688044036~hmac=d1c63fbeb495798c09bee97c90811ec76e9ced91a24fe16d4ae12671ca8832b3" class="d-block w-100" alt="...">
                        <div class="overlay"></div>
                        <div class="carousel-caption d-none d-md-block">
                            <h1>Selamat Datang</h1>
                            <p>Web Monitoring Kandang Ayam</p>
                            <a href="login.php" class="btn btn-outline-info">Masuk</a>

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://img.freepik.com/free-photo/chicken-nature-with-wooden-house_23-2149647853.jpg?w=996&t=st=1688043556~exp=1688044156~hmac=f213b0f97c4ab74bd15891dc08f6a47768b78ed916b149940d5005d3361c41c7" class="d-block w-100" alt="...">
                        <div class="overlay"></div>
                        <div class="carousel-caption d-none d-md-block">
                            <h1>Selamat Datang</h1>
                            <p>Web Monitoring Kandang Ayam</p>
                            <a href="login.php" class="btn btn-outline-info">Masuk</a>

                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        // Jalankan carousel secara otomatis
        $('.carousel').carousel({
            interval: 1500 // Ubah interval sesuai kebutuhan Anda (dalam milidetik)
        });
    </script>
</body>

</html>