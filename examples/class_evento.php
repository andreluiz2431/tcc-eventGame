<?php
class Evento{
    public $pdo;

    public function conectarBD(){
        include '../conexaoBDpdoPOO.php';
    }

    public function consultarBusca($busca){
        $this->conectarBD();

        $consultaBusca = $this->pdo->query("SELECT * FROM evento WHERE tituloEvento LIKE '%$busca%'");

        echo '<label style="margin-left: 5%">Resultado de busca</label><div class="row"  id="rowEvent">';

        while ($linhaBusca = $consultaBusca->fetch(PDO::FETCH_ASSOC)) {
            $results = $linhaBusca['idEvento'];
            $tituloEvento = $linhaBusca["tituloEvento"];
            $sobreEvento = $linhaBusca["sobreEvento"];
            $dataInicioEvento = $linhaBusca["dataInicioEvento"];
            $dataFimEvento = $linhaBusca["dataFimEvento"];
            $horaInicioEvento = $linhaBusca["horaInicioEvento"];
            $horaFimEvento = $linhaBusca["horaFimEvento"];
            $local = $linhaBusca["localEvento"];
            $cidade = $linhaBusca["cidadeEvento"];
            $estado = $linhaBusca["estadoEvento"];
            $pais = $linhaBusca["paisEvento"];
            $area_academica = $linhaBusca["areaAcademicaEvento"];

            $this->conectarBD();

            $consultaMissaoEvento = $this->pdo->query("SELECT * FROM missaoevento WHERE idEvento = '$results'");

            while ($linhaMissaoEvento = $consultaMissaoEvento->fetch(PDO::FETCH_ASSOC)) {
                $idMissao = $linhaMissaoEvento['idMissao'];
            }

            $this->conectarBD();

            $consultaMissao = $this->pdo->query("SELECT * FROM missao WHERE idMissao = '$idMissao'");

            while ($linhaMissao = $consultaMissao->fetch(PDO::FETCH_ASSOC)) {
                $tituloMissao = $linhaMissao['tituloMissao'];
                $sobreMissao = $linhaMissao['sobreMissao'];
                $idRecompensa = $linhaMissao['idRecomensa'];
            }

            $this->conectarBD();

            $consultaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = '$idRecompensa'");

            while ($linhaRecompensa = $consultaRecompensa->fetch(PDO::FETCH_ASSOC)) {
                $nomeRecompensa = $linhaRecompensa['nomeReompensa'];
                $tipoRecompensa = $linhaRecompensa['tipoRecompensa'];
            }

            echo '<div class="col-md-3" id="titulo2">
                <div class="card" style="width: 18rem;height: 400px; overflow: auto;">
                <div id="corTitulo">
                <label class="card-title" style="margin-left:7%; margin-top:5%;margin-right:7%"><b>'.$tituloEvento.'</b></label>
                </div>
                <div class="card-body" style="overflow: auto;">
                <p class="card-text"><b>Sobre:</b> '.$sobreEvento.'</p>
                    </div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Data de inicio: '.date('d/m/Y', strtotime($dataInicioEvento)).'</li>
                        <li class="list-group-item">Hora de inicio: '.date("H:i", strtotime($horaInicioEvento)).'</li>
                            <li class="list-group-item">Cidade: '.$cidade.'</li>
                                </ul>
                                <div class="card-body">
                                <a id="modal-'.$results.'" href="#modal-container-'.$results.'" role="button" class="btn" data-toggle="modal">Detalhes</a>
                                <div class="modal fade" id="modal-container-'.$results.'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">
                                Evento '.$tituloEvento.'
                                </h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">×</span>
                                </button>
                                </div>
                                <div class="modal-body" style="height: 400px; overflow: auto;">
                                Sobre<br> <label style="padding-left: 25px;"></label>'.$sobreEvento.'

                                <ul class="list-group list-group-flush">
                                <li class="list-group-item">Data de inicio: '.date('d/m/Y', strtotime($dataInicioEvento)).' até '.date('d/m/Y', strtotime($dataFimEvento)).'</li>
                                    <li class="list-group-item">Hora de inicio: '.date("H:i", strtotime($horaInicioEvento)).'</li>
                                        <li class="list-group-item">Hora de fim: '.date("H:i", strtotime($horaFimEvento)).'</li>
                                            <li class="list-group-item">Local: '.$local.'</li>
                                                <li class="list-group-item">Onde: '.$cidade.', '.$estado.', '.$pais.'</li>
                                                    <li class="list-group-item">Referente: '.$area_academica.'</li>
                                                        <hr>
                                                        <li class="list-group-item">Missão: '.$tituloMissao.'</li>
                                                            <li class="list-group-item">Sobre: '.$sobreMissao.'</li>
                                                                <li class="list-group-item">Recompensa: '.$tipoRecompensa.' '.$nomeRecompensa.'</li>
                                                                    </ul>
                                                                    <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    <div style="display: block">
                                                                    <form method="POST" action"pagina_eventos.php">
                                                                    <input type="hidden" name="idEventoInsc" value="'.$results.'">
                                                                    <select name="tipoInsc" style="float: left; margin-right: 120px;">
                                                                    <option value="Ouvinte">Ouvinte</option>
                                                                    <option value="Palestrante">Palestrante</option>
                                                                    <option value="Técnico">Técnico</option>
                                                                    </select>
                                                                    <input type="submit" name="btnInsc" class="btn btn-primary" style="display: block" value="Inscreva-se">
                                                                    </form>
                                                                    </div>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                    Fechar
                                                                    </button>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>';

            echo '</div>';
        }
    }

