<?php
session_start();
require_once 'koneksi.php';

class InputTendik {
    private $db;

    public function __construct() {
        $this->db = new Koneksi();
    }

    public function create($responden_tanggal, $nomor_pegawai, $nama, $unit) {
        $query = "INSERT INTO biodata_responden_tendik (responden_tanggal, nomor_pegawai, nama, unit) 
        VALUES ('$responden_tanggal', '$nomor_pegawai','$nama', '$unit')";
        $result = $this->db->conn->query($query);

        return $result;
    }
}

$inputTendik = new InputTendik();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responden_tanggal = $_POST['tanggal_pengisian_biodata'];
    $nomor_pegawai = $_POST['nomor_pegawai'];
    $nama = $_POST['nama'];
    $unit = $_POST['unit'];

    if ($inputTendik->create($responden_tanggal, $nomor_pegawai, $nama, $unit)) {
        $_SESSION['recent_data'] = [
            'responden_tanggal' => $responden_tanggal,
            'nomor_pegawai' => $nomor_pegawai,
            'nama' => $nama,
            'unit' => $unit,
        ];
        header("Location: tampil_tendik.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $this->db->conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Responden Tendik</title>
</head>
<body>
    <h1>Data Responden Tenaga Kependidikan</h1>
    <?php
    if (isset($_SESSION['recent_data'])) {
        $recentData = $_SESSION['recent_data'];
        echo "<table border='1'>
                <tr>
                    <th>Tanggal Pengisian Biodata</th>
                    <th>Nomor Pegawai</th>
                    <th>Nama</th>
                    <th>Unit</th>
                </tr>
                <tr>
                    <td>{$recentData['responden_tanggal']}</td>
                    <td>{$recentData['nomor_pegawai']}</td>
                    <td>{$recentData['nama']}</td>
                    <td>{$recentData['unit']}</td>
                </tr>
              </table>";
        unset($_SESSION['recent_data']);
    } else {
        echo "<p>Tidak ada data baru yang ditambahkan.</p>";
    }
    ?>
        <form action="input_tendik.php"><br>
            <input type="button" value="Kembali" onclick="window.location.href = 'input_tendik.php'">
            </form>

    </body>
</html>
