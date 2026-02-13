<?php
require_once "login secction/trava.php";
require_once "config.php";

// Verificar se usuário veio pela primeira vez
$first_login = false;
$conn = new mysqli("localhost", "root", "", "only_shop");
$result = $conn->query("SELECT first_login FROM usuarios WHERE id = " . $_SESSION['user_id']);
if ($result) {
    $row = $result->fetch_assoc();
    $first_login = $row['first_login'];
    
   
    if ($first_login) {
        $conn->query("UPDATE usuarios SET first_login = 0 WHERE id = " . $_SESSION['user_id']);
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - ONLY SHOP</title>
    <link rel="stylesheet" href="Index.css">
    <style>
        /* Perfil Responsivo */
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            margin-top: 80px;
        }

        .welcome-message {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome-message h2 {
            font-size: 28px;
            margin: 0;
            font-weight: bold;
        }

        .welcome-message p {
            font-size: 16px;
            margin: 10px 0 0 0;
            opacity: 0.9;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #667eea;
            margin-bottom: 20px;
        }

        .profile-card h3 {
            font-size: 24px;
            margin: 15px 0;
            color: #333;
        }

        .profile-card p {
            color: #666;
            margin: 10px 0;
            font-size: 14px;
        }

        .edit-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background 0.3s;
        }

        .edit-btn:hover {
            background: #764ba2;
        }

        .profile-info {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .info-item {
            margin-bottom: 25px;
            border-bottom: 1px solid #945e5e;
            padding-bottom: 15px;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: bold;
            color: #667eea;
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .info-value {
            color: #333;
            font-size: 16px;
            margin-bottom: 10px;
            word-break: break-all;
        }

        .logout-btn {
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            width: 100%;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: #ff5252;
        }

      
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 40px;
            border-radius: 15px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .modal-content h2 {
            margin-top: 0;
            color: #333;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #0d0644313;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        .form-buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .form-buttons button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-save {
            background: #667eea;
            color: white;
        }

        .btn-save:hover {
            background: #764ba2;
        }

        .btn-cancel {
            background: #ddd;
            color: #333;
        }

        .btn-cancel:hover {
            background: #ccc;
        }

        .close-modal {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #666;
        }

        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .profile-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .profile-container {
                margin-top: 60px;
            }

            .welcome-message h2 {
                font-size: 22px;
            }

            .profile-card img {
                width: 120px;
                height: 120px;
            }

            .modal-content {
                padding: 20px;
                max-width: 90%;
            }
        }

        @media (max-width: 480px) {
            .profile-container {
                padding: 15px;
            }

            .welcome-message {
                padding: 20px;
            }

            .welcome-message h2 {
                font-size: 18px;
            }

            .profile-card {
                padding: 20px;
            }

            .profile-info {
                padding: 20px;
            }

            .edit-btn, .logout-btn {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <canvas id="bg-canvas"></canvas>

    <!-- Header -->
    <header class="topo">
        <nav>
            <h1>ONLY<span class="destaque">SHOP</span></h1>
            <ul id="menu">
                <il><a href="Cart.php"><img src="img/shopping-cart (1).png" alt="Carrinho"></a></il>
                <il><a href="produtos.php"><img src="img/bolsa-de-compras.png" width="30" alt="Produtos"></a></il>
                <button id="menu-btn" aria-expanded="false" aria-controls="dropdown-menu">☰</button>
            </ul>
        </nav>

        <div id="dropdown-menu" class="dropdown hidden" aria-hidden="true">
            <ul>
                <li><a href="indexF.php"><img src="img/casa.png" width="18" alt=""> &nbsp; Casa</a></li>
                <li><a href="profile.php"><img src="img/8338781.png" width="20" alt=""> &nbsp; Perfil</a></li>
                <li><a href="produtos.php"><img src="img/bolsa-de-compras.png" width="18" alt=""> &nbsp; Produtos</a></li>
                <li><a href="Cart.php"><img src="img/shopping-cart (1).png" width="20" alt="">&nbsp; Carrinho</a></li>
                <li><a href="contactoINDEX.php"><img src="img/info.png" width="20" alt=""> &nbsp; Contacto</a></li>
                <li><a href="login secction/logout.php" style="color: #ff6b6b;"><img src="img/info.png" width="20" alt=""> &nbsp; Sair</a></li>
            </ul>
        </div>
    </header>

    <div class="profile-container">
      

        <!-- Cards de Perfil -->
        <div class="profile-grid">
            <!-- Card Esquerda -->
            <div class="profile-card">
                <img id="profile-photo" src="login secction/uploads/<?php echo htmlspecialchars($_SESSION['user_foto']); ?>" alt="Foto de Perfil">
                <h3 id="profile-name"><?php echo htmlspecialchars($_SESSION['user_nome']); ?></h3>
                <p id="profile-email"><?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                <button class="edit-btn" onclick="openEditModal()">✏️ Editar Perfil</button>
            </div>

            <!-- Card Direita - Informações -->
            <div class="profile-info">
                <h3 style="margin-top: 0; color: #667eea;">Informações da Conta</h3>

                <div class="info-item">
                    <div class="info-label">Nome Completo</div>
                    <div class="info-value"><?php echo htmlspecialchars($_SESSION['user_nome']); ?></div>
                </div>

                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value"><?php echo htmlspecialchars($_SESSION['user_email']); ?></div>
                </div>

                <div class="info-item">
                    <div class="info-label">ID da Conta</div>
                    <div class="info-value">#<?php echo $_SESSION['user_id']; ?></div>
                </div>

                <button class="logout-btn" onclick="window.location.href='login secction/logout.php';">🚪 Sair da Conta</button>
            </div>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeEditModal()">✕</button>
            <h2>Editar Perfil</h2>
            
            <div id="editMessage"></div>

            <form id="editForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="editFoto">Foto de Perfil</label>
                    <input type="file" id="editFoto" name="foto" accept="image/*">
                    <small style="color: #666;">Deixe em branco para manter a atual</small>
                </div>

                <div class="form-group">
                    <label for="editNome">Nome Completo</label>
                    <input type="text" id="editNome" name="nome" required value="<?php echo htmlspecialchars($_SESSION['user_nome']); ?>">
                </div>

                <div class="form-group">
                    <label for="editEmail">Email</label>
                    <input type="email" id="editEmail" name="email" required value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>">
                </div>

                <div class="form-group">
                    <label for="editSenha">Senha (obrigatória para confirmar)</label>
                    <input type="password" id="editSenha" name="senha" required placeholder="Digite sua senha atual">
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-save">Salvar Alterações</button>
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="index1.js"></script>
    <script>
        function openEditModal() {
            document.getElementById('editModal').classList.add('active');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
            document.getElementById('editForm').reset();
            document.getElementById('editMessage').innerHTML = '';
        }

        document.getElementById('editForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(document.getElementById('editForm'));

            try {
                const response = await fetch('login secction/update_profile.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                const messageDiv = document.getElementById('editMessage');
                if (result.success) {
                    messageDiv.innerHTML = `<div class="message success">${result.message}</div>`;
                    
                    // Atualizar valores na página
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    messageDiv.innerHTML = `<div class="message error">${result.message}</div>`;
                }
            } catch (error) {
                document.getElementById('editMessage').innerHTML = `<div class="message error">Erro ao processar a solicitação</div>`;
            }
        });

        // Fechar modal ao clicar fora
        document.getElementById('editModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('editModal')) {
                closeEditModal();
            }
        });
    </script>
</body>
</html>
