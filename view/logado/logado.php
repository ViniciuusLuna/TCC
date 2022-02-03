<?php

session_start();
include_once('cabecalhoLogado.php');

if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);

    session_destroy();
    header('location: ?pagina=login');
}
    $logado = $_SESSION['usuario'];

?>