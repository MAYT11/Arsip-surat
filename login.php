<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Arsip - Login</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/stylelogin.css" rel="stylesheet">
</head>
<body>
    <form class="form-signin" action="cek_login.php" method="post">
      <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Login E-Arsip</h1>
        <p>Silakan masukkan Username dan Password Anda untuk masuk ke sistem E-Arsip.</p>
      </div>

      <?php
      session_start();
      if (isset($_SESSION['login_error'])) {
          echo '<div class="alert alert-danger" role="alert">' . $_SESSION['login_error'] . '</div>';
          unset($_SESSION['login_error']);
      }
      ?>

      <div class="form-label-group">
        <input type="text" id="username" name="username" placeholder=" " required autofocus autocomplete="off" aria-label="Username">
        <label for="username">Username</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="password" name="password" placeholder=" "  aria-label="Password">
        <label for="password">Password</label>
      </div>

      <!-- Checkbox Tampilkan Password -->
      <div class="form-check mb-3">
        <input type="checkbox" id="showPassword" class="form-check-input">
        <label class="form-check-label" for="showPassword">Tampilkan Password</label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2024 - <?= date('Y') ?> Proyek</p>
    </form>

    <script>
      document.getElementById('showPassword').addEventListener('change', function() {
        var passwordField = document.getElementById('password');
        if (this.checked) {
          passwordField.type = 'text';
        } else {
          passwordField.type = 'password';
        }
      });
    </script>
</body>
</html>