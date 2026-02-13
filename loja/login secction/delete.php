<?php
require 'config.php';

if (isset($_POST['confirmar_exclusao'])) {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    session_destroy();
    header("Location: Login.php?msg=conta_encerrada");
}
?>