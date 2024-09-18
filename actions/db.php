<?php 
    $host = "localhost"; //endereço do servidor de banco de dados
    $db = "saep"; //nome do banco de dados
    $usuario = "root"; // Usuario
    $senha = ""; //senha
    $DSN = "mysql:host=$host;dbname=$db;"; //DATA SOURCE NAME OF PDO
    $config = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //configura o pdo para expecificar erros;
        PDO::ATTR_DEFAULT_FETCH_MODE =>  PDO::FETCH_ASSOC, //define o modo de recuperação de dados em forma de array ass
        PDO:: ATTR_EMULATE_PREPARES => false, //definir uma consuta com maior segurança
    ];

    try{
        $pdo = new PDO($DSN,$usuario,$senha = "");

    }catch(PDOException $error){
        echo "Erro na conexão com o banco de dados " . $error->getMessage();
        exit;
    }
