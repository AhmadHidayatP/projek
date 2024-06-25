<?php
    class Mahasiswa {
        private $database;
    
        public function __construct($database) {
            $this->database = $database;
        }
    
        public function update_mahasiswa($nim, $nama, $program_studi, $email, $nomor_hp, $tahun_masuk) {        
            $queryUpdate_mahasiswa = "UPDATE biodata_responden_mahasiswa SET 
                nama = '$nama', 
                program_studi = '$program_studi', 
                email = '$email', 
                nomor_hp = '$nomor_hp', 
                tahun_masuk = '$tahun_masuk'
                WHERE nim = '$nim'";
            
            if ($this->database->conn->query($queryUpdate_mahasiswa) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $this->database->conn->error;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Biodata Mahasiswa</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <form action="tampil_bio_mahasiswa.php" method="POST">
        <label for="nim">NIM:</label><br>
        <input type="text" id="nim" name="nim" required><br><br>

        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="program_studi">Program Studi:</label><br>
        <input type="text" id="program_studi" name="program_studi" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="nomor_hp">Nomor HP:</label><br>
        <input type="text" id="nomor_hp" name="nomor_hp" required><br><br>

        <label for="tahun_masuk">Tahun Masuk:</label><br>
        <input type="text" id="tahun_masuk" name="tahun_masuk" required><br><br>

        <input type="submit" value="Update">
</form>

</body>
</html>

