<?php
class Koneksi {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbName = 'skpp_db';
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbName);
        
        if ($this->conn->connect_error) {
            die("Koneksi database gagal: " . $this->conn->connect_error);
        }
    }
}
?>
