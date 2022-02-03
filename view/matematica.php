<div>

    <div class="header">
        <div>

            <?php include_once('cabecalho.php'); ?>

            <div id="panel">
<h1 style="padding-bottom: 10px;">
    Navegue entre as Materias
</h1>
<section class="container flex" style="padding: 15px;">
<div class="item-1 flex-item-1">
    <a class="btn btn-primary btn-lg" href="?pagina=portugues">
        Portugues</a>
</div>
<div class="item-1 flex-item-1">
    <a class="btn btn-primary btn-lg" href="?pagina=matematica">Matematica</a>
</div>
<div class="item-1 flex-item-1">
    <a class="btn btn-primary btn-lg" href="">Historia</a>
</div>
<div class="item-1 flex-item-1">
    <a class="btn btn-primary btn-lg" href="">Quimica</a>
</div>


<div class="item-1 flex-item-1">
    <a class="btn btn-primary btn-lg" href="">Fisica</a>
</div>
<div class="item-1 flex-item-1">
    <a class="btn btn-primary btn-lg" href="">Geografia</a>
</div>
</section>
<section class="container flex" style="margin-top: 20px; padding: 15px;">
<div class="item-1 flex-item-1">
    <a class="btn btn-primary btn-lg" href="">Biologia</a>
</div>
<div class="item-1 flex-item-1">
    <a class="btn btn-primary btn-lg" href="">Filosofia</a>
</div>


<div class="item-1 flex-item-1">
    <a class="btn btn-primary btn-lg" href="">
        Artes</a>
</div>
<div class="item-1 flex-item-1">
    <a class="btn btn-primary btn-lg" href="">Sociologia</a>
</div>
<div class="item-1 flex-item-1">
    <a class="btn btn-primary btn-lg" href="">Redação</a>
</div>
<div class="item-1 flex-item-1">
    <a class="btn btn-primary btn-lg" href="">..........</a>
</div>
</section>
</div>

<div id="panel" style="margin-top: 20px;">
                <h1>Matematica - Todas as Perguntas</h1>
            </div>


        <?php



    $seleciona = mysqli_query($conn, "SELECT * FROM posts WHERE materia LIKE 'matematica' ORDER BY id DESC");
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

            <div id="panel" style="text-align: left; margin-top: 5px;">

                <div>
                    <a href="?pagina=post&id=<?php echo $id;?>" class="titulo"><?php echo $titulo; ?></a>
                </div>

                <?php if($descricao != null) {?>
                <p class="descricao"><?php echo $descricao ?></p><?php }?>

                <div>
                    <p class="descricao">
                        materia:
                        <?php echo $materia ?></p>
                </div>

                <div>
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                    Postado em:
                    <?php echo $data . " as " . $hora; ?>
                </br>
            </br>
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            Postado por:
            <?php echo $linha['nome'];?></div>

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

</div>

</div>
</div>