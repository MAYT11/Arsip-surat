
<?php 
$host = 'localhost'; // Biasanya ini adalah 'localhost'
$username = 'root';  // Ganti dengan username database Anda
$password = '';      // Ganti dengan password database Anda (kosong jika tidak ada)
$database = 'db_arsip'; // Ganti dengan nama database Anda

$koneksi = mysqli_connect($host, $username, $password, $database);
if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
?>
