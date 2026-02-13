<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Validações
    if (empty($token) || empty($email) || empty($password)) {
        header("Location: Login.php?erro=dados_invalidos");
        exit();
    }

    if ($password !== $password_confirm) {
        header("Location: reset_password.php?token=$token&email=$email&erro=senhas_nao_coincidem");
        exit();
    }

    if (strlen($password) < 8) {
        header("Location: reset_password.php?token=$token&email=$email&erro=senha_muito_curta");
        exit();
    }

    // Verificar token
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ? AND reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->execute([$email, $token]);
    $user = $stmt->fetch();

    if (!$user) {
        header("Location: Login.php?erro=link_expirado");
        exit();
    }

    // Atualizar senha
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE usuarios SET senha = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
    if ($stmt->execute([$hashed_password, $user['id']])) {
        header("Location: Login.php?sucesso=senha_redefinida");
        exit();
    } else {
        header("Location: Login.php?erro=erro_desconhecido");
        exit();
    }
}
?>
