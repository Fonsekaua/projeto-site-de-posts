<?php 
include "../../actions/db_actions.php";
if($_SERVER["REQUEST_METHOD"] === "POST"){

    $dados = json_decode(file_get_contents("php://input"),true);
    $nome = $dados['nome'];
    $usuario = $dados['usuario'];
    $email = $dados['email'];
    $senha = $dados['senha'];

    if (strlen($nome) < 3 || strlen($usuario) < 3 || strlen($email) < 10 || strlen($senha) < 3) {
        $registro = false;
        $mensagem = "Algum dos campos é menor que o necessário!";
    }

    // Verifica se o nome contém números
    else if (preg_match('/\d/', $nome)) {
        $registro = false;
        $mensagem = "Seu nome é inválido pois não pode conter números!";
    }
    // Verifica a validade do e-mail
    else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $registro = false;
        $mensagem = "Seu e-mail é inválido!";
    }
    
    // Verifica se a senha contém pelo menos uma letra maiúscula e um número
    else if (!preg_match('/[A-Z]/', $senha) || !preg_match('/[0-9]/', $senha)) {
        $registro = false;
        $mensagem = "Sua senha é inválida; ela deve conter pelo menos uma letra maiúscula e um número!";
    }
    
    else{
        $registro = true;
        $mensagem = "Seu Registro foi feito com sucesso!!";
        fazerRegistro($nome,$usuario,$email,$senha);

    }
    echo json_encode([
        "registro" => $registro,
        "mensagem" => $mensagem
    ]);
}