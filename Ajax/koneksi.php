<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB1', 'prakwebdb');

// Membuat koneksi
$db1 = new mysqli(HOST, USER, PASS, DB1);
?>

<!-- Terdapat define adalah yang digunakan untuk menetapkan konstanta yang tidak dapat diubah nilainya untuk membuat koneksi ke database -->