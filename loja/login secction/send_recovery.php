<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    if (empty($email)) {
        header("Location: forgot_password.php?type=error&message=Email inválido");
        exit();
    }

    // Verificar se email existe
    $stmt = $pdo->prepare("SELECT id, nome FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        // Por segurança, não revelamos se o email existe ou não
        header("Location: forgot_password.php?type=success&message=Se o email existe, um link de recuperação foi enviado");
        exit();
    }

    // Gerar token seguro
    $token = bin2hex(random_bytes(32));
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Salvar token no banco
    $stmt = $pdo->prepare("UPDATE usuarios SET reset_token = ?, reset_token_expiry = ? WHERE id = ?");
    $stmt->execute([$token, $expiry, $user['id']]);

    // Link de recuperação
    $recovery_link = "http://localhost/loja/login%20secction/reset_password.php?token=$token&email=$email";

    // Simular envio de email (em produção usar uma classe de email real)
    $to = $email;
    $subject = "Recuperação de Senha - ONLY SHOP";
    $message = "Olá " . htmlspecialchars($user['nome']) . ",\n\n";
    $message .= "Você solicitou para redefinir sua senha. Clique no link abaixo:\n\n";
    $message .= $recovery_link . "\n\n";
    $message .= "Este link expira em 1 hora.\n\n";
    $message .= "Se você não solicitou isso, ignore este email.\n\n";
    $message .= "Atenciosamente,\nONLY SHOP";

    $headers = "From: noreply@onlyshop.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Descomentar para usar email real (requer configuração do servidor)
    // mail($to, $subject, $message, $headers);

    // Para fins de desenvolvimento, exibir o link
    echo "<!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Email Enviado</title>
        <style>
            body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
            .container { max-width: 500px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            h1 { color: #667eea; }
            p { color: #666; line-height: 1.6; }
            .link-container { background: #f0f0f0; padding: 15px; border-radius: 5px; margin: 20px 0; word-break: break-all; }
            a { color: #667eea; text-decoration: none; }
            a:hover { text-decoration: underline; }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>✓ Email Enviado com Sucesso!</h1>
            <p>Um link de recuperação foi enviado para: <strong>$email</strong></p>
            <p>O link expira em 1 hora.</p>
            <h3>Link de Recuperação (para desenvolvimento):</h3>
            <div class='link-container'>
                <a href='$recovery_link'>$recovery_link</a>
            </div>
            <p><a href='Login.php'>← Voltar ao Login</a></p>
        </div>
    </body>
    </html>";
    exit();
}
?>
