<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - ONLY SHOP</title>
    <link rel="stylesheet" href="../login secction/Lg.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .recovery-container {
            background: white;
            border-radius: 15px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .recovery-container h1 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .recovery-container p {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        .button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .button:hover {
            transform: translateY(-2px);
        }

        .button:active {
            transform: translateY(0);
        }

        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }

        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .message.info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }

        .back-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .recovery-container {
                padding: 20px;
            }

            .recovery-container h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="recovery-container">
        <h1>🔐 Recuperar Senha</h1>
        <p>Digite seu email para receber um link de recuperação</p>

        <?php
        if (isset($_GET['message'])) {
            $type = $_GET['type'] ?? 'info';
            $message = htmlspecialchars($_GET['message']);
            echo "<div class='message $type'>$message</div>";
        }
        ?>

        <form method="POST" action="send_recovery.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="seu@email.com">
            </div>

            <button type="submit" class="button">Enviar Link de Recuperação</button>
        </form>

        <div class="back-link">
            <a href="Login.php">← Voltar ao Login</a>
        </div>
    </div>
</body>
</html>
