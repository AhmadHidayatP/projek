<?php
    session_start();
    require_once 'crud.php';
    $crud = new Crud();

    if (!isset($_SESSION['admin'])){
        header("Location: ../login.php");
        echo '<script language="javascript">alert("Login terlebih dahulu!");</script>';
    }
    if (isset($_GET['action']) && $_GET['action'] === 'delete'){
        $id = $_GET['id'];
        $crud->deleteResponden($id);
    }
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
            <li>
                <a href="form.php">Form</a>
            </li>
            <li class="active">
                <a href="#">Responden</a>
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
        <p>Daftar Responden</p>
        <hr style="width:55em">
            <table class="table table-bordered" id="myTable" style="width:45em; font-weight: 600">
                <thead>
                  <tr>
                    <th scope="col">RESPONDEN</th>
                    <th scope="col">KETERANGAN</th>
                    <th scope="col">DELETE</th>
                  </tr>
                  </thead>
                <tbody>
                <?php
                    $conn = mysqli_connect("localhost", "root", "", "skpp_db");
                    $query = "SELECT * FROM user";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>
                                    <td scope="row">' . $row["username"] . '</td>
                                    <td scope="row">' . $row["keterangan"] . '</td>                                  
                                    <td><a href="responden.php?action=delete&id=' . $row['user_id'] . '"><button type="button" class="btn btn-secondary">Delete</button></a></td>
                                </tr>';
                        }
                    } else {
                        echo "0 results";
                    }
                    mysqli_close($conn);
                ?>
                       </tbody>
                    </div>
                </table>    
            </div>
        </div>
</div>
</body>
</html>