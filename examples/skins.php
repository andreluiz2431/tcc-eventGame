<?php
if(!empty($_POST['nomeSkin'])){
    $nomeSkin = $_POST['nomeSkin'];
    $imagem = $_POST['imagemSkin'];

    echo 'Nome: '.$nomeSkin.' Skin: <img src="'.$imagem.'" alt="imagem">';
}
?>
