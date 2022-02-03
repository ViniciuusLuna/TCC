
<?php 
    include_once('cabecalhoLogado.php');
    include_once('logado.php');
?>
<div>

<div class="header">

    <div >

    <?php

    $idPost = $_GET['id'];

    $seleciona = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$idPost'");
    $conta = mysqli_num_rows($seleciona);

    if($conta <= 0){
        echo "Post nao encontrado";
    } else{
        while($row = mysqli_fetch_array($seleciona)){
            $id = $row['id'];
            $titulo = $row['titulo'];
            $descricao = $row['descricao'];
            $data = $row['data'];
            $hora = $row['hora'];
            $postador = $row['postador'];
            $materia = $row['materia'];
            $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE usuario = '$postador'");
            $linha = mysqli_fetch_assoc($query);

            $selecionaCurtidas = mysqli_query($conn, "SELECT * FROM curtidas WHERE id_post = '$id'");
            $contaCurtidas = mysqli_num_rows($selecionaCurtidas);

            if($contaCurtidas == 1){
                $contaCurtidas = $contaCurtidas. " Curtiu";
            }else if($contaCurtidas > 1){
                $contaCurtidas = $contaCurtidas. " Curtiram";
            }

            $selecionaRespostas = mysqli_query($conn, "SELECT * FROM respostas WHERE id_post = '$id'");
            $contaRespostas = mysqli_num_rows($selecionaRespostas);

            if($contaRespostas == 1){
                $contaRespostas = $contaRespostas. " Comentou";
            }else if($contaRespostas > 1){
                $contaRespostas = $contaRespostas. " Comentaram";
            }


    ?>

        <div id="panel" style="text-align: left;">
            <p>
                <a href="?pagina=post&id=<?php echo $id;?>" class="titulo"><?php echo $titulo; ?></a>
            </p>
            <?php if($descricao != null) {?>
            <p class="descricao"><?php echo $descricao ?></p><?php }?>

            <div>
                <p class="descricao">
                    materia:
                    <?php echo $materia ?></p>
            </div>

            <p>
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                Postado em:
                <?php echo $data . " as " . $hora; ?>
            </br>
        </br>
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        Postado por:
        <?php echo $linha['nome'];?></p>

    <div>
        <code>
            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
            <?php echo $contaCurtidas ?>
            -
            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
            <?php echo $contaRespostas ?></code>
    </div>

    <div>
        <a href="?pagina=curtir&id=<?php echo $id;?>" class="btn btn-dafault">
            <span class="glyphicon glyphicon-thumbs-up"></span>
            Curtir
        </a>
        <a href="?pagina=post&id=<?php echo $id;?>" class="btn btn-dafault">
            <span class="glyphicon glyphicon-comment"></span>
            Comentar
        </a>
    </div>

    </div>

    <?php 
            }
        }
        
        ?>

    <div id="panel" style="text-align: left;">

    <h3>Responda aqui</h3>
    <hr>
    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <label for="">Usuario</label>
            <p><?php echo $logado ?></p>
        </div>

        <div>
            <textarea
                name="comentario"
                id="comentario"
                placeholder="Responda aqui..."
                class="form form-control"></textarea>
        </div>

        <div align="right">
            <input type="submit" value="Enviar Resposta" class="btn btn-success">
        </div>

        <input type="hidden" name="comentar" value="comment">
    </form>

    <?php
                if($_POST['comentar'] == "comment"){
                    $nome = $logado;
                    $comentario = $_POST['comentario'];
                    date_default_timezone_set('America/Sao_Paulo');
                    $data = date("d/m/Y");
                    $hora = date("H:i:s");

                    if(empty($comentario)){
                        echo "Preencha todos os campos!";
                    }else {
                        $comentar = "INSERT INTO respostas(id_post, nome, comentario, data, hora) VALUES ('$idPost' , '$nome', '$comentario', '$data', '$hora')";

                        if(mysqli_query($conn, $comentar)){
                            echo "Comentario enviado com sucesso";
                        }
                    }
                }
            ?>

    <hr>

    <?php

                    $limite = 3;

                    $seleciona = mysqli_query($conn, "SELECT * FROM respostas WHERE id_post = '$idPost' ORDER BY id DESC LIMIT $limite");
                    $conta = mysqli_num_rows($seleciona);

                    if($conta <= 0) {
                        echo "<code> Essa pergunta ainda nao possui respostas";
                    }else{
                        while($row = mysqli_fetch_array($seleciona)){
                            $nome = $row['nome'];
                            $comentario = $row['comentario'];
                            $data = $row['data'];
                            $hora = $row['hora'];

                ?>

    <div id="comentarios" class="well well-sm">
        <div><img style="height: 30px; margin-bottom: 5px;" src="image/foto.jpg" alt="..." class="rounded">
            <strong><?php echo $nome; ?>
            </strong>
        </div>
        <div class="list-group-item"><?php echo $comentario; ?>
        </div>
        <div class="list-group-item">
            <span class="bi bi-stopwatch"" aria-hidden="true"></span>
            Respondido em:
            <?php echo $data . " as " . $hora; ?></div>

    </div>

    <?php
                }
            }
            ?>

    </div>

</div>

</div>
</div>