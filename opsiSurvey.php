<?php
session_start();
if (!isset($_SESSION['username'])){
    echo '<script language="javascript">alert("Login terlebih dahulu!");</script>';
    header("Location: login.php");
    exit();
}
require_once 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Bootstrap.min.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <title>Opsi Survey Politeknik Negeri Malang</title>
    <style>
        body {
            background-color: #505BAD;
        }
        .right {
            align-items: right;
            display: flex;
            justify-content: right;
        }
    </style>
</head>
<body> 
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand"><b>SISPOLNI</b></a>
        <form class="form-inline">
            <div class="d-flex flex-column align-items-center">
                <a href="input_mahasiswa.php" class="text-decoration-none">
                    <i class="fas fa-user mx-1"></i><?php echo $_SESSION['username']; ?>
                </a>
            </div>
        </form>
    </nav>
    <div class="jumbotron" style="background-image: url(image/main.png); background-size: cover; height: 28em; padding: 2em; background-repeat: no-repeat;">
        <div class="row justify-content-center">
            <div class="col text-center" style="margin-top: 2em;">
                <a href="pilihSurvey.php">
                    <img src="image/survey/isi.png" style="width: 20%;">
                </a>
                <a href="riwayatSurvey.php">
                    <img src="image/survey/riwayat.png" style="width: 25%;">
                </a>
                <div class="row right" style="margin-top: 4em">
                    <a href="logout.php">
                        <button type="button" class="btn btn-light btn-login">Logout</button>
                    </a>
                </div>
            </div>
        </div> 
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
</body>
</html>
