<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Meu Carrinho - ONLY SHOP</title>
    <style>
        * { 
   
    margin: 0; 
    padding: 0; 
    box-sizing: border-box; 
    font-family: Arial, sans-serif; 
} 

 header { 
   
    background-color: rgb(8, 26, 56); 
    color: white; 
    padding: 10px 20px;  
    text-align:center; 
    position: fixed;
    width: 100%;
    top: 0; 
    left: 0; 
    z-index: 1000; 
    transition: 1.7s;

} 



/*corpo*/
body { 
    background-color: rgba(27, 29, 24, 0.53); 
    color: #333; 
    line-height: 1.6; 
    background-image:url();
    background-size: cover;
    background-position:center;
    backdrop-filter: blur(50px);
}


.destaque {
    color: #ff6600;
    background-color: transparent;
    padding: 2px 8px;
    border-radius: 20px 16px;
    display: inline-block;
    text-shadow:0px 0px 10px rgba(255, 255, 0, 0.7);
    font-weight: 800;
    -webkit-text-stroke: 2px black;
    text-shadow: 
    0px 0px 10px #ff6600,
    0px 0px 20px #ff6600,
    0px 0px 30px #ff6600,
    0px 0px 40px #ff6600;
    
}

nav { 
    display: flex; 
    justify-content: space-between; 
    gap: 20px; 
} 
  
nav a { 
    color: white; 
    text-decoration: none; 
    font-size: 18px; 
    padding: 10px 5px; 
    transition: 0.3s; 
    text-align: right;
} 
 
nav a:hover { 
    background: #9cacbb6e; 
    border-radius: 5px; 
} 

/*parte do menu-*/
.menu { 
    list-style:none; 
    display:flex; 
    gap:14px; 
    align-items:center;
 }
.menu a { 
    color:#fff; 
    text-decoration:none; 
    display:inline-flex; 
    align-items:center; 
}
#menu-btn { 
    background:transparent; 
    border:0; 
    color:#fff; 
    font-size:20px; 
    cursor:pointer; }

/* dropdown */
.dropdown { 
        position:absolute; 
        right:18px; 
        top:64px; 
        background:#222;
        border:1px solid rgba(255,255,255,0.06); 
        padding:8px; 
        border-radius:8px; 
        min-width:200px; 
        box-shadow:0 8px 30px rgba(0,0,0,0.6);
     }
.hidden { 
    display:none; 
}
.dropdown ul {
     list-style:none; 
    }
.dropdown li a { 
    display:block; 
    color:#fff; 
    padding:8px 10px; 
    text-decoration:none; 
    border-radius:6px; 
}
.dropdown li a:hover { 
    background: rgba(255,255,255,0.04); 
}

        .cart-container {
          
            display: flex;
            padding: 120px 5% 50px;
            gap: 30px;
            color: white;
        }
        .cart-items {
            flex: 2;
            background: rgba(38, 50, 75, 0.53);
            padding: 20px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }
        .cart-summary {
            flex: 1;
            background: #0e1621;
            padding: 25px;
            border-radius: 15px;
            height: fit-content;
            border: 1px solid #21299e;
            box-shadow: 0 0 20px rgba(255, 102, 0, 0.2);
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #333;
            padding: 15px 0;
        }
        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        /* Botão com Efeito Especial */
        .btn-pay {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, #326608, #1a1002);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: bold;
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
            box-shadow: 0 0 15px #1d0505;
        }
        .btn-pay:hover {
            transform: scale(1.03);
            box-shadow: 0 0 25px #091768;
        }
    </style>
</head>
<body>

    <header class="topo">
        
        <nav>
    <h1>ONLY
     <span class="destaque">SHOP</span>
   </h1>
   <ul id="menu">
                <il><a href="Cart.php"><img src="img/shopping-cart (1).png" alt="20px"></a>
				<il> <a href="produtos.php"><img src="img/bolsa-de-compras.png" width="30"></a>
			
			
			<button id="menu-btn" aria-expanded="false" aria-controls="dropdown-menu">☰</button>
    </nav>

    <div id="dropdown-menu" class="dropdown hidden" aria-hidden="true">
      <ul>
        <li><a href="indexF.php"><img src="img/casa.png" width="18" alt=""> &nbsp; Casa</a></li>
        <li><a href="produtos.php"><img src="img/bolsa-de-compras.png" width="18" alt=""> &nbsp; Produtos</a></li>
        <li><a href="Cart.php"><img src="img/shopping-cart (1).png" width="20" alt="20px">&nbsp; carrinho </a></li>
        <li><a href="Login/Payments.php"><img src="img/cashback (1).png" width="22" alt=""> &nbsp; Pagamentos</a></li>
        <li><a href="contactoINDEX.php"><img src="img/info.png" width="20" alt=""> &nbsp; Contacto</a></li>
      </ul>
    </div>
  
    </header>

    <main class="cart-container">
    <div class="cart-items">
        <h2>Seu Carrinho</h2>
        <?php
        $total = 0;
        if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
            foreach ($_SESSION['carrinho'] as $id => $quantidade) {
                // Busca os detalhes de cada produto no banco
                $sql = "SELECT * FROM produtos WHERE id = '$id'";
                $result = $conn->query($sql);
                if ($row = $result->fetch_assoc()) {
                    $subtotal = $row['preco'] * $quantidade;
                    $total += $subtotal;
                    
                    echo '
                    <div class="cart-item" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; padding: 10px;">
                        <img src="'.$row['imagem'].'" width="50">
                        <div style="flex: 1; margin-left: 20px;">
                            <h4>'.$row['nome'].'</h4>
                            <p>R$ '.number_format($row['preco'], 2, ',', '.').'</p>
                        </div>
                        
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <a href="update_cart.php?id='.$id.'&acao=remove" style="background:#444; color:white; padding:5px 10px; text-decoration:none; border-radius:5px;">-</a>
                            <span style="font-weight:bold; font-size: 1.2rem;">'.$quantidade.'</span>
                            <a href="update_cart.php?id='.$id.'&acao=add" style="background:#ff6600; color:white; padding:5px 10px; text-decoration:none; border-radius:5px;">+</a>
                        </div>
                        
                        <div style="margin-left: 20px; min-width: 100px; text-align: right;">
                            <strong>R$ '.number_format($subtotal, 2, ',', '.').'</strong>
                        </div>
                    </div>';
                }
            }
        } else {
            echo "<p>Carrinho vazio.</p>";
        }
        ?>
    </div>

    <div class="cart-summary">
    <h3>Total: <span class="destaque">R$ <?php echo number_format($total, 2, ',', '.'); ?></span></h3>
    <a href="Payments.php" style="text-decoration: none;">
        <button class="btn-pay" style="margin-top: 20px;">Ir para o Pagamento</button>
    </a>
</div>
</main>

    <script src="products.js"></script>
</body>
</html>