    public function inserir($titulo, $idusuario, $data_inicio, $data_fim, $hora_inicio, $hora_fim, $local, $cidade, $estado, $pais, $area_academica, $sobre_evento){

        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare("INSERT INTO evento (tituloEvento, idUsuario, dataInicioEvento, dataFimEvento, horaInicioEvento, horaFimEvento, localEvento, cidadeEvento, estadoEvento, paisEvento, areaAcademicaEvento, sobreEvento) VALUES(:tituloEvento, :idUsuario, :dataInicioEvento, :dataFimEvento, :horaInicioEvento, :horaFimEvento, :localEvento, :cidadeEvento, :estadoEvento, :paisEvento, :areaAcademicaEvento, :sobreEvento)");

            $stmt->execute(array(
                ':tituloEvento' => $titulo,
                ':idUsuario' => $idusuario,
                ':dataInicioEvento' => "$data_inicio",
                ':dataFimEvento' => "$data_fim",
                ':horaInicioEvento' => "$hora_inicio",
                ':horaFimEvento' => "$hora_fim",
                ':localEvento' => "$local",
                ':cidadeEvento' => "$cidade",
                ':estadoEvento' => "$estado",
                ':paisEvento' => "$pais",
                ':areaAcademicaEvento' => "$area_academica",
                ':sobreEvento' => "$sobre_evento"
            ));

            //var_dump($stmt->queryString);
            //$stmt->debugDumpParams();
            //exit();

            return $this->pdo->lastInsertId();
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return -1;
        }

    }

    public function consultarPorUsuario($idanfitriao){
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM evento WHERE idUsuario = '$idanfitriao'");

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

            $results = $linha['idEvento'];
            $idusuario = $linha['idUsuario'];
            $tituloEvento = $linha["tituloEvento"];
            $sobreEvento = $linha["sobreEvento"];
            $dataInicioEvento = $linha["dataInicioEvento"];
            $dataFimEvento = $linha["dataFimEvento"];
            $horaInicioEvento = $linha["horaInicioEvento"];
            $horaFimEvento = $linha["horaFimEvento"];
            $local = $linha["localEvento"];
            $cidade = $linha["cidadeEvento"];
            $estado = $linha["estadoEvento"];
            $pais = $linha["paisEvento"];
            $area_academica = $linha["areaAcademicaEvento"];

            // consulta de quantas inscriçoes
            $this->conectarBD();

            $quantInsc = $this->pdo->query("SELECT idUsuario FROM inscricao WHERE idEvento = $results")->rowCount();

            $this->conectarBD();

            $consultaMissaoEvento = $this->pdo->query("SELECT * FROM missaoevento WHERE idEvento = $results");

            $idMissao = 0;
            while ($linhaMissaoEvento = $consultaMissaoEvento->fetch(PDO::FETCH_ASSOC)) {
                $idMissao = $linhaMissaoEvento['idMissao'];
            }

            // consulta missao
            $this->conectarBD();

            $consultaMissao = $this->pdo->query("SELECT * FROM missao WHERE idMissao = '$idMissao'");
            $tituloMissao = 0;
            $sobreMissao = 0;
            $idRecompensa = 0;
            while ($linhaMissao = $consultaMissao->fetch(PDO::FETCH_ASSOC)) {
                $tituloMissao = $linhaMissao['tituloMissao'];
                $sobreMissao = $linhaMissao['sobreMissao'];
                $idRecompensa = $linhaMissao['idRecomensa'];
            }

            // conmsulta recompensa
            $this->conectarBD();

            $consultaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = '$idRecompensa'");
            $nomeRecompensa = 0;
            $tipoRecompensa = 0;
            while ($linhaRecompensa = $consultaRecompensa->fetch(PDO::FETCH_ASSOC)) {
                $nomeRecompensa = $linhaRecompensa['nomeReompensa'];
                $tipoRecompensa = $linhaRecompensa['tipoRecompensa'];
            }
include 'condicaoCores2.php';
            echo '

                <div class="tab-pane active" id="'.$results.'">
                <div class="card">
                <div class="card-header card-header-primary" style="'.$cor.'">
                <h4 class="card-title">'.$tituloEvento.'</h4>
                <p class="card-category">'.$dataInicioEvento." ".$horaInicioEvento.'</p>
                </div>
                <div class="card-body">
                <div class="table-responsive table-upgrade">
                <table class="table">
                <thead>
                </thead>
                <tbody>
                <tr>
                <td>Anfitrião</td>
                <td class="text-center">'.$_SESSION['nomeUsuario'].'</td>
                </tr>
                <tr>
                <td>Datas</td>
                <td class="text-center">'.date('d/m/Y', strtotime($dataInicioEvento)).' até '.date('d/m/Y', strtotime($dataFimEvento)).'</td>
                </tr>
                <tr>
                <td>Horários</td>
                <td class="text-center">'.date("H:i", strtotime($horaInicioEvento)).' ás '.date("H:i", strtotime($horaFimEvento)).'</td>
                </tr>
                <tr>
                <td>Local</td>
                <td class="text-center">'.$local.'</td>
                </tr>
                <tr>
                <td>Onde</td>
                <td class="text-center">'.$cidade.', '.$estado.', '.$pais.'</td>
                </tr>
                <tr>
                <td>Área academica</td>
                <td class="text-center">'.$area_academica.'</td>
                </tr>
                <tr>
                <td>Sobre</td>
                <td class="text-center"><a id="modal-'.$results.'" href="#modal-container-'.$results.'" role="button" data-toggle="modal">Vizualizar</a>

                <div class="modal fade" id="modal-container-'.$results.'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">
                Sobre o evento '.$tituloEvento.'
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body" style="height: 200px; overflow: auto;">
                <label style="padding-left: 25px;"></label>'.$sobreEvento.'
                <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Fechar
                </button>
                </div>
                </div>
                </div>

                </td>
                </tr>
                <tr>

                <td>Inscritos</td>
                <td class="text-center">'.$quantInsc.'</td>
                </tr>
                <tr>
                <td></td>
                <td></td>
                </tr>
                <tr>
                <td>Missão</td>
                <td class="text-center">'.$tituloMissao.' '.$sobreMissao.'</td>
                </tr>
                <tr>
                <td>Recompensa</td>
                <td class="text-center">'.$tipoRecompensa.' '.$nomeRecompensa.'</td>
                </tr>
                <tr>
                <td><a class="nav-link" href="#'.++$results.'">Próximo</a></td>
                <td class="text-center">
                <a  id="modal-XX'.$results.'" href="#modal-container-XX'.$results.'" role="button" data-toggle="modal" style="float:right;'.$cor.'" class="btn btn-round btn-fill btn-info">Gerenciar</a>



                <div class="modal fade" id="modal-container-XX'.$results.'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">
                Gerenciador de evento '.$tituloEvento.'
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body" style="height: 200px; overflow: auto;">
                <label style="padding-left: 25px;"></label>

                <br>
                <a href="#" class="btn btn-round btn-fill btn-default" style="width: 50%;'.$cor.'">Excluir evento</a> <!-- não funciona -->
                <br>
                <a href="#" class="btn btn-round btn-fill btn-default" style="width: 50%;'.$cor.'">Editar dados</a> <!-- não funciona -->
                <br>
                <a href="#" class="btn btn-round btn-fill btn-default" style="width: 50%;'.$cor.'">Gerenciar inscritos</a> <!-- não funciona -->
                <br>

                <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Fechar
                </button>
                </div>
                </div>
                </div>



                </td>
                </tr>

                </tbody>
                </table>
                </div>
                </div>
                </div>

                </div>

                ';
        }
    }

    public function consultar(){


        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM evento");
        echo '<div class="row"  id="rowEvent">';

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $results = $linha['idEvento'];
            $tituloEvento = $linha["tituloEvento"];
            $sobreEvento = $linha["sobreEvento"];
            $dataInicioEvento = $linha["dataInicioEvento"];
            $dataFimEvento = $linha["dataFimEvento"];
            $horaInicioEvento = $linha["horaInicioEvento"];
            $horaFimEvento = $linha["horaFimEvento"];
            $local = $linha["localEvento"];
            $cidade = $linha["cidadeEvento"];
            $estado = $linha["estadoEvento"];
            $pais = $linha["paisEvento"];
            $area_academica = $linha["areaAcademicaEvento"];

            $this->conectarBD();

            $consultaMissaoEvento = $this->pdo->query("SELECT * FROM missaoevento WHERE idEvento = '$results'");

            while ($linhaMissaoEvento = $consultaMissaoEvento->fetch(PDO::FETCH_ASSOC)) {
                $idMissao = $linhaMissaoEvento['idMissao'];
            }

            $this->conectarBD();

            $consultaMissao = $this->pdo->query("SELECT * FROM missao WHERE idMissao = '$idMissao'");

            while ($linhaMissao = $consultaMissao->fetch(PDO::FETCH_ASSOC)) {
                $tituloMissao = $linhaMissao['tituloMissao'];
                $sobreMissao = $linhaMissao['sobreMissao'];
                $idRecompensa = $linhaMissao['idRecomensa'];
            }

            $this->conectarBD();

            $consultaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = '$idRecompensa'");

            while ($linhaRecompensa = $consultaRecompensa->fetch(PDO::FETCH_ASSOC)) {
                $nomeRecompensa = $linhaRecompensa['nomeReompensa'];
                $tipoRecompensa = $linhaRecompensa['tipoRecompensa'];
            }
include 'condicaoCores2.php';
            echo '<div class="col-md-3" id="titulo2">
                <div class="card" style="width: 18rem;height: 400px; overflow: auto;">
                <div id="corTitulo">
                <label class="card-title" style="margin-left:7%; margin-top:5%;margin-right:7%"><b>'.$tituloEvento.'</b></label>
                </div>
                <div class="card-body" style="overflow: auto;">
                <p class="card-text"><b>Sobre:</b> '.$sobreEvento.'</p>
                    </div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Data de inicio: '.date('d/m/Y', strtotime($dataInicioEvento)).'</li>
                        <li class="list-group-item">Hora de inicio: '.date("H:i", strtotime($horaInicioEvento)).'</li>
                            <li class="list-group-item">Cidade: '.$cidade.'</li>
                                </ul>
                                <div class="card-body">
                                <a id="modal-'.$results.'" href="#modal-container-'.$results.'" role="button" class="btn" data-toggle="modal">Detalhes</a>
                                <div class="modal fade" id="modal-container-'.$results.'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">
                                Evento '.$tituloEvento.'
                                </h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">×</span>
                                </button>
                                </div>
                                <div class="modal-body" style="height: 400px; overflow: auto;">
                                Sobre<br> <label style="padding-left: 25px;"></label>'.$sobreEvento.'

                                <ul class="list-group list-group-flush">
                                <li class="list-group-item">Data de inicio: '.date('d/m/Y', strtotime($dataInicioEvento)).' até '.date('d/m/Y', strtotime($dataFimEvento)).'</li>
                                    <li class="list-group-item">Hora de inicio: '.date("H:i", strtotime($horaInicioEvento)).'</li>
                                        <li class="list-group-item">Hora de fim: '.date("H:i", strtotime($horaFimEvento)).'</li>
                                            <li class="list-group-item">Local: '.$local.'</li>
                                                <li class="list-group-item">Onde: '.$cidade.', '.$estado.', '.$pais.'</li>
                                                    <li class="list-group-item">Referente: '.$area_academica.'</li>
                                                        <hr>
                                                        <li class="list-group-item">Missão: '.$tituloMissao.'</li>
                                                            <li class="list-group-item">Sobre: '.$sobreMissao.'</li>
                                                                <li class="list-group-item">Recompensa: '.$tipoRecompensa.' '.$nomeRecompensa.'</li>
                                                                    </ul>
                                                                    <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    <div style="display: block">
                                                                    <form method="POST" action"pagina_eventos.php">
                                                                    <input type="hidden" name="idEventoInsc" value="'.$results.'">
                                                                    <select name="tipoInsc" style="float: left; margin-right: 120px;">
                                                                    <option value="Ouvinte">Ouvinte</option>
                                                                    <option value="Palestrante">Palestrante</option>
                                                                    <option value="Técnico">Técnico</option>
                                                                    </select>
                                                                    <input type="submit" name="btnInsc" class="btn btn-primary" style="display: block;'.$cor.'" value="Inscreva-se">
                                                                    </form>
                                                                    </div>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                    Fechar
                                                                    </button>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>';

            echo '</div>';
        }
    }

    public function consultarInscricao($usuario){
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM inscricao WHERE idUsuario = '$usuario'");

        echo "<div class='row'>";

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

            $results = $linha['idEvento'];
            $idusuario = $linha['idUsuario'];
            $tipoInscricao = $linha["tipoInscricao"];
            $valorInscricao = $linha["valorInscricao"];
            $pagoInscricao = $linha["pagoInscricao"];

            $this->conectarBD();

            $consultaNomeEvento = $this->pdo->query("SELECT * FROM evento WHERE idEvento = '$results'");

            while ($linhaNomeEvento = $consultaNomeEvento->fetch(PDO::FETCH_ASSOC)) {
                $nomeEvento = $linhaNomeEvento['tituloEvento'];
                $dataEvento = $linhaNomeEvento['dataInicioEvento'];
                $horaEvento = $linhaNomeEvento['horaInicioEvento'];
                $cidade = $linhaNomeEvento['cidadeEvento'];
            }

            if($pagoInscricao == 1){
                $situacao = 'Pago';
            } else {
                $situacao = 'Pendente';
            }

            if($valorInscricao == 0){
                $valorInscricao = 'Free';
            }else{
                $valorInscricao = 'R$ '.$valorInscricao;
            }
include 'condicaoCores2.php';
            echo "

            <div class='col-lg-4 col-md-6 col-sm-6'>
              <div class='card card-stats'>
               <a href='#' title='".$situacao."'>
                                                                    <div class='card-header card-header-primary card-header-icon'>
                                                                    <div class='card-icon' style='".$cor."'>
                                                                    <i class='material-icons'>amp_stories</i>
                                                                    </div>
                                                                    <p class='card-category'>".$nomeEvento."</p>
                                                                    <h3 class='card-title'>".$valorInscricao."</h3>
                                                                    </div>
                                                                    <div class='card-footer'>
                                                                    <div class='stats'>
                                                                    <i class='material-icons'>date_range</i> ".date("H:i", strtotime($horaEvento))." de ".date('d/m/Y', strtotime($dataEvento))." ".$cidade."
                                                                        </div>
                                                                        <label style='margin-left: 10%'>".$tipoInscricao."</label>
                                                                        </div>
                                                                        </a>
                                                                        </div>
                                                                        </div>

                                                                        ";
        }

        echo "</div>";
    }

    public function inscricao($idEvento, $tipoInscricao){
        // verificar se ja possui inscricao
        $this->conectarBD();

        $consultaInscricaoExistente = $this->pdo->query("SELECT * FROM inscricao WHERE (idEvento = '$idEvento') AND (idUsuario = ".$_SESSION['idUsuario'].")");

        $idEventoI = 0;
        $idUsuarioI = 0;
        while ($linhaInscricaoExistente = $consultaInscricaoExistente->fetch(PDO::FETCH_ASSOC)) {
            $idEventoI = $linhaInscricaoExistente['idEvento'];
            $idUsuarioI = $linhaInscricaoExistente['idUsuario'];
        }

        if(($idEventoI == 0) && ($idUsuarioI == 0)){
            $valorInscricao = 0;
            $pagoInscricao = 0;

            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare("INSERT INTO inscricao(idUsuario, idEvento, tipoInscricao, valorInscricao, pagoInscricao) VALUES (:idUsuario, :idEvento, :tipoInscricao, :valorInscricao, :pagoInscricao)");
                $stmt->execute(array(
                    ':idUsuario' => $_SESSION['idUsuario'],
                    ':idEvento' => $idEvento, // fverificar
                    ':tipoInscricao' => $tipoInscricao, // falta fazer
                    ':valorInscricao' => $valorInscricao, // falta fazer
                    ':pagoInscricao' => $pagoInscricao // falta fazer
                ));

                // pegar id da missao pelo id do evento
                $this->conectarBD();

                $consultaIdMissao = $this->pdo->query("SELECT * FROM missaoevento WHERE idEvento = '$idEvento'");

                while ($linhaIdMissao = $consultaIdMissao->fetch(PDO::FETCH_ASSOC)) {
                    $idMissao = $linhaIdMissao['idMissao'];
                }

                // inserir progresso missao inicial
                try {
                    $this->conectarBD();

                    $stmt = $this->pdo->prepare("INSERT INTO progressomissao (idUsuario, idMissao, progressoMissao) VALUES (:idUsuario, :idMissao, :progressoMissao)");
                    $stmt->execute(array(
                        ':idUsuario' => $_SESSION['idUsuario'],
                        ':idMissao' => $idMissao,
                        ':progressoMissao' => "0"
                    ));

                } catch(PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                    return -1;
                }

                return 'inscrito';
            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
                return -1;
            }
        }else{
            echo"<script language='javascript' type='text/javascript'> alert('Você já estava inscrito!');</script>";
        }
    }
}
?>
