<?php
require 'config.php'; // Certifique-se que o config.php tem session_start()

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_digitado = $_POST['usuario'];
    $senha_digitada = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ? OR email = ?");
    $stmt->execute([$usuario_digitado, $usuario_digitado]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha_digitada, $user['senha'])) {
        // Guardar todos os dados necessários
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nome'] = $user['nome'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_foto'] = $user['foto'] ?? 'default.png';
        $_SESSION['first_login'] = $user['first_login'] ?? 1;

        header("Location: ../profile.php");
        exit();
    } else {
        header("Location: Login.php?erro=dados_invalidos");
        exit();
    }
}
?>