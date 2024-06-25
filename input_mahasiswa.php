<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo '<script language="javascript">alert("Login terlebih dahulu!");</script>';
    header("Location: login.php");
    exit;
}
require_once 'koneksi.php';

class Mahasiswa {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function get_mahasiswa($id) {
        $query = "SELECT * FROM biodata_responden_mahasiswa WHERE responden_mahasiswa_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function update_mahasiswa($nim, $nama, $program_studi, $email, $nomor_hp, $tahun_masuk) {        
        $queryUpdate_mahasiswa = "UPDATE biodata_responden_mahasiswa SET 
            nama = ?, 
            program_studi = ?, 
            email = ?, 
            nomor_hp = ?, 
            tahun_masuk = ?
            WHERE nim = ?";
        
        $stmt = $this->conn->prepare($queryUpdate_mahasiswa);
        $stmt->bind_param('ssssss', $nama, $program_studi, $email, $nomor_hp, $tahun_masuk, $nim);
        
        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    }

    public function insert_mahasiswa($nim, $nama, $program_studi, $email, $nomor_hp, $tahun_masuk) {        
        $queryInsert_mahasiswa = "INSERT INTO biodata_responden_mahasiswa 
            (nim, nama, program_studi, email, nomor_hp, tahun_masuk)
            VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($queryInsert_mahasiswa);
        $stmt->bind_param('ssssss', $nim, $nama, $program_studi, $email, $nomor_hp, $tahun_masuk);
        
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

$id = $_SESSION['id'];
$koneksi = new Koneksi();
$mahasiswa = new Mahasiswa($koneksi->conn);

$result = $mahasiswa->get_mahasiswa($id);
$data = $result->fetch_assoc();

$nim = isset($data['nim']) ? $data['nim'] : '';
$nama = isset($data['nama']) ? $data['nama'] : '';
$program_studi = isset($data['program_studi']) ? $data['program_studi'] : '';
$email = isset($data['email']) ? $data['email'] : '';
$nomor_hp = isset($data['nomor_hp']) ? $data['nomor_hp'] : '';
$tahun_masuk = isset($data['tahun_masuk']) ? $data['tahun_masuk'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $program_studi = $_POST['program_studi'];
    $email = $_POST['email'];
    $nomor_hp = $_POST['nomor_hp'];
    $tahun_masuk = $_POST['tahun_masuk'];

    if (isset($data['nim'])) {
        $mahasiswa->update_mahasiswa($nim, $nama, $program_studi, $email, $nomor_hp, $tahun_masuk);
    } else {
        $mahasiswa->insert_mahasiswa($nim, $nama, $program_studi, $email, $nomor_hp, $tahun_masuk);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Bootstrap.min.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <title>Input Biodata Mahasiswa</title>
    <style>
        body {
            background-color: #505BAD;
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
    <div class="container mt-4">
        <h2>Input Biodata Mahasiswa</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo htmlspecialchars($nim); ?>" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
            </div>
            <div class="form-group">
                <label for="program_studi">Program Studi:</label>
                <input type="text" class="form-control" id="program_studi" name="program_studi" value="<?php echo htmlspecialchars($program_studi); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="nomor_hp">Nomor HP:</label>
                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="<?php echo htmlspecialchars($nomor_hp); ?>" required>
            </div>
            <div class="form-group">
                <label for="tahun_masuk">Tahun Masuk:</label>
                <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk" value="<?php echo htmlspecialchars($tahun_masuk); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="footer mt-4">
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
