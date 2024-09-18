<?php 
include "../../actions/db_actions.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $dados = json_decode(file_get_contents("php://input"),true);
    $conteudo = $dados['conteudo'];
    $usuario_id = $dados['usuario'];
    $post_id = $dados['post'];


    
    if(comentarioUpload($conteudo,$usuario_id,$post_id)){
        $comente = true;
        $mensagem = "Post comentado com Sucesso";
    }else{
        $comente = false;
        $mensagem = "Seu comentario não pode ser enviado!";
    }

    echo json_encode([
        "conteudo" => $conteudo,
        "comente" => $comente,
        "mensagem" => $mensagem
    ]);
}
