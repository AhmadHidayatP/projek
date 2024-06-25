<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Anggota</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>
<body>
    <!-- Menambah data anggota dengan desain responsif menggunakan Bootstrap -->
    <div class="container mt-4">
        <h2>Menambahkan Data Dosen</h2>

        <form action="tampil_dosen.php" method="post">
        <div class="form-group">
            <label for="tanggal_pengisian_biodata">Tanggal Pengisian Biodata:</label>
            <input type="text" class="form-control" name="tanggal_pengisian_biodata" id="tanggal_pengisian_biodata" required>
        </div>
        <div class="form-group">
            <label for="nip">NIP:</label>
            <input type="number" class="form-control" name="nip" id="nip" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
        </div>
        <div class="form-group">
            <label for="unit">Unit:</label>
            <input type="text" class="form-control" name="unit" id="unit" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tanggal_pengisian_biodata').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>

</body>
</html>
