<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
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

    public function get_answer($responden_mahasiswa_id) {
        $query = "SELECT * FROM hasil_jawaban_mahasiswa h 
                  INNER JOIN soal s ON h.soal_id = s.nomor_urut_soal 
                  WHERE responden_mahasiswa_id = ? ORDER BY s.nomor_urut_soal";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $responden_mahasiswa_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}

$koneksi = new Koneksi();
$survey = new Survey($koneksi->conn);

$responden_mahasiswa_id = $_SESSION['user_id'];
$questions = $survey->get_answer($responden_mahasiswa_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Bootstrap.min.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <title>Hasil Survey</title>
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
        p, li {
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
                <button type="button" class="btn btn-secondary">Hasil Survey Kepuasan Politeknik Negeri Malang</button>
                <p><b>Berikut adalah hasil survey Anda:</b><br>
                Keterangan tingkat kepuasan:
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
                        if (!isset($row['soal_id'])) {
                            continue;
                        }
                        $counter++;
                    ?>
                    <div class="form-group">
                        <p class="card-text"><?php echo $counter . '. ' . htmlspecialchars($row['soal_nama']); ?></p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="<?php echo 'soal_'.$row['soal_id']; ?>" disabled id="option1_<?php echo $row['soal_id']; ?>" value="1" <?php if($row['jawaban1'] == 1) echo 'checked'; ?> required>
                            <label class="form-check-label" for="option1_<?php echo $row['soal_id']; ?>">Sangat Tidak Puas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="<?php echo 'soal_'.$row['soal_id']; ?>" disabled id="option2_<?php echo $row['soal_id']; ?>" value="2" <?php if($row['jawaban2'] == 1) echo 'checked'; ?>>
                            <label class="form-check-label" for="option2_<?php echo $row['soal_id']; ?>">Tidak Puas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="<?php echo 'soal_'.$row['soal_id']; ?>" disabled id="option3_<?php echo $row['soal_id']; ?>" value="3" <?php if($row['jawaban3'] == 1) echo 'checked'; ?>>
                            <label class="form-check-label" for="option3_<?php echo $row['soal_id']; ?>">Puas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="<?php echo 'soal_'.$row['soal_id']; ?>" disabled id="option4_<?php echo $row['soal_id']; ?>" value="4" <?php if($row['jawaban4'] == 1) echo 'checked'; ?>>
                            <label class="form-check-label" for="option4_<?php echo $row['soal_id']; ?>">Sangat Puas</label>
                        </div>
                    </div>
                    <?php 
                    } ?>
                    <div class="row">
                        <a href="opsiSurvey.php" style="margin-left: 2em;">
                            <button type="button" class="btn btn-light btn-login">BACK</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
