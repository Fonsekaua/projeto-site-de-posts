<?php 
session_start();
include __DIR__ . "/../actions/base_url.php" ;

include __DIR__ . "/../actions/db_actions.php" ;

$usuario = selecionarTabela('usuarios');
foreach($usuario as $usuarios){
    if($_SESSION){
        if($usuarios['usuario'] == $_SESSION['usuario']){
            $id = $usuarios['id'];
            
            $usuarioLog = $usuarios['usuario'];
        
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'SeapTavaFácil' ?></title>
</head>
<link rel="stylesheet" href=<?= $global_css ?? ""?>>
<link rel="stylesheet" href=<?= $link_css ?? ""?>>
<link rel="stylesheet" href=<?= $link_icons ?? "" ?>>

<body>
    <?php include 'header.php' ?>

    <main>
        <?php include $conteudo ?>
    </main>

    <?php include 'footer.php' ?>
</body>

</html>

<script src=<?= $link_js??""?>></script>
<script src=<?= $global_js??""?>></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>