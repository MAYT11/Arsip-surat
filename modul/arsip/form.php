<?php 
include "config/function.php";

// Menangani aksi simpan data
if (isset($_POST['bsimpan'])) {
    // Menggunakan mysqli_real_escape_string untuk menghindari SQL injection
    $no_surat = mysqli_real_escape_string($koneksi, $_POST['no_surat']);
    $tanggal_surat = mysqli_real_escape_string($koneksi, $_POST['tanggal_surat']);
    $tanggal_diterima = mysqli_real_escape_string($koneksi, $_POST['tanggal_diterima']);
    $prihal = mysqli_real_escape_string($koneksi, $_POST['prihal']);
    $id_departemen = mysqli_real_escape_string($koneksi, $_POST['id_departemen']);
    $id_pengirim_surat = mysqli_real_escape_string($koneksi, $_POST['id_pengirim_surat']);

    if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $ubah = mysqli_query($koneksi, "UPDATE tbl_arsip SET 
            no_surat = '$no_surat',
            tanggal_surat = '$tanggal_surat',
            tanggal_diterima = '$tanggal_diterima',
            prihal = '$prihal',
            id_departemen = '$id_departemen',
            id_pengirim_surat = '$id_pengirim_surat'
            WHERE id_arsip = '$id'");

        if ($ubah) {
            echo "<script>
                alert('Ubah Data Sukses');
                document.location='?halaman=arsip_surat';
                </script>";
        } else {
            echo "<script>
                alert('Ubah Data Gagal!!');
                document.location='?halaman=arsip_surat';
                </script>";
        }
    } else {
        // Menangani file upload
        $file = '';
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $file = basename($_FILES['file']['name']);
            $target_dir = "file/";
            $target_file = $target_dir . $file;
            move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
        }

        $simpan = mysqli_query($koneksi, "INSERT INTO tbl_arsip (no_surat, tanggal_surat, tanggal_diterima, prihal, id_departemen, id_pengirim_surat, file) VALUES (
            '$no_surat',
            '$tanggal_surat',
            '$tanggal_diterima',
            '$prihal',
            '$id_departemen',
            '$id_pengirim_surat',
            '$file')");

        if ($simpan) {
            echo "<script>
                alert('Simpan Data Sukses');
                document.location='?halaman=arsip_surat';
                </script>";
        } else {
            echo "<script>
                alert('Simpan Data Gagal!!');
                document.location='?halaman=arsip_surat';
                </script>";
        }
    }
}

// Menangani aksi edit dan hapus data
if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_arsip WHERE id_arsip='$id'");
        $data = mysqli_fetch_array($tampil);

        if ($data) {
            $vno_surat = $data['no_surat'];
            $vtanggal_surat = $data['tanggal_surat'];
            $vtanggal_diterima = $data['tanggal_diterima'];
            $vprihal = $data['prihal'];
            $vid_departemen = $data['id_departemen'];
            $vid_pengirim_surat = $data['id_pengirim_surat'];
            $vfile = $data['file'];
        }
    } elseif ($_GET['hal'] == "hapus") {
        $id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $hapus = mysqli_query($koneksi, "DELETE FROM tbl_arsip WHERE id_arsip='$id'");

        if ($hapus) {
            echo "<script>
                alert('Hapus Data Sukses');
                document.location='?halaman=arsip_surat';
                </script>";
        } else {
            echo "<script>
                alert('Hapus Data Gagal!!');
                document.location='?halaman=arsip_surat';
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
    <title>Form Data Arsip Surat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>
<body>

<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            Form Data Arsip Surat
        </div>
        <div class="card-body">
            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="no_surat">No Surat</label>
                    <input type="text" class="form-control" id="no_surat" name="no_surat" value="<?=@$vno_surat?>"required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="tanggal_surat">Tanggal Surat</label>
                    <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="<?=@$vtanggal_surat?>">
                </div>
                <div class="form-group">
                    <label for="tanggal_diterima">Tanggal Diterima</label>
                    <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="<?=@$vtanggal_diterima?>">
                </div>
                <div class="form-group">
                    <label for="prihal">Prihal</label>
                    <input type="text" class="form-control" id="prihal" name="prihal" value="<?=@$vprihal?>"required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="id_departemen">Departemen / Tujuan</label>
                    <select class="form-control" name="id_departemen" id="id_departemen">
                        <option value=""></option>
                        <?php
                        $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_departemen ORDER BY nama_departemen ASC");
                        while ($data = mysqli_fetch_array($tampil)) {
                            $selected = ($data['id_departemen'] == @$vid_departemen) ? 'selected' : '';
                            echo "<option value='{$data['id_departemen']}' $selected>{$data['nama_departemen']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_pengirim_surat">Pengirim Surat</label>
                    <select class="form-control" name="id_pengirim_surat" id="id_pengirim_surat">
                        <option value=""></option>
                        <?php
                        $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengirim_surat ORDER BY nama_pengirim ASC");
                        while ($data = mysqli_fetch_array($tampil)) {
                            $selected = ($data['id_pengirim_surat'] == @$vid_pengirim_surat) ? 'selected' : '';
                            echo "<option value='{$data['id_pengirim_surat']}' $selected>{$data['nama_pengirim']}</option>";
                        }
                        ?>
                    </select>
                </div>
              <div class="form-group">
        <label for="file">Pilih File</label>
        <input type="file" class="form-control" id="file" name="file">
    </div>
                <button type="submit" name="bsimpan" class="btn btn-success">Simpan</button>
                <button type="reset" name="bbatal" class="btn btn-danger">Batal</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
