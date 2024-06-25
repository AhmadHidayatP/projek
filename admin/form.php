<?php
    session_start();
    if (!isset($_SESSION['admin'])){
        header("Location: login.php");
        echo '<script language="javascript">alert("Login terlebih dahulu!");</script>';
    }
    require_once '../koneksi.php';
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <title>Admin | Homepage</title>
    <style>
        .wrapper {
            display: flex;
            width: 50%;
        }
        #sidebar {
            align-items: stretch;
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
        }

        #sidebar.active {
            margin-left: -250px;
        }
        b {
            color: white;
        }
        a {
            font-size: 0.7em;
            font-weight: 100;
        }
        
    </style>
</head>
<body>
    <nav id="navi" class="navbar navbar-light" style="background: #1C2256">
        <div class="sidebar-header">
            <h3><img src="../image/logo_polinema.png" alt="Polinema Logo" style="width: 5%;padding-bottom: 7px; margin-right:10px;"><b>SISPOLNI</b>
                <span style="color:white;padding-left:50px;"><b>Dashboard/Form<b></span>
                <span class="username" style="font-size: 0.7em;font-weight:100;float: right;color: #0177FF;margin-top: 33px;margin-left: 13em;"><?php echo $_SESSION['username']; ?></span>
            </h3>    
        </div>
    </nav>
<div class="wrapper">
    <nav id="sidebar">
        <ul class="list-unstyled components">
            <li>
                <a href="index.php">Beranda</a>
            </li>
            <li class="active">
                <a href="#">Form</a>
            </li>
            <li>
                <a href="responden.php">Responden</a>
            </li>
            <li>
                <a href="kategori.php">Kategori</a>
            </li>
            <li>
                <a href="../logout.php">Logout</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <p>Registrasi Akun</p>
        <hr style="width:55em">
        <table class="table table-bordered" id="myTable" style="width:45em; font-weight: 600">
                <thead>
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">KETERANGAN</th>
                    <th scope="col">STATUS</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                global $conn;
                $conn = mysqli_connect("localhost","root","","skpp_db");
                $query = "SELECT * FROM user";
                $result = $conn->query($query);
                $counter = 0;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $counter++;
                        echo '<tr>
                                  <td scope="row">' . $counter. '</td>
                                  <td scope="row">' . $row["nama"]. '</td>
                                  <td scope="row">' . $row["keterangan"]. '</td>
                                  <td scope="row">' . $row["status"]. '</td>
                                  </tr>';
                    }
                } else {
                    echo "0 results";
                } 
                ?>
                       </tbody>
                    </div>
                </table>    
</div>
</body>
</html>