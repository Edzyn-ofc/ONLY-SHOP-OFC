<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Protege a senha na DB
    $usuario = explode('@', $email)[0]; // Gera um nome de usuário automático

    try {
        $sql = "INSERT INTO usuarios (nome, email, usuario, senha, first_login) VALUES (?, ?, ?, ?, 1)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $usuario, $senha]);
        
        header("Location: Login.php?sucesso=cadastrado");
        exit();
    } catch (PDOException $e) {
        header("Location: Login.php?erro=email_ja_existe");
        exit();
    }
}
?>