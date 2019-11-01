<?php
$skin = $_POST['skinAplicar'];
session_start();
$idUsuario = $_SESSION['idUsuario'];

include 'class_recompensas.php';

$aplicarSkin = new Recompensa();

$aplicarSkin->aplicarSkin($idUsuario, $skin);
?>
