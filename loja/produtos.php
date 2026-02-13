<?php 
require_once "login secction/trava.php"; // Trava a página toda
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Esse e meu primeiro site">
    <meta name="keywords" content="Edzyn,programador,mocambique, only, ONLY, only SHOP, only shop">
    <meta name="author" content="Edzyn"> 
    <style>
        .category-filter {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
    padding: 0 5%;
}

.filter-btn {
    background: rgba(38, 50, 75, 0.6);
    color: white;
    border: 1px solid #21299e;
    padding: 10px 20px;
    border-radius: 25px;
    cursor: pointer;
    transition: 0.3s;
    font-weight: bold;
    text-transform: capitalize;
}

.filter-btn:hover, .filter-btn.active {
    background: #ff6600;
    border-color: #ff6600;
    box-shadow: 0 0 15px rgba(255, 102, 0, 0.5);
}
    </style>
    <link rel="stylesheet" href="index.css">
    <title>PRODUTOS ONLY SHOP</title>

  
</head>
<body>

    <header class="topo">
        <nav>
    <h1>ONLY
     <span class="destaque">SHOP</span>
   </h1> 
   <!-- Barra de pesquisa -->
    <div class="top-bar">
    <input type="text" id="searchInput" placeholder="Pesquisar produto..." />
  </div>
   <ul id="menu">
    <ul>
				<il><a href="Cart.php"><img src="img/shopping-cart (1).png" alt="20px"></a>
				<il> <a href="produtos.php"><img src="img/bolsa-de-compras.png" width="30"></a>
                <il> <a href="indexF.php"><img src="img/casa.png"> </a>
                    
         		<button id="menu-btn" aria-expanded="false" aria-controls="dropdown-menu">☰</button>
    </nav>

    <div id="dropdown-menu" class="dropdown hidden" aria-hidden="true">
      <ul>
        <li><a href="indexF.php"><img src="img/casa.png" width="18" alt=""> &nbsp; Casa</a></li>
        <li><a href="produtos.php"><img src="img/bolsa-de-compras.png" width="18" alt=""> &nbsp; Produtos</a></li>
        <li><a href="Cart.php"><img src="img/shopping-cart (1).png" width="20" alt="20px">&nbsp; carrinho </a></li>
        <li><a href="Payments.php"><img src="img/cashback (1).png" width="22" alt=""> &nbsp; Pagamentos</a></li>
        <li><a href="contactoINDEX.php"><img src="img/info.png" width="20" alt=""> &nbsp; Contacto</a></li>
      </ul>
    </div>
    </header>
    <section class="products-section">

     
 

<div class="category-filter" style="text-align: center; margin: 100px 0 20px;">
    <button class="filter-btn active" onclick="filterCategory('todos')">Todas</button>
    <button class="filter-btn" onclick="filterCategory('vestuario')">Vestuário</button>
    <button class="filter-btn" onclick="filterCategory('Gamer')">Gamer</button>
    <button class="filter-btn" onclick="filterCategory('celulares')">Celulares</button>
    <button class="filter-btn" onclick="filterCategory('carros')">Carros</button>
    <button class="filter-btn" onclick="filterCategory('acessorios')">Acessórios</button>
</div>

    
<?php include 'config.php'; ?>
<main class="products-grid">
    <?php
    $sql = "SELECT * FROM produtos";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        echo '
        <div class="product" data-category="'.$row['categoria'].'">
            <img src="'.$row['imagem'].'" alt="'.$row['nome'].'">
            <div class="card-body">
                <h3>'.$row['nome'].'</h3>
                <div class="price">R$ '.number_format($row['preco'], 2, ',', '.').'</div>
                <p class="tooltip">'.$row['descricao'].'</p>
                <button class="btn" onclick="addToCart('.$row['id'].')">Adicionar ao Carrinho</button>
            </div>
        </div>';
    }
    ?>

    


</main>



   <script src="products.js"></script>
   <script src="cart_handler.js"></script>

</body>
</html>



