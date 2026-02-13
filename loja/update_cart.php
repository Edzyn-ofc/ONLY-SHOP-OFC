<?php
session_start();

if (isset($_GET['id']) && isset($_GET['acao'])) {
    $id = $_GET['id'];
    $acao = $_GET['acao'];

    if (isset($_SESSION['carrinho'][$id])) {
        if ($acao == 'add') {
            $_SESSION['carrinho'][$id]++;
        } elseif ($acao == 'remove') {
            $_SESSION['carrinho'][$id]--;
            // Se a quantidade chegar a 0, remove o item
            if ($_SESSION['carrinho'][$id] <= 0) {
                unset($_SESSION['carrinho'][$id]);
            }
        }
    }
}

header('Location: Cart.php');
exit();
?>