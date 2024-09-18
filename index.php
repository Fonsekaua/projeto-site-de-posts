
<?php 
$id_usuario = intval($_GET['id'] ?? null);

$titulo = "Página Inicial";
$conteudo = "views/pages/mainPage.php";

//JS
$link_js = "assets/js/main.js";
$global_js = "assets/js/global.js";

$link_icons = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" ;

//Css
$link_css="assets/css/main.css";
$global_css="assets/css/global.css";

include "includes/layout.php";
?>
