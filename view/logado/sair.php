<?php

session_start();

if((isset($_SESSION['usuario'])) and (isset($_SESSION['senha']))){

    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);

    header('location: ?pagina=Inicio');
}

?>