<?php
/*
 * Script para aplicar alterações no banco de dados
 * Execute acessando: http://localhost/loja/apply_db_changes.php
 */

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'only_shop';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("❌ Erro de conexão: " . $conn->connect_error);
}

// Verificar se as colunas já existem
$result = $conn->query("SHOW COLUMNS FROM usuarios");
$columns = [];
while ($row = $result->fetch_assoc()) {
    $columns[] = $row['Field'];
}

$missing_columns = [];
if (!in_array('first_login', $columns)) {
    $missing_columns[] = 'first_login';
}
if (!in_array('reset_token', $columns)) {
    $missing_columns[] = 'reset_token';
}
if (!in_array('reset_token_expiry', $columns)) {
    $missing_columns[] = 'reset_token_expiry';
}

if (empty($missing_columns)) {
    $message = "✓ Banco de dados já está atualizado! Todas as colunas existem.";
    $status = "success";
} else {
    // Executar ALTER TABLE
    $sql = "
    ALTER TABLE usuarios 
    ADD COLUMN first_login BOOLEAN DEFAULT 1 AFTER foto,
    ADD COLUMN reset_token VARCHAR(255) NULL AFTER first_login,
    ADD COLUMN reset_token_expiry DATETIME NULL AFTER reset_token;
    ";

    if ($conn->query($sql) === TRUE) {
        $message = "✓ Banco de dados atualizado com sucesso!<br>Colunas adicionadas: " . implode(", ", $missing_columns);
        $status = "success";
    } else {
        $message = "❌ Erro ao atualizar: " . $conn->error;
        $status = "error";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicar Alterações BD - ONLY SHOP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .message {
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            font-size: 16px;
            font-weight: bold;
        }

        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .details {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            text-align: left;
            margin: 20px 0;
            font-size: 14px;
        }

        .details h3 {
            margin-top: 0;
            color: #333;
        }

        .details ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        .details li {
            margin: 5px 0;
        }

        .button {
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s;
            margin-top: 20px;
        }

        .button:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗄️ Aplicar Alterações no Banco</h1>

        <div class="message <?php echo $status; ?>">
            <?php echo $message; ?>
        </div>

        <div class="details">
            <h3>📋 Colunas Verificadas:</h3>
            <ul>
                <li>
                    <strong>first_login</strong>
                    <?php echo in_array('first_login', $columns) ? '✓ Existe' : '✗ Não encontrada'; ?>
                </li>
                <li>
                    <strong>reset_token</strong>
                    <?php echo in_array('reset_token', $columns) ? '✓ Existe' : '✗ Não encontrada'; ?>
                </li>
                <li>
                    <strong>reset_token_expiry</strong>
                    <?php echo in_array('reset_token_expiry', $columns) ? '✓ Existe' : '✗ Não encontrada'; ?>
                </li>
            </ul>
        </div>

        <div class="details">
            <h3>📊 Todas as Colunas da Tabela:</h3>
            <ul>
                <?php foreach ($columns as $col): ?>
                    <li><?php echo htmlspecialchars($col); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <a href="TESTE_IMPLEMENTACAO.php" class="button">← Voltar ao Teste</a>
        <a href="indexF.php" class="button">🏠 Ir para Home</a>
    </div>
</body>
</html>
