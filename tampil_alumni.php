<?php
session_start();
require_once 'koneksi.php';

class InputAlumni {
    private $db;

    public function __construct() {
        $this->db = new Koneksi();
    }

    public function create($responden_tanggal, $nim, $nama, $program_studi, $email, $nomor_hp, $tahun_lulus) {
        $query = "INSERT INTO biodata_responden_alumni (responden_tanggal, nim, nama, program_studi, email, nomor_hp, tahun_lulus) 
        VALUES ('$responden_tanggal', '$nim', '$nama', '$program_studi', '$email', '$nomor_hp', '$tahun_lulus')";
        $result = $this->db->conn->query($query);

        return $result;
    }
}

$inputAlumni = new InputAlumni();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responden_tanggal = $_POST['tanggal_pengisian_biodata'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $program_studi = $_POST['program_studi'];
    $email = $_POST['email'];
    $nomor_hp = $_POST['nomor_hp'];
    $tahun_lulus = $_POST['tahun_lulus'];

    if ($inputAlumni->create($responden_tanggal, $nim, $nama, $program_studi, $email, $nomor_hp, $tahun_lulus)) {
        $_SESSION['recent_data'] = [
            'responden_tanggal' => $responden_tanggal,
            'nim' => $nim,
            'nama' => $nama,
            'program_studi' => $program_studi,
            'email' => $email,
            'nomor_hp' => $nomor_hp,
            'tahun_lulus' => $tahun_lulus,
        ];
        header("Location: tampil_alumni.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $this->db->conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Responden Alumni</title>
</head>
<body>
    <h1>Data Responden Orang Alumni</h1>
    <?php
    if (isset($_SESSION['recent_data'])) {
        $recentData = $_SESSION['recent_data'];
        echo "<table border='1'>
                <tr>
                    <th>Tanggal Pengisian Biodata</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>Email</th>
                    <th>Nomor Hp</th>
                    <th>Tahun Lulus</th>
                </tr>
                <tr>
                    <td>{$recentData['responden_tanggal']}</td>
                    <td>{$recentData['nim']}</td>
                    <td>{$recentData['nama']}</td>
                    <td>{$recentData['program_studi']}</td>
                    <td>{$recentData['email']}</td>
                    <td>{$recentData['nomor_hp']}</td>
                    <td>{$recentData['tahun_lulus']}</td>
                </tr>
              </table>";
        unset($_SESSION['recent_data']);
    } else {
        echo "<p>Tidak ada data baru yang ditambahkan.</p>";
    }
    ?>
        <form action="input_alumni.php">
            <input type="button" value="Kembali" onclick="window.location.href = 'input_alumni.php'">
            </form>

    </body>
</html>
