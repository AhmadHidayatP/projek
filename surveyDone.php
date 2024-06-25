<?php
    session_start();
    if (!isset($_SESSION['username'])){
        header("Location: login.php");
        echo '<script language="javascript">alert("Login terlebih dahulu!");</script>';
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
        button {
            width: 7em;
            background: #fff;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
            border-radius: 15px;
        }
        .footer-company-name {
            font-size: 13px;
            font-weight: 500;
        }
    </style>
</head>
<body> 
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand"><b>SISPOLNI</b></a>
            <form class="form-inline">
                <a href=#><i class="fas fa-user mx-1"></i><?php echo $_SESSION['username'];?></a>
            </form>
        </nav>
        <div class="jumbotron jumbotron-fluid">
            <div class="container" style="margin-left: 5px;">
                <div class="col text-center" style="margin-top: 2em;margin-left: 7em">
                    <img src="image/survey/surveydone.png" style="width: 20%;">
                    <p>
                        <b>
                            Terima kasih telah mengisi, survey anda telah terkirim!
                        </b>
                    </p>
                    <a href="opsiSurvey.php">
                            <button type="button" class="btn btn-light btn-login"><b>DONE<b></button>
                    </a>               
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