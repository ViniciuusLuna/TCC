<div class="well well-sm">

    <div id="panel">
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <input
                    type="text"
                    name="titulo"
                    id="titulo"
                    placeholder="insira um titulo"
                    class="form form-control">
            </div>

            <div>
                <input
                    type="text"
                    name="postador"
                    id="postador"
                    placeholder="Nome do Usuario"
                    class="form form-control">
            </div>

            <div>
                <textarea
                    name="descricao"
                    id="descricao"
                    placeholder="Faca sua pergunta..."
                    class="form form-control"></textarea>
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


                if(empty($titulo) || empty($postador)){
                    echo "E obrigatorio ter um titulo e colocar o nome do postador.";
                }else{
                    $query = mysqli_query($conn, "INSERT INTO posts (id, titulo, descricao, data, hora, postador) VALUES (null, '$titulo', '$descricao', '$data', '$hora', '$postador')");

                if(mysqli_query($conn, $query)){
                    echo "Publicacao inserida com sucesso!";
                }
                }

                
            }

        ?>
    </div>
</div>