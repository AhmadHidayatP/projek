<?php
// Memulai session PHP
session_start();

// Menghubungkan ke file koneksi.php yang berisi skrip untuk menghubungkan ke database
include 'koneksi.php';

// Menghubungkan ke file csrf.php untuk manajemen token CSRF (Namun, penggunaan token CSRF tidak terlihat dalam kode ini)
// include 'csrf.php';

// Mendapatkan ID anggota dari permintaan POST
$id = $_POST['id'];

// Membuat query untuk mengambil data anggota berdasarkan ID
$query = "SELECT * FROM anggota WHERE id=? ORDER BY id DESC";

// Menyiapkan dan mengeksekusi statement SQL menggunakan parameterized query untuk mencegah serangan SQL injection
$sql = $db1->prepare($query);
$sql->bind_param('i', $id);
$sql->execute();

// Mendapatkan hasil dari eksekusi statement SQL
$res1 = $sql->get_result();

// Menginisialisasi array asosiatif untuk menyimpan data anggota
// $h = array();

// Mengambil data anggota dari hasil query dan menyimpannya dalam array asosiatif
while ($row = $res1->fetch_assoc()) {
    $h['id'] = $row["id"];
    $h['nama'] = $row["nama"];
    $h['jenis_kelamin'] = $row["jenis_kelamin"];
    $h['alamat'] = $row["alamat"];
    $h['no_telp'] = $row["no_telp"];
}

// Mengembalikan data anggota dalam format JSON
echo json_encode($h);

// Menutup koneksi ke database
$db1->close();
?>