<?php
session_start();

// Verificar se usuário está logado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'redirect' => 'login secction/Login.php', 'message' => 'Você precisa estar logado para adicionar produtos ao carrinho']);
    exit();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Se o produto já estiver no carrinho, aumenta a quantidade
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]++;
    } else {
        // Se for a primeira vez, define como 1
        $_SESSION['carrinho'][$id] = 1;
    }

    echo json_encode(['success' => true, 'message' => 'Produto adicionado ao carrinho']);
    exit();
}

echo json_encode(['success' => false, 'message' => 'ID de produto não fornecido']);
?>