<?php

//Inicio da conexao com a base de dados utilizando PDO
$host = "localhost";
$user = "root";
$pass = "nada";
$dbname = "instantcar";
$port = 3306;

try {
    
    //Conexao sem a porta
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
    //echo "Conexão com base de dados realizada com sucesso.";
} catch (PDOException $err) {
    echo "Erro: Conexão com base de dados não realizada com sucesso. Erro" . $err->getMessage();
}
    //Fim da conexão com o base de dados utilizando PDO
?>