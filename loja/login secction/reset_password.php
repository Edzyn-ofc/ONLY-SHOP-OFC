<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - ONLY SHOP</title>
    <link rel="stylesheet" href="Lg.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reset-container {
            background: white;
            border-radius: 15px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .reset-container h1 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .reset-container p {
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

        .password-strength {
            font-size: 12px;
            margin-top: 5px;
            padding: 8px;
            border-radius: 3px;
            background: #f0f0f0;
            display: none;
        }

        .password-strength.weak {
            background: #ffebee;
            color: #c62828;
            display: block;
        }

        .password-strength.medium {
            background: #fff3e0;
            color: #e65100;
            display: block;
        }

        .password-strength.strong {
            background: #e8f5e9;
            color: #2e7d32;
            display: block;
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

        .show-password {
            cursor: pointer;
            user-select: none;
        }

        @media (max-width: 480px) {
            .reset-container {
                padding: 20px;
            }

            .reset-container h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h1>🔑 Redefinir Senha</h1>
        <p>Digite sua nova senha</p>

        <?php
        require 'config.php';

        $token = $_GET['token'] ?? '';
        $email = $_GET['email'] ?? '';
        $error = '';
        $valid = false;

        if (empty($token) || empty($email)) {
            $error = 'Link inválido ou expirado';
        } else {
            // Verificar token
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ? AND reset_token = ? AND reset_token_expiry > NOW()");
            $stmt->execute([$email, $token]);
            $user = $stmt->fetch();

            if (!$user) {
                $error = 'Link inválido ou expirado';
            } else {
                $valid = true;
            }
        }

        if ($error) {
            echo "<div class='message error'>❌ $error</div>";
            echo "<div class='back-link'><a href='Login.php'>← Voltar ao Login</a></div>";
        } elseif ($valid) {
            echo "
            <form method='POST' action='process_reset.php' id='resetForm'>
                <input type='hidden' name='token' value='".htmlspecialchars($token)."'>
                <input type='hidden' name='email' value='".htmlspecialchars($email)."'>

                <div class='form-group'>
                    <label for='password'>Nova Senha</label>
                    <input type='password' id='password' name='password' required placeholder='Mínimo 8 caracteres'>
                    <div class='password-strength' id='strength'></div>
                </div>

                <div class='form-group'>
                    <label for='password_confirm'>Confirmar Senha</label>
                    <input type='password' id='password_confirm' name='password_confirm' required placeholder='Confirme a senha'>
                </div>

                <button type='submit' class='button'>Redefinir Senha</button>
            </form>

            <div class='back-link'>
                <a href='Login.php'>← Voltar ao Login</a>
            </div>

            <script>
                const passwordInput = document.getElementById('password');
                const strengthDiv = document.getElementById('strength');

                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    let strength = '';

                    if (password.length < 8) {
                        strength = 'weak';
                        strengthDiv.textContent = '⚠️ Senha muito curta (mín. 8 caracteres)';
                    } else if (!/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
                        strength = 'medium';
                        strengthDiv.textContent = '📊 Média - Adicione maiúsculas e números';
                    } else {
                        strength = 'strong';
                        strengthDiv.textContent = '✓ Forte - Ótimo!';
                    }

                    strengthDiv.className = 'password-strength ' + strength;
                });

                document.getElementById('resetForm').addEventListener('submit', function(e) {
                    const password = document.getElementById('password').value;
                    const confirm = document.getElementById('password_confirm').value;

                    if (password !== confirm) {
                        e.preventDefault();
                        alert('As senhas não coincidem!');
                        return false;
                    }

                    if (password.length < 8) {
                        e.preventDefault();
                        alert('A senha deve ter pelo menos 8 caracteres!');
                        return false;
                    }
                });
            </script>";
        }
        ?>
    </div>
</body>
</html>
