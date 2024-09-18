<?php 

include __DIR__ . "/db.php";

// Seleciona todos os registros de uma tabela específica
function selecionarTabela($nome){
    global $pdo;
    $consulta = $pdo->query("SELECT * FROM $nome");
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

// Seleciona as imagens (URL e descrição) de um usuário específico
function UploadImgUserLog($usuario_id) {
    global $pdo;
    $consulta = "SELECT url, descricao FROM posts INNER JOIN usuarios ON usuarios.id = posts.usuario_id WHERE usuarios.id = :usuario_id;";
    $db = $pdo->prepare($consulta);
    $db->bindParam(":usuario_id", $usuario_id);
    $db->execute();
    return $db->fetchAll();
}

// Insere um novo post (imagem) no banco de dados
function UploadImage($url, $descricao, $usuario_id){
    global $pdo;
    $consulta = "INSERT INTO posts (url, descricao, usuario_id) VALUES (:url, :descricao, :usuario_id)";
    $db = $pdo->prepare($consulta);
    $db->bindParam(":url", $url);
    $db->bindParam(":descricao", $descricao);
    $db->bindParam(":usuario_id", $usuario_id);
    $db->execute();
    return $db->rowCount() > 0; // Retorna TRUE se a operação for bem-sucedida
}

// Adiciona uma curtida a um post específico
function addCurtida($post_id, $usuario_id){
    global $pdo;
    $consulta = "INSERT INTO curtidas (post_id, usuario_id) VALUES (:post_id, :usuario_id)";
    $db = $pdo->prepare($consulta);
    $db->bindParam(":post_id", $post_id);
    $db->bindParam(":usuario_id", $usuario_id);
    $db->execute();
    return $db->rowCount() > 0;
}

// Verifica se um usuário já curtiu um post
function verificarCurtida($post_id, $usuario_id){
    global $pdo;
    $consulta = "SELECT COUNT(*) FROM curtidas WHERE post_id = :post_id AND usuario_id = :usuario_id";
    $db = $pdo->prepare($consulta);
    $db->bindParam(":post_id", $post_id);
    $db->bindParam(":usuario_id", $usuario_id);
    $db->execute();
    return $db->fetchColumn() > 0;
}

// Conta o número total de curtidas em um post
function contarCurtidas($post_id) {
    global $pdo;
    $sql = "SELECT COUNT(*) FROM curtidas WHERE post_id = :post_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}

// Verifica se um comentário pertence a um post e a um usuário específico
function verificarComentario($comentario_id, $post_id, $usuario_id) {
    global $pdo;
    $consulta = "SELECT 1 FROM comentarios WHERE id = :comentario_id AND post_id = :post_id AND usuario_id = :usuario_id";
    $db = $pdo->prepare($consulta);
    $db->bindParam(':comentario_id', $comentario_id, PDO::PARAM_INT);
    $db->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $db->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $db->execute();
    return $db->fetch() !== false;
}

// Remove uma curtida de um post
function removeCurtida($post_id, $usuario_id){
    global $pdo;
    $consulta = "DELETE FROM curtidas WHERE post_id = :post_id AND usuario_id = :usuario_id";
    $db = $pdo->prepare($consulta);
    $db->bindParam(":post_id", $post_id);
    $db->bindParam(":usuario_id", $usuario_id);
    $db->execute();
    return $db->rowCount() > 0;
}

// Registra um novo usuário no sistema com senha hash
function fazerRegistro($nome, $usuario, $email, $senha) {
    global $pdo;
    
    try {
        $consulta = "INSERT INTO usuarios (nome, usuario, email, senha) VALUES (:nome, :usuario, :email, :senha)";
        $senhaCripito = password_hash($senha, PASSWORD_DEFAULT);
        $db = $pdo->prepare($consulta);
        $db->bindParam(":nome", $nome);
        $db->bindParam(":usuario", $usuario);
        $db->bindParam(":email", $email);
        $db->bindParam(":senha", $senhaCripito);
        $db->execute();
        return $db->rowCount() > 0;
    } catch (PDOException $e) {
        echo "Erro ao registrar: " . $e->getMessage();
        return false;
    }
}

// Realiza o login verificando o usuário, email e senha
function fazerLogin($usuario, $email, $senha) {
    global $pdo;
    
    $consulta = "SELECT * FROM usuarios WHERE BINARY usuario = :usuario AND BINARY email = :email";
    $db = $pdo->prepare($consulta);
    $db->bindParam(":usuario", $usuario);
    $db->bindParam(":email", $email);
    $db->execute();
    
    if ($db->rowCount() > 0) {
        $user = $db->fetch(PDO::FETCH_ASSOC);
        if (password_verify($senha, $user['senha'])) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// Insere um comentário em um post
function comentarioUpload($comentario, $usuario_id, $post_id) {
    global $pdo;
    $consulta = "INSERT INTO comentarios (conteudo, usuario_id, post_id) VALUES (:comentario, :usuario_id, :post_id)";
    $db = $pdo->prepare($consulta);
    $db->bindParam(':comentario', $comentario, PDO::PARAM_STR);
    $db->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $db->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $db->execute();
    return $db->rowCount() > 0;
}

