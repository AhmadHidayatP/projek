<?php
class Koneksi {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "skpp_db";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbName);
        
        if ($this->conn->connect_error) {
            die("Koneksi database gagal: " . $this->conn->connect_error);
        }
    }
}

class CRUD extends Koneksi {
    public function create($nim, $nama, $program_studi, $email, $nomor_hp, $tahun_masuk) {
        $query = "INSERT INTO students (nim, nama, program_studi, email, nomor_hp, tahun_masuk) VALUES ('$nim', '$nama', '$program_studi', '$email', '$nomor_hp', '$tahun_masuk')";
        if ($this->conn->query($query) === TRUE) {
            echo "Data berhasil ditambahkan.";
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

    public function read($nim) {
        $query = "SELECT * FROM students WHERE nim='$nim'";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "NIM: " . $row["nim"]. " - Nama: " . $row["nama"]. " - Program Studi: " . $row["program_studi"]. " - Email: " . $row["email"]. " - Nomor HP: " . $row["nomor_hp"]. " - Tahun Masuk: " . $row["tahun_masuk"]. "<br>";
            }
        } else {
            echo "Data tidak ditemukan.";
        }
    }

    public function update($nim, $nama, $program_studi, $email, $nomor_hp, $tahun_masuk) {
        $query = "UPDATE students SET nama='$nama', program_studi='$program_studi', email='$email', nomor_hp='$nomor_hp', tahun_masuk='$tahun_masuk' WHERE nim='$nim'";
        if ($this->conn->query($query) === TRUE) {
            echo "Data berhasil diupdate.";
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

    public function delete($nim) {
        $query = "DELETE FROM students WHERE nim='$nim'";
        if ($this->conn->query($query) === TRUE) {
            echo "Data berhasil dihapus.";
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $crud = new CRUD();

    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $program_studi = $_POST['program_studi'];
    $email = $_POST['email'];
    $nomor_hp = $_POST['nomor_hp'];
    $tahun_masuk = $_POST['tahun_masuk'];

    if (isset($_POST['create'])) {
        $crud->create($nim, $nama, $program_studi, $email, $nomor_hp, $tahun_masuk);
    } elseif (isset($_POST['read'])) {
        $crud->read($nim);
    } elseif (isset($_POST['update'])) {
        $crud->update($nim, $nama, $program_studi, $email, $nomor_hp, $tahun_masuk);
    } elseif (isset($_POST['delete'])) {
        $crud->delete($nim);
    }
}
?>
