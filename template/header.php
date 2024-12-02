<?php 
session_start();

if (empty($_SESSION['id_user']) or empty($_SESSION['username'])) {
  echo "<script>
    alert('Maaf, untuk mengakses halaman ini, silakan login terlebih dahulu.');
    document.location='login.php';
    </script>";
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- CSS Kustom -->
    <link rel="stylesheet" href="assets/css/style.css">

    <title>E-Arsip | Project</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="?">E-Arsip Surat</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="?">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?halaman=departemen">Data Departemen</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?halaman=pengirim_surat">Data Pengirim Surat</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?halaman=arsip_surat">Data Arsip Surat</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
