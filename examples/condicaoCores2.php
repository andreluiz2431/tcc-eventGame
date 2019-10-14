<?php
if($_SESSION['temaAplicada'] == 'Red'){
    $idCor = '#f44336';
    $cor = 'background-color: #f44336;';
}elseif($_SESSION['temaAplicada'] == 'Purple'){
    $idCor = '#9368E9';
    $cor = 'background-color: #9368E9;';
}elseif($_SESSION['temaAplicada'] == 'Blue'){
    $idCor = '#00bcd4';
    $cor = 'background-color: #00bcd4;';
}elseif($_SESSION['temaAplicada'] == 'Green'){
    $idCor = '#4caf50';
    $cor = 'background-color: #4caf50;';
}elseif($_SESSION['temaAplicada'] == 'Orange'){
    $idCor = '#ff9800';
    $cor = 'background-color: #ff9800;';
}elseif($_SESSION['temaAplicada'] == 'Pink'){
    $idCor = '#e91e63';
    $cor = 'background-color: #e91e63;';
}
?>
