<?php
session_start();

// Hapus semua variabel session
unset($_SESSION['id_user']);
unset($_SESSION['username']);

// Hapus session cookie jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hapus session
session_destroy();

// Arahkan pengguna ke halaman login
header('Location: login.php');
exit();
?>
