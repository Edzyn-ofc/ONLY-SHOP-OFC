<?php
session_start();


if (isset($_GET['id'])) {
    $id_para_remover = $_GET['id'];

    // Verifica se o carrinho existe na sessão
    if (isset($_SESSION['carrinho'])) {
        
        // Procura a posição do ID no array do carrinho
        // array_search retorna a chave
        $index = array_search($id_para_remover, $_SESSION['carrinho']);
        if ($index !== false) {
            unset($_SESSION['carrinho'][$index]);
            $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
        }
    }
}
header('Location: Cart.php');
exit();
?>