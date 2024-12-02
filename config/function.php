<?php

function upload()
{
    // Check if file was uploaded
    if (!isset($_FILES['file'])) {
        echo "<script> alert('No file was uploaded.'); </script>";
        return false;
    }

    $namafile = $_FILES['file']['name'];
    $ukuranfile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpname = $_FILES['file']['tmp_name'];

    // Define valid file extensions
    $eksfilevalid = ['jpg', 'jpeg', 'png', 'pdf','dock'];
    $eksfile = explode('.', $namafile);
    $eksfile = strtolower(end($eksfile));

    // Check if file extension is valid
    if (!in_array($eksfile, $eksfilevalid)) {
        echo "<script> alert('Yang Anda Upload Bukan Gambar / File PDF..!'); </script>";
        return false;
    }

    // Check if file size is within the limit (1MB in this case)
    if ($ukuranfile > 1000000) {
        echo "<script> alert('Ukuran File Anda Terlalu Besar..!'); </script>";
        return false;
    }

    // Generate a new unique filename
    $namafilebaru = uniqid() . '.' . $eksfile;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($tmpname, 'file/' . $namafilebaru)) {
        return $namafilebaru;
    } else {
        echo "<script> alert('Gagal Mengupload File.'); </script>";
        return false;
    }
}

?>
