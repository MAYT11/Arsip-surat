<?php
session_start();
include "config/koneksi.php";

// Ambil data dari form login
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = md5($_POST['password']); // Pertimbangkan menggunakan metode hashing yang lebih aman

// Mengambil data pengguna dari database
$query = $koneksi->prepare("SELECT * FROM tbl_user WHERE username = ? AND password = ?");
$query->bind_param("ss", $username, $password);
$query->execute();
$result = $query->get_result();
$data = $result->fetch_assoc();

if ($data) {
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    header('Location: admin.php');
    exit();
} else {
    $_SESSION['login_error'] = 'Maaf, Login Gagal. Pastikan username dan password Anda benar.';
    header('Location: login.php');
    exit();
}

$query->close();
$koneksi->close();
?>

