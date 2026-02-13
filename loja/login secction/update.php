<?php
require 'config.php';

if (isset($_FILES['foto'])) {
    $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $novo_nome = md5(uniqid()) . "." . $extensao;
    $diretorio = "../login secction/";

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . $novo_nome)) {
        $stmt = $pdo->prepare("UPDATE usuarios SET foto = ? WHERE id = ?");
        $stmt->execute([$novo_nome, $_SESSION['user_id']]);
        header("Location: ../indexF.php?atualizado=sucesso");
    }
}
?>