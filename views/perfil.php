<?php 

$id_usuario = intval($_GET['id'] ?? null);

$titulo = "Pagina de perfil";
$conteudo = "pages/perfilPage.php";

$global_js = "../assets/js/global.js";
$link_js = "../assets/js/perfil.js";

$link_icons = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" ;

$link_css="../assets/css/perfil.css";
$global_css="../assets/css/global.css";

include "../includes/layout.php";