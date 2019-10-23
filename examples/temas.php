<?php
if(!empty($_POST['nomeTema'])){
    $nomeTema = $_POST['nomeTema'];
    $tema = $_POST['corTema'];
    $custo = $_POST['custoTema'];

    echo 'Nome: '.$nomeTema.' Tema: '.$tema.' Custo: '.$custo;
}
?>
