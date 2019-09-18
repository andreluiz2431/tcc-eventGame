<?php
include 'class_usuario.php';
session_start();
if(isset($_SESSION['nomeUsuario'])){
    $idusuario = $_SESSION['idUsuario'];
}else{
    header("location:index.php");
}


include "class_missao.php";

$missao = new Missao();
?>
<html>
    <head>
        <title>Cadastro de Evento - EventGame</title>
        <meta charset="utf-8">
        <!--<link rel="stylesheet" href="style_cadastro_evento.css">-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>


        <form role="form" class="box" method="POST" action="cadastro_evento.php">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6" style="margin-top: 5%;input{margin: 2%; width: 100%;}">
                        <h3>
                            Cadastro de evento
                        </h3>
                        <div class="tabbable" id="tabs-297093">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active show" href="#tab1" data-toggle="tab">Evento</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab2" data-toggle="tab">Missão</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab3" data-toggle="tab">Recompensa</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <input type="text" name="titulo" placeholder="Título do Evento">
                                    <p>Data de inicio do evento:</p>
                                    <input type="date" name="data_inicio" placeholder="Data do inicio do evento">
                                    <p>Data de fim do evento:</p>
                                    <input type="date" name="data_fim" placeholder="Data do fim do evento">
                                    <p>Hora de inicio do evento:</p>
                                    <input type="time" name="hora_inicio" placeholder="Hora de inicio do evento">
                                    <p>Hora de encerramento do evento:</p>
                                    <input type="time" name="hora_fim" placeholder="Hora de fim do evento">
                                    <input type="text" name="local" placeholder="Local do evento">
                                    <input type="text" name="cidade" placeholder="Cidade em que ocorrerá evento">
                                    <input type="text" name="estado" placeholder="Estado em que ocorrerá evento">
                                    <input type="text" name="pais" placeholder="País em que ocorrerá evento">

                                    <!--Usar o SELECT!!!!!!!-->
                                    <input type="text" name="area_academica" placeholder="Área academica do evento">

                                    <textarea name="sobre_evento" placeholder="Fale sobre o evento"></textarea>

                                    <a class="nav-link" href="#tab2" data-toggle="tab">Próximo</a>
                                </div>


                                <div class="tab-pane" id="tab2">
                                    <br>
                                    <input type="text" name="tituloMissao" placeholder="Título da Missão"><br>
                                    <textarea name="sobreMissao" placeholder="Fale sobre a Missão"></textarea>
                                    <a class="nav-link" href="#tab3" data-toggle="tab">Próximo</a>
                                </div>


                                <div class="tab-pane" id="tab3">
                                    <br>
                                    <p>Selecione uma recompensa para o usuário</p>
                                    <select name="recompensa">
                                        <?php $missao->recompensas_cadastradas(); ?>
                                        <option value="3">100 pontos</option>
                                    </select>
                                    <input type="submit" style="margin-top: 5%;" class="btn btn-success btn-block" value="Concluir">
                                </div>
                            </div>
                        </div> 


                        <a href="pagina_eventos.php" style="float: right;">Cancelar?</a>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
        </form>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
<?php
if(!empty($_POST["titulo"])){

    include "class_evento.php";

    $evento = new Evento();

    $evento->titulo = $_POST["titulo"];
    $evento->idusuario = $idusuario; // colocar o id do usuario logado
    $evento->data_inicio = $_POST["data_inicio"];
    $evento->data_fim = $_POST["data_fim"];
    $evento->hora_inicio = $_POST["hora_inicio"];
    $evento->hora_fim = $_POST["hora_fim"];
    $evento->local = $_POST["local"];
    $evento->cidade = $_POST["cidade"];
    $evento->estado = $_POST["estado"];
    $evento->pais = $_POST["pais"];
    $evento->area_academica = $_POST["area_academica"];
    $evento->sobre_evento = $_POST["sobre_evento"];

    $idEvento = $evento->inserir();


    $missao->titulo = $_POST['tituloMissao'];
    $missao->sobre = $_POST['sobreMissao'];
    $missao->recompensa = $_POST['recompensa'];
    $missao->idevento = $evento->id;

    $idMissao = $missao->inserir();

    $missao->inserir_intermediaria($idMissao, $idEvento);

}
?>