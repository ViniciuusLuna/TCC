<?php

    if(isset($_POST['submit']))
    {
        // print_r('Nome: ' . $_POST['nome']);
        // print_r('<br>');
        // print_r('Email: ' . $_POST['email']);
        // print_r('<br>');
        // print_r('Telefone: ' . $_POST['telefone']);
        // print_r('<br>');
        // print_r('Sexo: ' . $_POST['genero']);
        // print_r('<br>');
        // print_r('Data de nascimento: ' . $_POST['data_nascimento']);
        // print_r('<br>');
        // print_r('Cidade: ' . $_POST['cidade']);
        // print_r('<br>');
        // print_r('Estado: ' . $_POST['estado']);
        // print_r('<br>');
        // print_r('Endereço: ' . $_POST['endereco']);

        include_once('config.php');

		$nome = $_POST['nome'];
		$usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $senha = sha1($_POST['senha']);

        $result = mysqli_query($conn, "INSERT INTO usuarios(id, nome, usuario, senha, email, nivel) 
        VALUES (null, '$nome','$usuario','$senha','$email', 1)");

        header('Location: ?pagina=login');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

</head>
<body>

    <div class="container header" style="margin-top: 150px; width: 600px;">
        <form action="" method="POST" class="border border-light p-5">
            
        <p class="h4 mb-4">Faça seu Cadastro</p>

                    <input type="text" name="nome" id="nome" placeholder="Nome"  class="form-control mb-4" required>
                
	

                    <input type="text" name="usuario" id="usuario" placeholder="Usuario"  class="form-control mb-4" required>
        
             
 

                    <input type="email" name="email" id="email" placeholder="Email"  class="form-control mb-4" required>
                
         
    
               
                    <input type="password" name="senha" id="senha" placeholder="Senha"  class="form-control mb-4" required>
        
               
       
                    <input style="background-color: 496A82;" type="submit" class="btn btn-info btn-block my-4" name="submit" id="submit">

                    <p>Já tem conta?
        <a href="?pagina=login">Faça Login</a>
    </p>
      
        </form>
    </div>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">


<!--
<div class="container header" style="margin-top: 150px; width: 600px;">
  
 
<form class="text-center border border-light p-5" action="" method="POST">

    <p class="h4 mb-4">Faça seu Cadastro</p>

    <input type="text" name="nome" id="nome" class="form-control mb-4" placeholder="Nome" required>

    <input type="text" name="usuario" id="usuario" class="form-control mb-4" placeholder="Usuario" required>

  
    <input type="text"  class="form-control mb-4" placeholder="E-mail" name="email">

 
    <input type="password"  class="form-control mb-4" placeholder="Senha" name="senha">



  
    <input style="background-color: 496A82;" type="submit" class="btn btn-info btn-block my-4" name="submit" id="submit">

    <p>Já tem conta?
        <a href="?pagina=login">Faça Login</a>
    </p>


</form>

  
  </div> -->
</body>
</html>