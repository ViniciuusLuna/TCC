<!-- <div>
    <form action="" method="POST">
        <div>
            <input type="email" name="email" placeholder="Digite seu email: ">
        </div>

        <div>
            <input type="password" name="senha" placeholder="Digite sua senha: ">
        </div>

        <div>
            <input type="submit" name="submit" value="Entrar">
        </div>
    </form>
</div> -->



<?php

// session_start();


// if(!empty($_POST['email']) && !empty($_POST['email'])){

  
//     $email = $_POST['email'];
//     $senha = $_POST['senha'];

//     $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
    

//     $result = $conn -> query($sql);

//     if(mysqli_num_rows($result) < 1){
//         header('location: ?pagina=login');
//     }else{

//         $_SESSION['email'] = $email;
//         $_SESSION['senha'] = $senha;
//         header('location: ?pagina=inicioLogado');

//     }

// }

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">



<div class="container header" style="margin-top: 200px; width: 600px;">
  
<!-- Default form login -->
 
<form class="text-center border border-light p-5" action="" method="POST">

    <p class="h4 mb-4">Faça Login</p>

    <!-- Email -->
    <input type="text"  class="form-control mb-4" placeholder="Usuario" name="usuario">

    <!-- Password -->
    <input type="password"  class="form-control mb-4" placeholder="Password" name="senha">

    <div class="d-flex justify-content-around">
        <div>
            <!-- Remember me -->
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                <label class="custom-control-label" for="defaultLoginFormRemember">lembre-me</label>
            </div>
        </div>
        <div>
            <!-- Forgot password -->
            <a href="">Esqueceu a senha?</a>
        </div>
    </div>

    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" style="background-color: 496A82;" type="submit">Entrar</button>

    <!-- Register -->
    <p>Não tem conta?
        <a href="?pagina=cadastro">Cadastrar-se</a>
    </p>


</form>
<!-- Default form login -->
  
  </div>
  

<?php

session_start();

// print_r($_REQUEST);

if(!empty($_POST['usuario']) && !empty($_POST['senha'])){

    //acessa
    
    $usuario = $_POST['usuario'];
    $senha = sha1($_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' and senha = '$senha'";
    

    $result = $conn -> query($sql);

    if(mysqli_num_rows($result) < 1){
        header('location: ?pagina=login');
    }else{

        $sql = "SELECT * FROM usuarios";

        $_SESSION['usuario'] = $usuario;
        $_SESSION['senha'] = $senha;
        $_SESSION['nome'];
        header('location: ?pagina=inicioLogado');

    }

}

?>



