<?php 
session_start();
    include "../../../actions/db_actions.php";
    $usuario = selecionarTabela('usuarios');
    foreach($usuario as $usuarios){
        if($_SESSION){
            if($usuarios['usuario'] == $_SESSION['usuario']){
                $id = $usuarios['id'];
            }
        }
    }
    

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $diretorio= "uploads/";
    $name = $_FILES['arquivo']['name'];
    $caminho_arquivo = $diretorio . basename($name);

    $get_extencao = strtolower(pathinfo($caminho_arquivo, PATHINFO_EXTENSION));

    $arquivo_ID_unique = uniqid() . "." . $get_extencao;

    
    $caminho_arquivo = $diretorio . $arquivo_ID_unique;var_dump($caminho_arquivo);

    $deu_certo;

    $check_img = getimagesize($_FILES['arquivo']["tmp_name"]);
    if($check_img){
        $deu_certo = true;
        echo "Deu certo!!";
    }else{
        $deu_certo = false;
        echo "Deu Errado!!";
    }
    if($_FILES['arquivo']['size']>10000000){
        $deu_certo = false;
        echo "O tamanho da imagem é muito grande!!";
    }else{
        $deu_certo = true;
        echo "A imagem enviada com o tamanho certo!! ";
    }

    if($get_extencao != "jpg" && $get_extencao != "png" && $get_extencao != "jpeg" && $get_extencao != "gif"){
        $deu_certo = false;
        echo "Não aceitamos este tipo de arquivo!!";
    }else{ 
        $deu_certo = true ;
    }

    if($deu_certo){
        if(move_uploaded_file($_FILES['arquivo']['tmp_name'],$caminho_arquivo)){
            $descricao = $_POST['descricao'];
            $url = $caminho_arquivo;
            UploadImage($url,$descricao,$id);
            
        }
    }else{

    }
    header("location: ../../perfil.php?id=$usuario_logado");
    exit;


}


