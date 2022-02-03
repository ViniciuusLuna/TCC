<?php

    include_once("dao/includes.php");

?>

<div id="body">

<?php
                if(isset($_GET['pagina'])){
                    $do = ($_GET['pagina']);
                } else {
                    $do = "inicio";
                }

                if(file_exists("view/". $do . ".php")){
                    include("view/". $do . ".php");
                } elseif(file_exists("view/logado/". $do . ".php")) {
                    include("view/logado/". $do . ".php");
                }else {
                    print "Pagina nao encontrada";
                }
                
                
            ?>

</div>


<?php

            include_once('view/rodape.php')
?>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

</body>
</html>