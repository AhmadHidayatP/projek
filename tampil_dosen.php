<?php
session_start();
require_once 'koneksi.php';

class InputDosen {
    private $db;

    public function __construct() {
        $this->db = new Koneksi();
    }

    public function create($responden_tanggal, $nip, $nama, $unit) {
        $query = "INSERT INTO biodata_responden_dosen (responden_tanggal, nip, nama, unit) 
        VALUES ('$responden_tanggal', '$nip', '$nama', '$unit')";
        $result = $this->db->conn->query($query);

        return $result;
    }
}

$inputDosen = new InputDosen();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responden_tanggal = $_POST['tanggal_pengisian_biodata'];
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $unit = $_POST['unit'];

    if ($inputDosen->create($responden_tanggal, $nip, $nama, $unit)) {
        $_SESSION['recent_data'] = [
            'responden_tanggal' => $responden_tanggal,
            'nip' => $nip,
            'nama' => $nama,
            'unit' => $unit
        ];
        header("Location: tampil_dosen.php");
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
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Unit</th>
                </tr>
                <tr>
                    <td>{$recentData['responden_tanggal']}</td>
                    <td>{$recentData['nip']}</td>
                    <td>{$recentData['nama']}</td>
                    <td>{$recentData['unit']}</td>
                </tr>
              </table>";
        unset($_SESSION['recent_data']);
    } else {
        echo "<p>Tidak ada data baru yang ditambahkan.</p>";
    }
    ?>
        <form action="input_dosen.php">
            <input type="button" value="Kembali" onclick="window.location.href = 'input_dosen.php'">
            </form>

    </body>
</html>
