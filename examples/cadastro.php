<html>
    <head>
        <title>Cadastro - EventGame</title>
        <link rel="stylesheet" href="style_inicioEcadastro.css">
    </head>
    <body>
    <div class="efeito">
    <form class="box" method="POST" action="cadastro.php">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <h1 class="h1">EventGame</h1>
        <label>Realize o cadastro</label>
                <input type="text" name="nome" title="Seu nome completo" placeholder="Nome de usuário">
        <input type="text" name="email" title="Digite seu E-mail" placeholder="Digite seu E-mail">
        <input type="password" name="senha" title="Digite sua senha" placeholder="Digite sua senha">
        <input type="password" name="senha2" title="Digite sua senha novamente" placeholder="Verifique a senha">
                <input type="submit" value="Criar" title="Cadastrar">
        <a href="index.php" style="margin-left: 270px;" title="Fazer login">Já tem conta?</a>
    </form>
    </div>
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