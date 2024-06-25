<?php
// session_start();
if (!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    echo '<script>alert("Login terlebih dahulu!");</script>';
}
include '../koneksi.php';
class CRUD {
    private $conn;

    public function __construct()
    {
        $this->conn = (new Koneksi())->conn;
    }
    public function editKategori($id){
        if(isset($_POST['update']))
            {   
                $id = $_GET['id'];
                $kategori_nama=$_POST['kategori_nama'];
                $result = mysqli_query($this->conn, "UPDATE kategori_soal SET kategori_nama='$kategori_nama' WHERE kategori_id=$id");

                echo '<script>alert("Update Data Berhasil")</script>';
                echo '<script>window.location="kategori.php"</script>';
            }
                $id = $_GET['id'];
                $result = mysqli_query($this->conn, "SELECT * FROM kategori_soal WHERE kategori_id=$id");
                while($user_data = mysqli_fetch_array($result))
            {
                $kategori_nama = $user_data['kategori_nama'];
            }
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/Bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="container" style="margin-bottom: 2em">
        <h2>Edit Kategori</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="kategori_nama">Nama Kategori:</label>
                <input type="text" class="form-control" id="kategori_nama" name="kategori_nama"
                    value="<?php echo $kategori_nama; ?>">
            </div>

            <button type="submit" class="btn btn-primary" name="update">Update</button>
        </form>
    </div>
</body>
</html>
<?php

    }
    public function deleteKategori($id){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $conn = mysqli_connect("localhost", "root", "", "skpp_db");
            $query = "DELETE FROM kategori_soal WHERE kategori_id = '$id'";
            $result = mysqli_query($conn, $query);
    
            if ($result) {
                echo "<script>alert('Berhasil menghapus data!')</script>";
                header("location: responden.php");
                exit();
            } else {
                echo "<script>alert('Error menghapus data!')</script>";
            }
            mysqli_close($conn);
        } else {
            echo "Invalid request!";
        }
    }
    public function deleteResponden($id)
    {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $conn = mysqli_connect("localhost", "root", "", "skpp_db");
            $query = "DELETE FROM user WHERE user_id = '$id'";
            $result = mysqli_query($conn, $query);
    
            if ($result) {
                echo "<script>alert('Berhasil menghapus data!')</script>";
                header("location: responden.php");
                exit();
            } else {
                echo "<script>alert('Error menghapus data!')</script>";
            }
            mysqli_close($conn);
        } else {
            echo "Invalid request!";
        }
    }
}