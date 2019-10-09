<?php
if($_SESSION['temaAplicada'] == 'Red'){
    echo 'danger';
}elseif($_SESSION['temaAplicada'] == 'Purple'){
    echo 'purple';
}elseif($_SESSION['temaAplicada'] == 'Blue'){
    echo 'azure';
}elseif($_SESSION['temaAplicada'] == 'Green'){
    echo 'green';
}elseif($_SESSION['temaAplicada'] == 'Orange'){
    echo 'orange';
}elseif($_SESSION['temaAplicada'] == 'Pink'){
    echo 'rosa';
}
?>
