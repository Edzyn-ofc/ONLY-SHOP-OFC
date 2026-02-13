<?php
session_start();
include 'config.php';
// Cálculo do valor real do carrinho
$total = 0;
if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
    foreach ($_SESSION['carrinho'] as $id => $quantidade) {
        $sql = "SELECT preco FROM produtos WHERE id = '$id'";
        $result = $conn->query($sql);
        if ($row = $result->fetch_assoc()) {
            $total += $row['preco'] * $quantidade;
        }
    }
}

if ($total <= 0) { header("Location: produtos.php"); exit(); }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pagamento Seguro - ONLY SHOP</title>
    <link rel="stylesheet" href="index.css">
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

        .payment-container { padding: 120px 5% 50px; color: white; max-width: 900px; margin: 0 auto; }
        .payment-card { background: rgba(15, 23, 42, 0.9); padding: 30px; border-radius: 20px; border: 1px solid #ff6600; box-shadow: 0 0 30px rgba(255,102,0,0.2); }
        
        .methods-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; margin: 25px 0; }
        .method-item { 
            background: #1e293b; padding: 20px; border-radius: 12px; text-align: center; 
            cursor: pointer; border: 2px solid transparent; transition: 0.3s;
        }
        .method-item:hover { border-color: #ff6600; transform: translateY(-5px); }
        .method-item img { width: 60px; height: 60px; object-fit: contain; margin-bottom: 10px; }
        
        .info-box { background: #0f172a; padding: 20px; border-radius: 10px; display: none; margin-top: 20px; border-left: 5px solid #ff6600; }
        .info-box.active { display: block; }
        
        .warning-text { color: #ffbc00; font-size: 0.85rem; margin-top: 15px; font-style: italic; }
        
        .btn-comprovante {
            display: inline-flex; align-items: center; gap: 10px; background: #25d366; 
            color: white; padding: 15px 25px; border-radius: 50px; text-decoration: none;
            font-weight: bold; margin-top: 20px; transition: 0.3s;
        }
        .btn-comprovante:hover { background: #128c7e; transform: scale(1.05); }
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
        <li><a href="Login/Cart.php"><img src="img/shopping-cart (1).png" width="20" alt="20px">&nbsp; carrinho </a></li>
        <li><a href="Login/Payments.php"><img src="img/cashback (1).png" width="22" alt=""> &nbsp; Pagamentos</a></li>
        <li><a href="contactoINDEX.php"><img src="img/info.png" width="20" alt=""> &nbsp; Contacto</a></li>
      </ul>
    </div>
  
    </header>


    <main class="payment-container">
        <div class="payment-card">
            <h2>Finalizar Pedido</h2>
            <p>Total a pagar: <span class="destaque" style="font-size: 1.8rem;">R$ <?php echo number_format($total, 2, ',', '.'); ?></span></p>

            <div class="methods-grid">
                <div class="method-item" onclick="showDetails('mpesa')">
                    <img src="data:image/png;base64,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" alt="M-Pesa">
                    <p>M-Pesa</p>
                </div>
                <div class="method-item" onclick="showDetails('emola')">
                    <img src="data:image/png;base64,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" alt="E-mola">
                    <p>e-Mola</p>
                </div>
                <div class="method-item" onclick="showDetails('paypal')">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/1200px-PayPal.svg.png" alt="PayPal">
                    <p>PayPal</p>
                </div>
                <div class="method-item" onclick="showDetails('bim')">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAACUCAMAAAAj+tKkAAAAflBMVEXQHGD////NAFLjkqnqrr7NAFXMAEzQF17LAEjMAE7OAFj78PPkkar67fHmnLLKAEPJAD/++vvz1Nzz0NvXW33iiaPmoLPWVHjdcZLpqbv34ujuvcvVSXbstcXWVXzed5fSMGnUPnDwxtLfgJvbZ4zQKWDaX4bIADbeg5jGACvpKsI+AAADsUlEQVR4nO2XC3ObOBCAtTJCsDwlAgEBDsjY1/v/f/Ak6E2cNK09F9L6ZvabMQ9bRh+r1SIYIwiCIAiCIAiCIAiCIAiCIAiCIAiCIAiCIAiC2J1JcvmnHX6FHPpO4J+2+BVSZGZ46BiKE5j43+N4HW90IcXQbeL4trrEL749OQMc+HacBs0sGS6DxNa8ILd2vtW7lO30tYZe0Kx9yDmB5ChxAeAihRTDJLs5+qIH+7U5jBdQcPJ9YAtKtSgHSLiorwSlfNV8fygaGN8Lfm8j94msSFUK2vcRGWu9qnRpdSUokc0zE5soTpPPUH/E5kk4BcHcdnPxN7K1YchQuqZ7KPIxOys4oh/rQ+O0mOxzfBWUmOskqZw4z/upN6Y/uiDbw1JlukGXEOMLDmPnspg3dsZjv9Ta2Da+WKODmyl8B6HWsoE+ZDxQQw2BkBL01RDzCvRLnUHOQw1mTDUkEz5Bpg+dgg5dsjbxBUzkrwTPooXM5CNAmvRNBvbzfqxILD4nasDJ6PIC1TtB0UH3V1FGBqaogrrgcQ9d/ARJyKOjygZeO8EndS145kUN8K2IZQbL50OIahRoIY9bWMQE2TvBSYO2jgyasoKjZOIAvRPU3ihJjj8Kjj5bMsUkC3toPz3D5aAa4SqLOdtESO4qzFvBwY1Tv1JvgnhaBavQzyr1gWAnmJyM8kmZw8unBbFVNbLQwDdokAkF7K3gbFRbxB4MfxT8KIKroFZiJ0FXZRYnlroS6PcGLvh2klgY+VYMPxD8HsFjkjnBIvsKQTd3XS2QU7I+EISFmr+dJItyoY1jcRyin0WQuxE9xfwEXyGIVvkqiwHUYt2N8ZVg8ix9v7ofq+wc6StBvUXwyQsKN9VVVSVXETTgBZsdBKe+8isFKav1WVGbgDPd4bZY6Hu/djgfTGaqBXmnB7+UqHIxVGtlDuyArfY1vMkyc2yqAS/alXo2jf7ZhCfz38oMild4UW77aN2FZSGE/8RlKERR8PWnsijL2J2W/jQuI8HLtbn/Ym0ooogX8XYavV419P965V4/eTrsSpqmblvfbndvNGUe7Io2bjOa7mbDu4db8D2JDsHfZTjpqIjKyKXIz1ve67czeAgCO09dnJ/cGseO7NHecPAwDrmekrLK52ycTH73ZPhNOMEoNMesrObC1kUePKBguZjJCQ6hrcMHFKyTyixOUD+ooJsUk3uLkdsbyV6vSvvyiE4EQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRDE/5d/ABfPTVWtLsJbAAAAAElFTkSuQmCC" alt="BIM">
                    <p>Banco BIM</p>
                </div>
            </div>

            <div id="mpesa" class="info-box">
                <h3>Pagamento via M-Pesa</h3>
                <p>Envie o valor para: <strong>+258 857 378 645</strong></p>
                <p class="warning-text">⚠️ Aviso: Não nos responsabilizamos por valores enviados para números errados ou falhas na digitação.</p>
            </div>

            <div id="emola" class="info-box">
                <h3>Pagamento via e-Mola</h3>
                <p>Envie o valor para: <strong>+258 878 078 645</strong></p>
                <p class="warning-text">⚠️ Aviso: Confirme o número antes de validar a transação.</p>
            </div>

            <div id="paypal" class="info-box">
                <h3>Pagamento via PayPal</h3>
                <p>Enviar para: <strong>edzyneldrogadon@gmail.com</strong></p>
                <p><i>Nota: Use a opção "Amigos e Família" para evitar taxas extras.</i></p>
            </div>

            <div id="bim" class="info-box">
                <h3>Transferência BIM</h3>
                <p>IBAN/Conta: <strong>20212223242526</strong></p>
                <p>Titular: ONLY SHOP - EDZYN</p>
            </div>

            <div style="text-align: center; margin-top: 40px;">
                <p>Após efetuar o pagamento, clique abaixo para enviar o comprovativo:</p>
                <a href="https://wa.me/258857378645?text=Olá, segue o comprovativo do meu pedido na Only Shop" class="btn-comprovante">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" width="25"> Enviar Comprovativo
                </a>
                <br>
                <a href="contactos.php" style="color: #aaa; text-decoration: none; display: block; margin-top: 15px;">Precisa de ajuda? Contacte-nos</a>
            </div>
        </div>
    </main>

    <script src="products.js"></script>
</body>
</html>