<?php
    include('koneksi.php');

    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $program_studi = $_POST['program_studi'];
    $email = $_POST['email'];
    $nomor_hp = $_POST['nomor_hp'];
    $tahun_masuk = $_POST['tahun_masuk'];
    
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <label for="nim" class="form-label">NIM</label><br>
            <input type="text" class="form-control" id="nim" value="<?php echo $nim; ?>" readonly><br><br>
        </div>
        <div class="col-md-6">
            <label for="nama" class="form-label">Nama</label><br>
            <input type="text" class="form-control" id="nama" value="<?php echo $nama; ?>" readonly><br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="program_studi" class="form-label">Program Studi</label><br>
            <input type="text" class="form-control" id="program_studi" value="<?php echo $program_studi; ?>" readonly><br><br>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label><br>
            <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" readonly><br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="nomor_hp" class="form-label">Nomor HP</label><br>
            <input type="text" class="form-control" id="nomor_hp" value="<?php echo $nomor_hp; ?>" readonly><br><br>
        </div>
        <div class="col-md-6">
            <label for="tahun_masuk" class="form-label">Tahun Masuk</label><br>
            <input type="text" class="form-control" id="tahun_masuk" value="<?php echo $tahun_masuk; ?>" readonly><br><br>
        </div>
    </div>
</div>
