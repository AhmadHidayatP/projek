<?php
    // Membuat Token keamanan Ajax request (Csrf Token)
    session_start();
    if(empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
?>

<!--memeriksa apakah token CSRF sudah ada di sesi tersebut, dan jika tidak, 
membuat yang baru menggunakan random_bytes(32)
fungsi dan menyimpannya dalam array sesi $_SESSION['csrf_token'].-->