<?php
// Memulai sesi PHP
session_start();

// Menghubungkan ke file koneksi.php yang berisi skrip untuk menghubungkan ke database
include 'koneksi.php';

// Menghubungkan ke file csrf.php untuk manajemen token CSRF (Namun, penggunaan token CSRF tidak terlihat dalam kode ini)
 // include 'csrf.php';

// Mendapatkan ID anggota dari permintaan POST
$id = $_POST['id'];

// Membuat query untuk menghapus data anggota berdasarkan ID
$query = "DELETE FROM anggota WHERE id=?";

// Menyiapkan dan mengeksekusi statement SQL menggunakan parameterized query untuk mencegah serangan SQL injection
$sql = $db1->prepare($query);
$sql->bind_param("i", $id);
$sql->execute();

// Mengembalikan respons dalam format JSON yang menyatakan sukses
echo json_encode(['success' => 'Sukses']);

// Menutup koneksi ke database
$db1->close();
?>