<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Anggota</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>
<body>
<script>
        $(document).ready(function() {
            $('#tanggal_pengisian_biodata').datepicker({
                format: 'yyyy-mm-dd'
            });
        });
    </script>

    <!-- Menambah data anggota dengan desain responsif menggunakan Bootstrap -->
    <div class="container mt-4">
        <h2>Menambahkan Data Orang Tua</h2>

        <form action="tampil_ortu.php" method="post">
        <div class="form-group">
            <label for="tanggal_pengisian_biodata">Tanggal Pengisian Biodata:</label>
            <input type="text" class="form-control" name="tanggal_pengisian_biodata" id="tanggal_pengisian_biodata" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <div class="form-check">
                <input type="radio" name="jenis_kelamin" value="L" id="laki" required>
                <label for="laki">Laki-laki</label>
            </div>
            <div class="form-check">
                <input type="radio" name="jenis_kelamin" value="P" id="perempuan" required>
                <label for="perempuan">Perempuan</label>
            </div>
        </div>
        <div class="form-group">
            <label for="umur">Umur:</label>
            <input type="number" class="form-control" name="umur" id="umur" required>
        </div>
        <div class="form-group">
            <label for="nomor_hp">Nomor HP:</label>
            <input type="number" class="form-control" name="nomor_hp" id="nomor_hp" required>
        </div>
        <div class="form-group">
            <label for="pendidikan">Pendidikan:</label>
            <input type="text" class="form-control" name="pendidikan" id="pendidikan" required>
        </div>
        <div class="form-group">
            <label for="pekerjaan">Pekerjaan:</label>
            <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" required>
        </div>
        <div class="form-group">
            <label for="penghasilan">Penghasilan per Bulan:</label>
            <input type="text" class="form-control" name="penghasilan" id="penghasilan" required>
        </div>
        <div class="form-group">
            <label for="nama_mahasiswa">Nama Mahasiswa:</label>
            <input type="text" class="form-control" name="nama_mahasiswa" id="nama_mahasiswa" required>
        </div>
        <div class="form-group">
            <label for="nim_mahasiswa">NIM Mahasiswa:</label>
            <input type="number" class="form-control" name="nim_mahasiswa" id="nim_mahasiswa" required>
        </div>
        <div class="form-group">
            <label for="program_studi_mahasiswa">Program Studi Mahasiswa:</label>
            <input type="text" class="form-control" name="program_studi_mahasiswa" id="program_studi_mahasiswa" required>
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
