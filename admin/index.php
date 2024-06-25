<?php
    session_start();
    if (!isset($_SESSION['admin'])){
        header("Location: ../login.php");
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
                <span style="color:white;padding-left:50px;"><b>Dashboard<b></span>
                <span class="username" style="font-size: 0.7em;font-weight:100;float: right;color: #0177FF;margin-top: 25px;margin-left: 13em;"><?php echo $_SESSION['username']; ?></span>
            </h3>    
        </div>
    </nav>
<div class="wrapper">
    <nav id="sidebar">
        <ul class="list-unstyled components">
            <li class="active">
                <a href="#">Beranda</a>
            </li>
            <li>
                <a href="form.php">Form</a>
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
        <p>Survey Kepuasan Pelanggan<br>
        Politeknik Negeri Malang</p>
        <hr style="width:55em">
        <p> Menampilkan semua hasil survey </p>
        <table class="table table-bordered" id="myTable" style="width:45em; font-weight: 600">
                <thead>
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">NAMA SOAL</th>
                    <th scope="col">JAWABAN 1</th>
                    <th scope="col">JAWABAN 2</th>
                    <th scope="col">JAWABAN 3</th>
                    <th scope="col">JAWABAN 4</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                global $conn;
                $conn = mysqli_connect("localhost","root","","skpp_db");
                $query = "SELECT * FROM hasil_jawaban_mahasiswa h 
                        RIGHT JOIN soal s ON h.soal_id = s.nomor_urut_soal 
                        ORDER BY s.nomor_urut_soal";
                $result = $conn->query($query);
                $counter = 0;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $counter++;
                        echo '<tr>
                                  <td scope="row">' . $counter. '</td>
                                  <td scope="row">' . $row["soal_nama"]. '</td>
                                  <td scope="row">' . $row["jawaban1"]. '</td>
                                  <td scope="row">' . $row["jawaban2"]. '</td>
                                  <td scope="row">' . $row["jawaban3"]. '</td>
                                  <td scope="row">' . $row["jawaban4"]. '</td>
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