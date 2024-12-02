<?php 
    if (isset($_POST['bsimpan'])) {
        $nama_pengirim = mysqli_real_escape_string($koneksi, $_POST['nama_pengirim']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
        $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);

        if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
            $id = mysqli_real_escape_string($koneksi, $_GET['id']);
            $ubah = mysqli_query($koneksi, "UPDATE tbl_pengirim_surat SET 
                nama_pengirim = '$nama_pengirim',
                alamat = '$alamat',
                no_hp = '$no_hp',
                email = '$email' 
                WHERE id_pengirim_surat = '$id'");

            if ($ubah) {
                echo "<script>
                    alert('Ubah Data Sukses');
                    document.location='?halaman=pengirim_surat';
                    </script>";
            } else {
                echo "<script>
                    alert('Ubah Data Gagal!!');
                    document.location='?halaman=pengirim_surat';
                    </script>";
            }
        } else {
            $simpan = mysqli_query($koneksi, "INSERT INTO tbl_pengirim_surat (nama_pengirim, alamat, no_hp, email) VALUES (
                '$nama_pengirim',
                '$alamat',
                '$no_hp',
                '$email')");

            if ($simpan) {
                echo "<script>
                    alert('Simpan Data Sukses');
                    document.location='?halaman=pengirim_surat';
                    </script>";
            } else {
                echo "<script>
                    alert('Simpan Data Gagal!!');
                    document.location='?halaman=pengirim_surat';
                    </script>";
            }
        }
    }

    if (isset($_GET['hal'])) {
        if ($_GET['hal'] == "edit") {
            $id = mysqli_real_escape_string($koneksi, $_GET['id']);
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengirim_surat WHERE id_pengirim_surat='$id'");
            $data = mysqli_fetch_array($tampil);

            if ($data) {
                $vnama_pengirim = $data['nama_pengirim'];
                $valamat = $data['alamat'];
                $vno_hp = $data['no_hp'];
                $vemail = $data['email'];
            }
        } else if ($_GET['hal'] == "hapus") {
            $id = mysqli_real_escape_string($koneksi, $_GET['id']);
            $hapus = mysqli_query($koneksi, "DELETE FROM tbl_pengirim_surat WHERE id_pengirim_surat='$id'");

            if ($hapus) {
                echo "<script>
                    alert('Hapus Data Sukses');
                    document.location='?halaman=pengirim_surat';
                    </script>";
            } else {
                echo "<script>
                    alert('Hapus Data Gagal!!');
                    document.location='?halaman=pengirim_surat';
                    </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Pengirim Surat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            Form Data Pengirim Surat
        </div>
        <div class="card-body">
            <form method="post" action="">
                <div class="form-group">
                    <label for="nama_pengirim">Nama Pengirim</label>
                    <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" value="<?=@$vnama_pengirim?>"required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?=@$valamat?>"required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="no_hp">No.Hp</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?=@$vno_hp?>"required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?=@$vemail?>"required autofocus autocomplete="off">
                </div>
                <button type="submit" name="bsimpan" class="btn btn-success">Simpan</button>
                <button type="reset" name="bbatal" class="btn btn-danger">Batal</button>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            Data Pengirim Surat
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengirim Surat</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengirim_surat ORDER BY id_pengirim_surat DESC");
                        $no = 1;
                        while ($data = mysqli_fetch_array($tampil)):
                    ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$data['nama_pengirim']?></td>
                        <td><?=$data['alamat']?></td>
                       <td><?=$data['no_hp']?></td>
                        <td><?=$data['email']?></td>
                        <td>
                            <a href="?halaman=pengirim_surat&hal=edit&id=<?=$data['id_pengirim_surat']?>" class="btn btn-success">Edit</a>
                            <a href="?halaman=pengirim_surat&hal=hapus&id=<?=$data['id_pengirim_surat']?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
