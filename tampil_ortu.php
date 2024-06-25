<?php
session_start();
require_once 'koneksi.php';

class InputOrtu {
    private $db;

    public function __construct() {
        $this->db = new Koneksi();
    }

    public function create($responden_tanggal, $nama, $jenis_kelamin, $umur, $nomor_hp, $pendidikan, $pekerjaan, $penghasilan, $nim_mahasiswa, $nama_mahasiswa, $program_studi_mahasiswa) {
        $query = "INSERT INTO biodata_responden_ortu (responden_tanggal, nama, jenis_kelamin, umur, nomor_hp, pendidikan, pekerjaan, penghasilan, nim_mahasiswa, nama_mahasiswa, program_studi_mahasiswa) VALUES ('$responden_tanggal', '$nama', '$jenis_kelamin', '$umur', '$nomor_hp', '$pendidikan', '$pekerjaan', '$penghasilan', '$nim_mahasiswa', '$nama_mahasiswa', '$program_studi_mahasiswa')";
        $result = $this->db->conn->query($query);

        return $result;
    }
}

$inputOrtu = new InputOrtu();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responden_tanggal = $_POST['tanggal_pengisian_biodata'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $umur = $_POST['umur'];
    $nomor_hp = $_POST['nomor_hp'];
    $pendidikan = $_POST['pendidikan'];
    $pekerjaan = $_POST['pekerjaan'];
    $penghasilan = $_POST['penghasilan'];
    $nim_mahasiswa = $_POST['nim_mahasiswa'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $program_studi_mahasiswa = $_POST['program_studi_mahasiswa'];

    if ($inputOrtu->create($responden_tanggal, $nama, $jenis_kelamin, $umur, $nomor_hp, $pendidikan, $pekerjaan, $penghasilan, $nim_mahasiswa, $nama_mahasiswa, $program_studi_mahasiswa)) {
        $_SESSION['recent_data'] = [
            'responden_tanggal' => $responden_tanggal,
            'nama' => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'umur' => $umur,
            'nomor_hp' => $nomor_hp,
            'pendidikan' => $pendidikan,
            'pekerjaan' => $pekerjaan,
            'penghasilan' => $penghasilan,
            'nim_mahasiswa' => $nim_mahasiswa,
            'nama_mahasiswa' => $nama_mahasiswa,
            'program_studi_mahasiswa' => $program_studi_mahasiswa
        ];
        header("Location: tampil_ortu.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $this->db->conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Responden Orang Tua</title>
</head>
<body>
    <h1>Data Responden Orang Tua</h1>
    <?php
    if (isset($_SESSION['recent_data'])) {
        $recentData = $_SESSION['recent_data'];
        echo "<table border='1'>
                <tr>
                    <th>Tanggal Pengisian Biodata</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Umur</th>
                    <th>Nomor HP</th>
                    <th>Pendidikan</th>
                    <th>Pekerjaan</th>
                    <th>Penghasilan</th>
                    <th>NIM Mahasiswa</th>
                    <th>Nama Mahasiswa</th>
                    <th>Program Studi Mahasiswa</th>
                </tr>
                <tr>
                    <td>{$recentData['responden_tanggal']}</td>
                    <td>{$recentData['nama']}</td>
                    <td>{$recentData['jenis_kelamin']}</td>
                    <td>{$recentData['umur']}</td>
                    <td>{$recentData['nomor_hp']}</td>
                    <td>{$recentData['pendidikan']}</td>
                    <td>{$recentData['pekerjaan']}</td>
                    <td>{$recentData['penghasilan']}</td>
                    <td>{$recentData['nim_mahasiswa']}</td>
                    <td>{$recentData['nama_mahasiswa']}</td>
                    <td>{$recentData['program_studi_mahasiswa']}</td>
                </tr>
              </table>";
        unset($_SESSION['recent_data']);
    } else {
        echo "<p>Tidak ada data baru yang ditambahkan.</p>";
    }
    ?>
        <form action="input_ortu.php">
            <input type="button" value="Kembali" onclick="window.location.href = 'input_ortu.php'">
            </form>

    </body>
</html>
