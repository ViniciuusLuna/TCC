
<div>

<div class="header">

    <?php 
        include_once('cabecalhoLogado.php');
        include_once('logado.php');
    ?>

    <div id="panel" style="margin-top: 20px; background-color: #4682B4; margin-bottom: 10px;">
            
    <main>

        <div class="painel">
            <div class="item-painel" style="height: 40px; width: 100%;"> <p>CENTRAL DO ESTUDANTE</p> </div>
        </div>
        <div class="painel">
            
        <div class="item-painel"> <p> COMPARTILHE CONHECIMENTO</p></div>
        <div class="item-painel">
            <div class="img item-painel"><img class="maos" src="image/maos.png" alt="maos"></div>
        </div>
        <div class="item-painel"> <p>TIRE AS SUAS <br> DUVIDAS</p> </div>

        </div>
    </main>

    </div>

    <div id="panel">


        <h1>Faça uma pergunta</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <input
                    type="text"
                    name="titulo"
                    id="titulo"
                    placeholder="Titulo da pergunta"
                    class="form form-control">
            </div>

            <div>

            <div>
                <textarea
                    name="descricao"
                    id="descricao"
                    placeholder="Faca sua pergunta..."
                    class="form form-control"></textarea>
            </div>

            <div>
                <select name="materia">
                    <option value="valor1" selected="selected">Escolha a Materia</option>
                    <option value="portugues">Portugues</option>
                    <option value="matematica">Matematica</option>
                </select>
            </div>

            <div align="right">
                <input type="Submit" value="Publicar" class="btn btn-default"/>
            </div>

            <input type="hidden" name="enviar" value="send"/>
        </form>

    <?php
    
        if(isset($_POST['enviar']) && $_POST['enviar'] == "send"){
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            date_default_timezone_set('America/Sao_Paulo');
            $data = date("d/m/Y");
            $hora = date("H:i:s");
            $postador = $_POST['postador'];
            $materia = $_POST['materia'];


            if(empty($titulo) || empty($postador)){
                echo "E obrigatorio ter um titulo e colocar o nome do postador.";
            }else{
                $query = mysqli_query($conn, "INSERT INTO posts (id, titulo, descricao, data, hora, postador, materia) VALUES (null, '$titulo', '$descricao', '$data', '$hora', '$postador', '$materia')");

            if(mysqli_query($conn, $query)){
                echo "Publicacao inserida com sucesso!";
            }
            }

            
        }

    ?>
    </div>
</div>



<div style="margin-top: 20px; margin-bottom: 5px;" id="panel">
    <h1>Perguntas Recentes</h1>
</div>

<?php

    if(isset($_GET['posts'])){
        $pg = (int)$_GET['posts'];
    }else{
        $pg = 1;
    }

    $maximo = 2;
    $inicio = ($pg * $maximo ) - $maximo;
    
    $seleciona = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC LIMIT $inicio, $maximo");
    $conta = mysqli_num_rows($seleciona);

    if($conta <= 0) {
        echo "<code> Nenhuma Postagem encontrada";
    }else{
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
    <div>
        <a href="?pagina=postLogado&id=<?php echo $id;?>" class="titulo"><?php echo $titulo; ?></a>
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

<nav id="panel">
<ul class="pagination">
<?php

    $seleciona = mysqli_query($conn, "SELECT * FROM posts"); 
    $totalPosts = mysqli_num_rows($seleciona);

    $paginas = ceil($totalPosts/$maximo);
    $links = 2;

    echo '<li><a href="?pagina=inicioLogado&posts=1" aria-label="Pagina Inicial"><span aria-hidden="true">&laquo;</span></a></li>';

    for($i = $pg - $links; $i <= $pg -1; $i++){
        if($i <= 0){}else{
        echo '<li><a href="?pagina=inicioLogado&posts='.$i.'">' .$i.'</a></li>';
    }
}

echo '<li><a href="?pagina=inicio&posts='.$pg.'">' .$pg.'</a></li>';

for($i = $pg + 1; $i <= $pg + $links; $i++)
    if($i > $paginas){}else{
        echo '<li><a href="?pagina=inicioLogado&posts='.$i.'">' .$i.'</a></li>';
    }

    echo '<li><a href="?pagina=inicioLogado&posts='.$paginas.'" aria-label="Ultima Pagina"><span aria-hidden="true">&raquo;</span></a></li>';
    ?>
</ul>
</nav>

<div id="panel">
<h1>
    Materias
</h1>
<section class="container flex">
    <div class="item flex-item-1">
        <a class="btn btn-primary btn-lg" href="?pagina=portugues">
            Portugues</a>
    </div>
    <div class="item flex-item-1">
        <a class="btn btn-primary btn-lg" href="?pagina=matematica">Matematica</a>
    </div>
    <div class="item flex-item-1">
        <a class="btn btn-primary btn-lg" href="">Historia</a>
    </div>
    <div class="item flex-item-1">
        <a class="btn btn-primary btn-lg" href="">Quimica</a>
    </div>
</section>
<section class="container flex">
    <div class="item flex-item-1">
        <a class="btn btn-primary btn-lg" href="">Fisica</a>
    </div>
    <div class="item flex-item-1">
        <a class="btn btn-primary btn-lg" href="">Geografia</a>
    </div>
    <div class="item flex-item-1">
        <a class="btn btn-primary btn-lg" href="">Biologia</a>
    </div>
    <div class="item flex-item-1">
        <a class="btn btn-primary btn-lg" href="">Filosofia</a>
    </div>
</section>
<section class="container flex">
    <div class="item flex-item-1">
        <a class="btn btn-primary btn-lg" href="">
            Artes</a>
    </div>
    <div class="item flex-item-1">
        <a class="btn btn-primary btn-lg" href="">Sociologia</a>
    </div>
    <div class="item flex-item-1">
        <a class="btn btn-primary btn-lg" href="">Redação</a>
    </div>
    <div class="item flex-item-1">
        <a class="btn btn-primary btn-lg" href="">..........</a>
    </div>
</section>
</div>

