<?php

    $idPost = $_GET['id'];
    $adiciona = "INSERT INTO curtidas(id_post) VALUES ('$idPost')";

    if(mysqli_query($conn, $adiciona)){
        echo "<script>window.history.back()</script>";
    }else{
        echo "Erro ao curtir";
    }


?>