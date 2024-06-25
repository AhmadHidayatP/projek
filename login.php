<?php
session_start();
unset($_SESSION["id"]);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $_SESSION['user'] = $_GET['user'];
} 
require_once 'koneksi.php';

class User {
    private $conn;
    private $table = "user";

    public function __construct(mysqli $db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username=? AND password=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['user_id']; 
            $_SESSION['username'] = $username;
            return true;
        } else {
            return false;
        }
    }
    public function loginAdmin($username, $password) {
      $query = "SELECT * FROM admin WHERE username=? AND password=?";
      $stmt = $this->conn->prepare($query);
      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          $admin = $result->fetch_assoc();
          $_SESSION['id_admin'] = $admin['id_admin']; 
          $_SESSION['username'] = $username;
          return true;
      } else {
          return false;
      }
  }
}

$koneksi = new Koneksi();
$user = new User($koneksi->conn);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username != "admin") {
          if ($user->login($username, $password)) {       
            header("Location: opsiSurvey.php");
            exit();
        } else {
          $error_message = "Username atau password salah!"; 
        }
    } else {
      if ($user->loginAdmin($username, $password)) {       
          $_SESSION['admin'] = $username;
            header("Location: admin/index.php");
            exit();
    } else {
        $error_message = "Username atau password salah!"; 
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Login page</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel="stylesheet" href="css/style.css">
  <style>
    img {
      width: 100%;
    }
    body {
      background-color: #1C2256;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row main-content bg-success">
      <div class="col-md-8 col-xs-12 col-sm-12 login_form">
        <div class="container-fluid">
          <div class="row">
            <h2><b>Login</b></h2>
            <p>Masuk dengan akun anda!</p>
          </div>
          <div class="row">
            <form method="POST" class="form-group" action="">
              <div class="row">
                <input type="text" name="username" id="username" class="form__input" placeholder="Username">
              </div>
              <div class="row">
                <input type="password" name="password" id="password" class="form__input" placeholder="Password">
              </div>
              <div class="row">
                <input type="checkbox" name="remember_me" id="remember_me" class="">
                <label for="remember_me">Ingat Saya</label>
              </div>
              <div class="row text-center">
                <input type="submit" value="Login" class="btn">
              </div>
            </form>
          </div>
          <div class="row text-center">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($error_message)) {
              echo '<script language="javascript">alert("Username atau password salah!"); document.location="login.php";</script>';
            }
            ?>
            <p><a href="register.php">Register</a></p>
          </div>
        </div>
      </div>
      <div class="col-md-4 text-center company__info">
        <span class="company__logo"><h2><img src="image/login.png"></h2></span>
      </div>
    </div>
  </div>
</body>
</html>
