<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    echo '<script language="javascript">alert("Login terlebih dahulu!");</script>';
    exit(); 
}

require_once 'koneksi.php';

class pilihSurvey {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function pilih($id_user) {
        $query = "SELECT keterangan FROM user WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}

$koneksi = new Koneksi();
$pilih = new pilihSurvey($koneksi->conn);

$user_id = $_SESSION['user_id']; 
$user_info = $pilih->pilih($user_id);
$keterangan = $user_info['keterangan'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Bootstrap.min.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/footer.css">
    <title>Pilih Survey | Kelompok 6</title>
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
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var keterangan = '<?php echo $keterangan; ?>'; 
        if(keterangan === "mahasiswa") {
            document.getElementById('kd').style.marginLeft = "17em";
            document.getElementById('kp').style.visibility = 'hidden';
            document.getElementById('kl').style.visibility = 'hidden';
        } else if(keterangan === "orang_tua") {
            document.getElementById('kp').style.marginLeft = "17em";
            document.getElementById('kd').style.visibility = 'hidden';
            document.getElementById('kf').style.visibility = 'hidden';
        } else if(keterangan === "tendik") {
            document.getElementById('kf').style.marginLeft = "23em";
            document.getElementById('kd').style.visibility = 'hidden';
            document.getElementById('kp').style.visibility = 'hidden';
            document.getElementById('kl').style.visibility = 'hidden';
        } else if(keterangan === "mitra") {
            document.getElementById('kf').style.marginLeft = "11em";
            document.getElementById('kd').style.visibility = 'hidden';
        } else {
        }
    });
    </script>
</head>
<body> 
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand"><b>SISPOLNI</b></a>
        <form class="form-inline">
            <a href="#"><i class="fas fa-user mx-1"></i><?php echo ($_SESSION['username']); ?></a>
        </form>
    </nav>
    <div class="jumbotron" style="background-image: url(image/main.png); background-size: cover; height: 28em; padding: 2em; background-repeat: no-repeat;">
        <div class="row justify-content-center">
            <div class="col text-center" style="margin-top: 2em;">
                <img src="image/survey/isi.png" style="width: 20%;">
                <div class="container col" style="justify-content: center; align-items: center; align-content: center;">
                    <a href="surveyPendidikan.php">
                        <button type="button" class="btn btn-info" id="kd">Kualitas Pendidikan</button>
                    </a>
                    <a href="surveyFasilitas.php">
                        <button type="button" class="btn btn-info" id="kf">Kualitas Fasilitas</button>
                    </a>
                    <a href="surveyPelayanan.php">
                        <button type="button" class="btn btn-info" id="kp">Kualitas Pelayanan</button>
                    </a>
                    <a href="surveyLulusan.php">
                        <button type="button" class="btn btn-info" id="kl">Kualitas Lulusan</button>
                    </a>
                </div>
                <div class="row right" style="margin-top: 1em">
                    <a href="opsiSurvey.php">
                        <button type="button" class="btn btn-light btn-login">Back</button>
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
                <p class="footer-company-name">polinema@gmail.ac.id</p>
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
