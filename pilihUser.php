<?php
    session_start(); 
    unset($_SESSION["user"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Bootstrap.min.css">
    <link rel="stylesheet" href="css/footer.css">

    <title>Pilih User | Kelompok 6</title>
    <style>
        body {
            background-color: #505BAD;
        }
        .center {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        }
        .card-img-top {
            width: 100%;
            height: 10vw;
        }
        .card-text {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body> 
        <nav class="navbar justify-content-center" style="height: 7em">
            <img src="image/logo_polinema.png" style="width:3.5%;margin-right:15px">
            <span class="navbar-text h1" style="color: #ffffff">POLITEKNIK NEGERI MALANG</span>
            <img src="image/logo_blu.png" style="width:3.5%;margin-left:15px">
        </nav>
        <div class="jumbotron" style="background-image: url(image/main.png); background-size: 120%; height: 12m; padding: 2em; background-repeat: no-repeat;">
            <div class="row justify-content-center">
                <button type="button" class="btn btn-light center" style="border-radius: 12px;">Masuk Sebagai</button>
            </div> 
            <br>
            <div class="container">
                <div class="row" style="margin-left: 6em;">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card" style="width: 12rem;">
                        <a href="login.php?user=1"><img class="card-img-top" src="image/mahasiswa.png" alt="Card image cap"></a>
                        <div class="card-body">
                            <p class="card-text">Mahasiswa</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card" style="width: 12rem;">
                        <a href="login.php?user=2"><img class="card-img-top" src="image/ortu.png" alt="Card image cap"></a>
                        <div class="card-body">
                            <p class="card-text">Orang Tua</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card" style="width: 12rem;">
                        <a href="login.php?user=3"><img class="card-img-top" src="image/dosen.png" alt="Card image cap"></a>
                        <div class="card-body">
                            <p class="card-text">Dosen</p>
                        </div>
                    </div>
                </div>
                </div>
                <br>
                <div class="row" style="margin-left: 6em;">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card" style="width: 12rem;">
                        <a href="login.php?user=4"><img class="card-img-top" src="image/tendik.png" alt="Card image cap"></a>
                        <div class="card-body">
                            <p class="card-text">Tendik</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card" style="width: 12rem;">
                        <a href="login.php?user=5"><img class="card-img-top" src="image/mitra.png" alt="Card image cap"></a>
                        <div class="card-body">
                            <p class="card-text">Mitra</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card" style="width: 12rem;">
                        <a href="login.php?user=6"><img class="card-img-top" src="image/alumni.png" alt="Card image cap"></a>
                        <div class="card-body">
                            <p class="card-text">Alumni</p>
                        </div>
                    </div>
                </div>
                </div>
            </div >
        </div>
        <div class="footer">
        <footer class="footer-distributed">
            <div class="footerleft">
                <img src="image/logo_polinema.png" alt="Logo Polinema" style="width: 7em;margin-right:2em;">
            </div>
            <div class="floatleft">
                    <p class="footer-company-name">Alamat: Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur</p>
                    <p class="footer-company-name">(0341) 404424</p>
                    <p class="footer-company-name"> polinema@gmail.ac.id</p>
                </div>
            <div class="footer-center">
                <div>
                    <i class="fa fa-map-marker" style="margin-right:20em"></i>
                    <p><span>Copyright Ⓒ 2024 Politeknik Negeri Malang</span></p>
                </div> 
            </div>
        </footer>
        </div>
    </div>
</body>
</html>