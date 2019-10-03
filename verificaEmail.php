<?php
#Verifica se tem um email para pesquisa
if(isset($_POST['email'])){

    #Recebe o Email Postado
    $emailPostado = $_POST['email'];

    #Conecta banco de dados
    $con = mysqli_connect("localhost", "root", "", "id10730896_banco");
    $sql = mysqli_query($con, "SELECT * FROM usuario WHERE emailUsuario = '{$emailPostado}'") or print mysql_error();

    #Se o retorno for maior do que zero, diz que já existe um.
    if(mysqli_num_rows($sql)>0) {
        echo json_encode(array('email' => 'E-mail já existente'));
    }else {
        echo json_encode(array('email' => 'E-mail válido'));
    }
}
?>
