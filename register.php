<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registrar</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container" style="margin-top: 10%;" align="center">
    
    <div class="col-xl-5 col-lg-8 col-md-9" style="margin-top:8%;">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row justify-content-center">
          <div></div>
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Cria sua conta!</h1>
              </div>
              <form class="user" method="POST" action="register.php">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" title="Seu nome completo" placeholder="Seu nome completo" name="nome">
                <div class="form-group" style="margin-top: 3.5%;">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" title="Digite seu E-mail" placeholder="Digite seu E-mail" name="email">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" title="Digite sua senha" placeholder="Digite sua senha" name="senha">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" title="Digite sua senha novamente" placeholder="Verifique a senha" name="senha2">
                  </div>
                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Cadastrar" title="Fazer login">
                  
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="index.php">Já possui uma conta? Login!</a>
              </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php
if(!empty($_POST["nome"])){
    
if($_POST["senha"] == $_POST["senha2"]){
    
include "class_usuario.php";

$usuario = new Usuario();

$usuario->nome = $_POST["nome"];
$usuario->email = $_POST["email"];
$usuario->senha = md5($_POST["senha"]);

$usuario->inserir();
}
}
?>