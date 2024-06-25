<?php
session_start();
require_once 'koneksi.php';

class Register {
    private $conn;

    public function __construct(mysqli $db) {
        $this->conn = $db;
    }

	public function regist($username, $password, $keterangan) {
		mysqli_query($this->conn, "INSERT INTO user (`username`, `password`, `keterangan`) VALUES ('$username', '$password','$keterangan')");
		echo '<script language="javascript">alert("Registrasi Berhasil!"); document.location="login.php";</script>';
		return mysqli_affected_rows($this->conn);
	}	
}
	$koneksi = new Koneksi();
	$registrasi = new Register($koneksi->conn);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = $_POST["username"];
		$password = $_POST["password"];	
		$password2 = $_POST["password2"];

		if($_SESSION['user'] == 1){
			$keterangan = "mahasiswa";
		} elseif ($_SESSION['user'] == 2){
			$keterangan = "ortu";
		} elseif ($_SESSION['user'] == 3){
			$keterangan = "dosen";
		} elseif ($_SESSION['user'] == 4){
			$keterangan = "tendik";
		} elseif ($_SESSION['user'] == 5){
			$keterangan = "mitra";
		} elseif ($_SESSION['user'] == 6){
			$keterangan = "alumni";
		}

		if($password !== $password2){
			echo "<script>
			  alert('konfirmasi password salah');
				</script>";
		}
	
		$result = $registrasi->regist($username, $password, $keterangan);
	
		if ($result->num_rows > 0) {
			header("Location: login.php");
			echo '<script language="javascript">alert("Registrasi Berhasil!")';
		} else {
			$error_message = "Username atau password salah!";
		}
	}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Login page</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel="stylesheet" href="css/style.css">
<style>
	img{
		width: 100%;
	}
	body{
		background-color: #1C2256;
	}
</style>
</head>
<body>
<body>
	<div class="container-fluid">
		<div class="row main-content bg-success">
			<div class="col-md-8 col-xs-12 col-sm-12 login_form ">
				<div class="container-fluid">
					<div class="row">
						<h2><b>Register</b></h2>
					</div>
					<div class="row">
						<form control="" class="form-group" method="POST" action="#">
							<div class="row">
								<input type="text" name="username" id="username" class="form__input" placeholder="Username*" required>
							</div>
							<div class="row">
								<input type="password" name="password" id="password" class="form__input" placeholder="Password*" required>
							</div>
							<div class="row">
								<input type="password" name="password2" id="password2" class="form__input" placeholder="Confirm Password*" required>
							</div>
							<div class="row text-center">
								<input type="submit" value="Register" class="btn" name="register">
							</div>
						</form>
					</div>
					<div class="row text-center">
						<p><a href="login.php">Already have an account? Login</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-4 text-center company__info">
				<span class="company__logo"><h2><img src="image/login.png"></h2></span>
			</div>
		</div>
	</div>
</body>  
</body>
</html>
