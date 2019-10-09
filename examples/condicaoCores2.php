<?php
if($_SESSION['temaAplicada'] == 'Red'){
    $cor = 'background-color: #f44336;';
}elseif($_SESSION['temaAplicada'] == 'Purple'){
    $cor = 'background-color: #9368E9;';
}elseif($_SESSION['temaAplicada'] == 'Blue'){
    $cor = 'background-color: #00bcd4;';
}elseif($_SESSION['temaAplicada'] == 'Green'){
    $cor = 'background-color: #4caf50;';
}elseif($_SESSION['temaAplicada'] == 'Orange'){
    $cor = 'background-color: #ff9800;';
}elseif($_SESSION['temaAplicada'] == 'Pink'){
    $cor = 'background-color: #e91e63;';
}
?>
