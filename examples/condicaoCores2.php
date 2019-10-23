<?php
include '../conexaoBDpdoPN.php';

$consultaA = $pdo->query("SELECT * FROM recompensa WHERE nomeReompensa = '".$_SESSION['temaAplicada']."'");

while ($linhaA = $consultaA->fetch(PDO::FETCH_ASSOC)) {
    $idCor = $linhaA['propriedadeRecompensa'];
    $cor = 'background-color: '.$idCor.';';
}
?>
