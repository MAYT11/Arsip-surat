<?php

if (isset($_POST['bsimpan'])) {
    $nama_departemen = mysqli_real_escape_string($koneksi, $_POST['nama_departemen']);
    
    if ($_GET['hal'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $ubah = mysqli_query($koneksi, "UPDATE tbl_departemen SET nama_departemen ='$nama_departemen' WHERE id_departemen = '$id'");
        if ($ubah) {
            echo "<script>
                alert('Ubah Data Sukses');
                document.location='?halaman=departemen';
                </script>";
        } else {
            echo "<script>
                alert('Gagal Ubah Data');
                </script>";
        }
    } else {
        $simpan = mysqli_query($koneksi, "INSERT INTO tbl_departemen (nama_departemen) VALUES ('$nama_departemen')");
        
        if ($simpan) {
            echo "<script>
                alert('Simpan Data Sukses');
                document.location='?halaman=departemen';
                </script>";
        } else {
            echo "<script>
                alert('Gagal Simpan Data');
                </script>";
        }
    }
}

if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_departemen WHERE id_departemen='$id'");
        $data = mysqli_fetch_array($tampil);
        
        if ($data) {
            $vnama_departemen = $data['nama_departemen'];
        }
    } else if ($_GET['hal'] == "hapus") {
        $id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $hapus = mysqli_query($koneksi, "DELETE FROM tbl_departemen WHERE id_departemen='$id'");
        
        if ($hapus) {
            echo "<script>
                alert('Hapus Data Sukses');
                document.location='?halaman=departemen';
                </script>";
        } else {
            echo "<script>
                alert('Gagal Hapus Data');
                </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Departemen</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css"> 
</head>
<body>
    <div class="container mt-4">
        <div class="card mb-3">
            <div class="card-header">
                Form Data Departemen
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="nama_departemen">Nama Departemen</label>
                        <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" value="<?= @$vnama_departemen ?>" required autofocus autocomplete="off">
                    </div>  
                    <button type="submit" name="bsimpan" class="btn btn-success">Simpan</button>
                    <button type="reset" name="bbatal" class="btn btn-danger">Batal</button>
                </form>
            </div>
        </div>
  <div class="card">
            <div class="card-header">
                Data Departemen
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Departemen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_departemen ORDER BY id_departemen DESC");
                        $no = 1;
                        while ($data = mysqli_fetch_array($tampil)):
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama_departemen'] ?></td>
                            <td>
                                <a href="?halaman=departemen&hal=edit&id=<?= $data['id_departemen'] ?>" class="btn btn-success">Edit</a>
                                <a href="?halaman=departemen&hal=hapus&id=<?= $data['id_departemen'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.4.1.slim.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
