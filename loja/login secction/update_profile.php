<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Não autenticado']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $user_id = $_SESSION['user_id'];

    // Validar senha
    $stmt = $pdo->prepare("SELECT senha FROM usuarios WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($senha, $user['senha'])) {
        echo json_encode(['success' => false, 'message' => 'Senha incorreta']);
        exit();
    }

    // Validar email único
    if ($email !== $_SESSION['user_email']) {
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
        $stmt->execute([$email, $user_id]);
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Este email já está em uso']);
            exit();
        }
    }

    // Processar upload de foto
    $foto = $_SESSION['user_foto'];
    if (!empty($_FILES['foto']['name'])) {
        $file = $_FILES['foto'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($ext, $allowed)) {
            echo json_encode(['success' => false, 'message' => 'Formato de imagem inválido']);
            exit();
        }

        if ($file['size'] > 5 * 1024 * 1024) { // 5MB
            echo json_encode(['success' => false, 'message' => 'Arquivo muito grande (máx 5MB)']);
            exit();
        }

        // Criar pasta se não existir
        if (!is_dir(__DIR__ . '/uploads')) {
            mkdir(__DIR__ . '/uploads', 0755, true);
        }

        $new_filename = 'profile_' . $user_id . '_' . time() . '.' . $ext;
        $upload_path = __DIR__ . '/uploads/' . $new_filename;

        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            // Deletar foto antiga se não for default
            if ($foto !== 'default.png' && file_exists(__DIR__ . '/uploads/' . $foto)) {
                unlink(__DIR__ . '/uploads/' . $foto);
            }
            $foto = $new_filename;
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao fazer upload da foto']);
            exit();
        }
    }

    // Atualizar no banco
    $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, foto = ? WHERE id = ?");
    if ($stmt->execute([$nome, $email, $foto, $user_id])) {
        // Atualizar sessão
        $_SESSION['user_nome'] = $nome;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_foto'] = $foto;

        echo json_encode(['success' => true, 'message' => 'Perfil atualizado com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar perfil']);
    }
    exit();
}
?>
