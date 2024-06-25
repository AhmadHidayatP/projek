<?php
session_start();
if (!isset($_SESSION['username'])|| !isset($_SESSION['user_id'])){
    header("Location: login.php");
    echo '<script language="javascript">alert("Login terlebih dahulu!");</script>';
    exit();
}

require_once 'koneksi.php';

class Survey {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function get_pertanyaan($start, $end) {
        $query = "SELECT * FROM soal WHERE nomor_urut_soal BETWEEN ? AND ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii', $start, $end);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function simpan($responden_mahasiswa_id, $answers) {
        foreach ($answers as $soal_id => $jawaban) {
            $jawaban1 = $jawaban == 1 ? 1 : 0;
            $jawaban2 = $jawaban == 2 ? 1 : 0;
            $jawaban3 = $jawaban == 3 ? 1 : 0;
            $jawaban4 = $jawaban == 4 ? 1 : 0;

            $query = "INSERT INTO hasil_jawaban_mahasiswa 
                      (responden_mahasiswa_id, soal_id, jawaban1, jawaban2, jawaban3, jawaban4) 
                      VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('iiiiii', $responden_mahasiswa_id, $soal_id, $jawaban1, $jawaban2, $jawaban3, $jawaban4);
            $stmt->execute();
        }
    }
}

$koneksi = new Koneksi();
$survey = new Survey($koneksi->conn);

$responden_mahasiswa_id = $_SESSION['user_id'];
$questions = $survey->get_pertanyaan(11, 15);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $answers = [];
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'soal_') === 0) {
            $soal_id = str_replace('soal_', '', $key);
            $answers[$soal_id] = $value;
        }
    }
    $survey->simpan($responden_mahasiswa_id, $answers);
    header("Location: surveyDone.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Bootstrap.min.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <title>Survey Fasilitas</title>
    <style>
        body {
            background-color: #B9B8BB;
            overflow-x: hidden;
        }
        .right {
            align-items: right;
            display: flex;
            justify-content: right;
        }
        .jumbotron {
            background-color: #363636;
        }
        p, li{
            color: #fff;
        }
        .card-text {
            font-weight: 600;
            color: #000;
        }
        .form-group {
            margin-bottom: 1.5rem;
            width: 100%;
        }
        .form-check-inline {
            display: block;
            margin-bottom: .5rem;
        }
        .btn-login {
            margin-left: 1em;
        }
        .navbar a {
            text-decoration: none;
            color: #000;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand"><b>SISPOLNI</b></a>
        <form class="form-inline">
            <a href="#"><i class="fas fa-user mx-1"></i><?php echo $_SESSION['username']; ?></a>
        </form>
    </nav>
    <div class="jumbotron jumbotron-fluid">
        <div class="container" style="margin-left: 5px;">
            <div class="col">
                <button type="button" class="btn btn-secondary">Kualitas Fasilitas Politeknik Negeri Malang</button>
                <p><b>PETUNJUK PENGISIAN</b><br>
                Pada bagian Jawaban terdapat empat pilihan dengan keterangan sebagai berikut:
                <ol>
                    <li>Sangat Tidak Puas</li>
                    <li>Tidak puas</li>
                    <li>Puas</li>
                    <li>Sangat Puas</li>
                </ol>
                </p>
            </div>
        </div>
    </div>
    <div class="container justify-content-center">
        <div class="card" style="width: 65rem;">
            <div class="card-body">
                <form method="POST" action="">
                    <?php
                    $counter = 0;
                    while ($row = $questions->fetch_assoc()) {
                        if (!isset($row['nomor_urut_soal'])) {
                            continue;
                        }
                        $counter++;
                    ?>
                    <div class="form-group">
                        <p class="card-text"><?php echo $counter . '. ' . htmlspecialchars($row['soal_nama']); ?></p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="<?php echo 'soal_'.$row['nomor_urut_soal']; ?>" id="option1_<?php echo $row['nomor_urut_soal']; ?>" value="1" required>
                            <label class="form-check-label" for="option1_<?php echo $row['nomor_urut_soal']; ?>">Sangat Tidak Puas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="<?php echo 'soal_'.$row['nomor_urut_soal']; ?>" id="option2_<?php echo $row['nomor_urut_soal']; ?>" value="2 ">
                            <label class="form-check-label" for="option2_<?php echo $row['nomor_urut_soal']; ?>">Tidak Puas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="<?php echo 'soal_'.$row['nomor_urut_soal']; ?>" id="option3_<?php echo $row['nomor_urut_soal']; ?>" value="3">
                            <label class="form-check-label" for="option3_<?php echo $row['nomor_urut_soal']; ?>">Puas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="<?php echo 'soal_'.$row['nomor_urut_soal']; ?>" id="option4_<?php echo $row['nomor_urut_soal']; ?>" value="4">
                            <label class="form-check-label" for="option4_<?php echo $row['nomor_urut_soal']; ?>">Sangat Puas</label>
                        </div>
                    </div>
                    <?php 
                    } ?>
                    <div class="row">
                        <a href="opsiSurvey.php" style="margin-left: 2em;">
                            <button type="button" class="btn btn-light btn-login">BACK</button>
                        </a>
                        <button type="submit" class="btn btn-light btn-login" style="margin-left: auto; margin-right: 2em;">DONE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
