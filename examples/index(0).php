<?php
session_start();
?>
<html>
    <head>
        <title>EventGame</title>
        <link rel="stylesheet" href="style_inicioEcadastro.css">

    </head>
    <body>
    <div class="efeito">
    <form class="box" method="post" action="index.php">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <h1 class="h1" title="Sistema de gerenciamento de eventos academicos Gamificado">EventGame</h1>
        <label>Realize o login</label>
        <input type="text" name="email" title="Digite seu E-mail" placeholder="E-mail">
        <input type="password" name="senha" title="Digite sua senha" placeholder="Senha">
        <input type="submit" value="Login" title="Concluir">
        <a href="cadastro.php" style="margin-left: 270px;" title="Crie sua conta agora">Criar conta?</a>
    </form>
    </div>
    </body>
</html>
<?php
include 'class_usuario.php';

if(!empty($_POST["email"])){
$usuario = new Usuario();
$usuario->login();
}
?>