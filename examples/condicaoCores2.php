<?php
if($_SESSION['temaAplicada'] == 'Red'){
    echo 'background-color: #f44336;';
}elseif($_SESSION['temaAplicada'] == 'Purple'){
    echo 'background-color: #9368E9;';
}elseif($_SESSION['temaAplicada'] == 'Blue'){
    echo 'background-color: #00bcd4;';
}elseif($_SESSION['temaAplicada'] == 'Green'){
    echo 'background-color: #4caf50;';
}elseif($_SESSION['temaAplicada'] == 'Orange'){
    echo 'background-color: #ff9800;';
}elseif($_SESSION['temaAplicada'] == 'Pink'){
    echo 'background-color: #e91e63;';
}
?>
