<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Lg.css">
</head>
<body>
     <canvas id="bg-canvas"></canvas>
    <header class="topo">
        <nav>
    <h1>ONLY
     <span class="destaque">SHOP</span>
   </h1>
   <ul id="menu">
				<il> <a href="login.php"><img src="../img/perfil.png"></a>
           		<button id="menu-btn" aria-expanded="false" aria-controls="dropdown-menu">☰</button>
    </nav>

    <div id="dropdown-menu" class="dropdown hidden" aria-hidden="true">
      <ul>
        <li><a href="../indexF.hp"><img src="../img/casa.png" width="18" alt=""> &nbsp; Casa</a></li>
        <li><a href="../login secction/Login.php"><img src="../img/8338781.png" width="20" alt=""> &nbsp; Conta</a></li>
        <li><a href="../produts.php"><img src="../img/bolsa-de-compras.png" width="18" alt=""> &nbsp; Produtos</a></li>
        <li><a href="../Login/Cart.php"><img src="../img/shopping-cart (1).png" width="20" alt="20px">&nbsp; carrinho </a></li>
        <li><a href="../Login/Paymens.php"><img src="../img/cashback (1).png" width="22" alt=""> &nbsp; Pagamentos</a></li>
        <li><a href="../contactoINDEX.php"><img src="../img/info.png" width="20" alt=""> &nbsp; Contacto</a></li>
        
      </ul>
    </div>
    </header>
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <label for="tab-1" class="tab">Entrar</label>

            <input id="tab-2" type="radio" name="tab" class="sign-up">
            <label for="tab-2" class="tab">Cadastrar-se</label>

            <div class="login-form">
                <div class="sign-in-htm">
     <form action="read.php" method="POST">
    <input type="hidden" name="action" value="cadastrar"> <div class="grupo">
        <label for="usuario" class="label">Usuário ou Email</label>
        <input name="usuario" id="usuario" type="text" class="input" required>
    </div>
    <div class="grupo">
        <label for="senha" class="label">Senha</label>
        <input name="senha" id="senha" type="password" class="input" required>
    </div>
    <div class="grupo">
        <input type="submit" class="button" value="Entrar">
    </div>
</form>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="forgot_password.php">Esqueci a palavra passe?</a>
                    </div>
                </div> 

                <div class="sign-up-htm">
                    <form action="create.php" method="POST">
    <div class="grupo">
        <label for="usuario-1" class="label">Nome</label>
        <input id="usuario-1" name="nome" type="text" class="input" placeholder="Nome" required>
    </div>
    <div class="grupo">
        <label for="email-1" class="label">Email</label>
        <input id="email-1" name="email" type="email" class="input" placeholder="email" required>
    </div>
    <div class="grupo">
        <label for="senha-1" class="label">Senha</label>
        <input id="senha-1" name="senha" type="password" class="input" placeholder="Password" required>
    </div>
    <div class="grupo">
        <label for="senha-1-repeat" class="label">Repita a senha</label>
        <input id="senha-1-repeat" name="senha_repeat" type="password" class="input" placeholder="Repita a senha" required>
    </div>
    <div class="grupo">
        <input type="submit" class="button" value="Cadastrar-se">
    </div>
</form>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">Já é um membro?</label>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../index1.js"></script>
</body>
</html>
