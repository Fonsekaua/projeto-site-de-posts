<?php 
include "../../actions/db_actions.php";
if($_SERVER["REQUEST_METHOD"] === "POST"){

    $dados = json_decode(file_get_contents("php://input"),true);
    $usuario = $dados['usuario'];
    $email = $dados['email'];
    $senha = $dados['senha'];

    if(fazerLogin($usuario,$email,$senha)){
        $login = true;
        $mensagem = "Bem-vindo $usuario !";
    }else{
        $login = false;
        $mensagem = "Não foi possivel fazer seu login...";
    }

    echo json_encode([
        "login" => $login,
        "mensagem" => $mensagem
    ]);
}