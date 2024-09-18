<?php 
session_start();
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $dados = json_decode(file_get_contents("php://input"),true);
   $_SESSION['usuario'] = $dados['usuario'];
   if($_SESSION['usuario']){
    echo json_encode([
        "session" => "usuarion online",
        "mensagem" => "o usuario" . $dados['usuario'] . " Esta logado" 
    ]);
   }
   
}
