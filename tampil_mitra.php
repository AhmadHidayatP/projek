<?php
session_start();
require_once 'koneksi.php';

class InputMitra {
    private $db;

    public function __construct() {
        $this->db = new Koneksi();
    }

    public function create($responden_tanggal, $nama, $jabatan, $perusahaan, $email, $nomor_hp, $kota) {
        $query = "INSERT INTO biodata_responden_mitra (responden_tanggal, nama, jabatan, perusahaan, email, nomor_hp, kota) 
        VALUES ('$responden_tanggal', '$nama','$jabatan' ,'$perusahaan', '$email', '$nomor_hp', '$kota')";
        $result = $this->db->conn->query($query);

        return $result;
    }
}

$inputMitra = new InputMitra();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responden_tanggal = $_POST['tanggal_pengisian_biodata'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $perusahaan = $_POST['perusahaan'];
    $email = $_POST['email'];
    $nomor_hp = $_POST['nomor_hp'];
    $kota = $_POST['kota'];

    if ($inputMitra->create($responden_tanggal, $nama, $jabatan, $perusahaan, $email, $nomor_hp, $kota)) {
        $_SESSION['recent_data'] = [
            'responden_tanggal' => $responden_tanggal,
            'nama' => $nama,
            'jabatan' => $jabatan,
            'perusahaan' => $perusahaan,
            'email' => $email,
            'nomor_hp' => $nomor_hp,
            'kota' => $kota,
        ];
        header("Location: tampil_mitra.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $this->db->conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Responden Mitra</title>
</head>
<body>
    <h1>Data Responden Mitra Polinema</h1>
    <?php
    if (isset($_SESSION['recent_data'])) {
        $recentData = $_SESSION['recent_data'];
        echo "<table border='1'>
                <tr>
                    <th>Tanggal Pengisian Biodata</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Perusahaan</th>
                    <th>Email</th>
                    <th>Nomor HP</th>
                    <th>Kota</th>
                </tr>
                <tr>
                    <td>{$recentData['responden_tanggal']}</td>
                    <td>{$recentData['nama']}</td>
                    <td>{$recentData['jabatan']}</td>
                    <td>{$recentData['perusahaan']}</td>
                    <td>{$recentData['email']}</td>
                    <td>{$recentData['nomor_hp']}</td>
                    <td>{$recentData['kota']}</td>
                </tr>
              </table>";
        unset($_SESSION['recent_data']);
    } else {
        echo "<p>Tidak ada data baru yang ditambahkan.</p>";
    }
    ?>
        <form action="input_mitra.php"><br>
            <input type="button" value="Kembali" onclick="window.location.href = 'input_mitra.php'">
            </form>

    </body>
</html>
