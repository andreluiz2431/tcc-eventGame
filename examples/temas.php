<?php
if(!empty($_POST['nomeTema'])){
    $nomeTema = $_POST['nomeTema'];
    $tema = $_POST['corTema'];

    echo 'Nome: '.$nomeTema.' Tema: '.$tema;
}
?>
