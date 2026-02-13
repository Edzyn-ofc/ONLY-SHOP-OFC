<?php
require 'config.php';

$sql = "
ALTER TABLE usuarios 
ADD COLUMN first_login BOOLEAN DEFAULT 1 AFTER foto,
ADD COLUMN reset_token VARCHAR(255) NULL AFTER first_login,
ADD COLUMN reset_token_expiry DATETIME NULL AFTER reset_token;
";

try {
    $conn = new mysqli("localhost", "root", "", "only_shop");
    if ($conn->connect_error) {
        die("Erro: " . $conn->connect_error);
    }
    
    if ($conn->query($sql) === TRUE) {
        echo "Tabela atualizada com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
    
    $conn->close();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
