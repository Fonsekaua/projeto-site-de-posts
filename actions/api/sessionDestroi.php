<?php
session_start(); // Inicia a sessão

// Destruir todas as variáveis de sessão
session_unset();

// Destruir a sessão
session_destroy();

// Opcional: Redirecionar o usuário para a página inicial ou de login
header("Location: /projetosaep");
exit();
