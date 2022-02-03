<?php

// Dados do servidor
$host = "localhost";
$banco = "bancoreply";
$usuario = "root";
$senha = "";


// Efetuando a conexao
// $conect = new PDO($host, $banco, $usuario, $senha);

$conn = new mysqli($host, $usuario, $senha, $banco);

// if($conn -> connect_errno){
//     echo "Error";
// }else{
//     echo "Conexão efetuada com sucesso";
// }

?>