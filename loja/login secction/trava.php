<?php
// login secction/trava.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se não houver ID na sessão, barra o acesso
if (!isset($_SESSION['user_id'])) {
    header("Location: login secction/Login.php");
    exit();
}
?>