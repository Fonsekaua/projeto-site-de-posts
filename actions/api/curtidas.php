<?php 
include "../../actions/db_actions.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $dados = json_decode(file_get_contents("php://input"),true);
    $post_id = $dados['id'];
    $usuario_id = $dados['usuario'];


    if(verificarCurtida($post_id,$usuario_id)){
        $curtida = true;
        $mensagem = "você deu DESLIKE";
        removeCurtida($post_id,$usuario_id);
    }else{
        $curtida = false;
        $mensagem = "Você deu LIKE";
        addCurtida($post_id,$usuario_id);

    }

    echo json_encode([
        "curtida" => $curtida,
        "mensagem" => $mensagem
    ]);
}
