<?php
class Missao{
    public $id;
    public $titulo;
    public $sobre;
    public $idevento;
    public $recompensa;

    public $pdo;

    public function conectarBD(){
        include '../conexaoBDpdoPOO.php';
    }

    public function inserir(){

        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare("INSERT INTO missao (tituloMissao, sobreMissao, idRecomensa) VALUES(:tituloMissao, :sobreMissao, :idRecomensa)");
            $stmt->execute(array(
                ':tituloMissao' => "$this->titulo",
                ':sobreMissao' => "$this->sobre",
                ':idRecomensa' => "$this->recompensa"
            ));

            return $this->pdo->lastInsertId();

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return -1;
        }
    }

    public function inserir_intermediaria($idMissao, $idEvento){
        //consulta de id de evento
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT idEvento FROM Evento;");

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $this->idevento = $linha['idEvento'];
        }

        //para intermediaria MissaoEvento
        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare("INSERT INTO missaoevento (idMissao, idEvento) VALUES(:idMissao, :idEvento)");
            $stmt->execute(array(
                ':idMissao' => $idMissao,
                ':idEvento' => $idEvento
            ));

            echo $stmt->rowCount(); 
            echo "<script language='javascript' type='text/javascript'> alert('Cadastro de evento efetuado com sucesso!');</script>";
            echo"<script>window.location.href = \"pagina_eventos.php\";</script>";
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function recompensas_cadastradas(){
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM recompensa;");

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$linha['idRecomensa']."'>".$linha['nomeReompensa']."</option>";
        }
    }

    public function ver_progresso_missoes($usuario){
        // verificar level up
        $this->levelUp($usuario);

        // consulta por progresso na missao
        $this->conectarBD();

        $idMissao = 0;
        $consultaProgressoMissao = $this->pdo->query("SELECT * FROM progressomissao WHERE idUsuario = '$usuario'");

        echo "<div class='row'>";

        while ($linhaProgressoMissao = $consultaProgressoMissao->fetch(PDO::FETCH_ASSOC)) {
            $idMissao = $linhaProgressoMissao['idMissao'];
            $progressoMissao = $linhaProgressoMissao['progressoMissao'];

            // consulta missao
            $this->conectarBD();

            $idRecompensa = 0;
            $consultaMissao = $this->pdo->query("SELECT * FROM missao WHERE idMissao = '$idMissao'");
            while ($linhaMissao = $consultaMissao->fetch(PDO::FETCH_ASSOC)) {
                $tituloMissao = $linhaMissao['tituloMissao'];
                $sobreMissao = $linhaMissao['sobreMissao'];
                $idRecompensa = $linhaMissao['idRecomensa'];
            }

            // conmsulta recompensa
            $this->conectarBD();

            $consultaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = '$idRecompensa'");
            while ($linhaRecompensa = $consultaRecompensa->fetch(PDO::FETCH_ASSOC)) {
                $nomeRecompensa = $linhaRecompensa['nomeReompensa'];
                $tipoRecompensa = $linhaRecompensa['tipoRecompensa'];
            }

            // consulta id do evento na tabela missaoevento
            $this->conectarBD();

            $consultaRecompensa = $this->pdo->query("SELECT * FROM missaoevento WHERE idMissao = '$idMissao'");
            while ($linhaRecompensa = $consultaRecompensa->fetch(PDO::FETCH_ASSOC)) {
                $idEvento = $linhaRecompensa['idEvento'];
            }

            // consulta nome do evento
            $this->conectarBD();

            $consultaRecompensa = $this->pdo->query("SELECT * FROM evento WHERE idEvento = '$idEvento'");
            while ($linhaRecompensa = $consultaRecompensa->fetch(PDO::FETCH_ASSOC)) {
                $tituloEvento = $linhaRecompensa['tituloEvento'];
            }

            if(isset($tituloEvento)){
                $titulo = $tituloEvento;
            }else{
                $titulo = 'Encerrado';
            }

            include 'condicaoCores2.php';
            echo "

            <div class='col-lg-4 col-md-6 col-sm-6'>
              <div class='card card-stats'>
               <a href='#' title='".$sobreMissao."'>
                                                                    <div class='card-header card-header-primary card-header-icon'>
                                                                    <div class='card-icon' style='".$cor."'>
                                                                    <i class='material-icons'>amp_stories</i>
                                                                    </div>
                                                                    <p class='card-category'>".$tituloMissao."</p>
                                                                    <h3 class='card-title'>".$progressoMissao."%</h3>
                                                                    </div>
                                                                    <div class='card-footer'>
                                                                    <div class='stats'>
                                                                    <i class='material-icons'>amp_stories</i>Evento ".$titulo."
                                                                        </div>
                                                                        <label style='margin-left: 10%'>".$tipoRecompensa." ".$nomeRecompensa."</label>
                                                                        </div>
                                                                        </a>
                                                                        </div>
                                                                        </div>

                                                                        ";
        }
        echo "</div>";
    }

    public function levelUp($idUsuario){
        // consulta de progressos em 100%
        $this->conectarBD();

        $contador = $this->pdo->query("SELECT * FROM progressomissao WHERE (idUsuario = ".$idUsuario.") AND (progressoMissao = 100)")->rowCount();

        // consulta de nivel
        $this->conectarBD();

        $consultaNivel = $this->pdo->query("SELECT nivelUsuario FROM usuario WHERE idUsuario = ".$idUsuario."");

        while ($linhaNivel = $consultaNivel->fetch(PDO::FETCH_ASSOC)) {
            $nivel = $linhaNivel['nivelUsuario'];
        }

        // consulta de pontos
        $this->conectarBD();

        $consultaPontos = $this->pdo->query("SELECT pontuacaolUsuario FROM usuario WHERE idUsuario = ".$idUsuario."");

        while ($linhaPontos = $consultaPontos->fetch(PDO::FETCH_ASSOC)) {
            $pontos = $linhaPontos['pontuacaolUsuario'];
        }

        // se determinada quantidade de progressos em 100% dar level UP para tall nível
        if($contador == 1 && $contador < 2 && $nivel == 1){
            $pontosTotal2 = $pontos+20;
            // upar para level 2, e ganhar 20 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET pontuacaolUsuario='.$pontosTotal2.', nivelUsuario=2 WHERE idUsuario =" '.$idUsuario.'"');
                $stmt->execute(array(
                    ':nivelUsuario'   => 2
                ));

                $_SESSION['nivelUsuario'] = 2;
                $_SESSION['pontuacaolUsuario'] = $pontosTotal2;

                include 'class_notificacao.php';

                $notificacao = new Notificacao();

                $notificacao->inserirNotificacaoPrivada('Parabéns! Nível '.$_SESSION['nivelUsuario'].' alcançado.', $idUsuario);

                $notificacao->inserirNotificacaoPrivada('Pontuação atual em '.$pontosTotal2.'', $idUsuario);

                echo"<script language='javascript' type='text/javascript'> alert('Nível aumentado para 2!');</script>"; // pensar a respeito
                return 'Level UP 2';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 3 && $contador <= 5 && $nivel == 2){
            $pontosTotal3 = $pontos+30;
            // upar para level 3, e ganhar 30 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET pontuacaolUsuario="'.$pontosTotal3.'", nivelUsuario="3" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 3
                ));

                $_SESSION['nivelUsuario'] = 3;
                $_SESSION['pontuacaolUsuario'] = $pontosTotal3;

                include 'class_notificacao.php';

                $notificacao = new Notificacao();

                $notificacao->inserirNotificacaoPrivada('Parabéns! Nível '.$_SESSION['nivelUsuario'].' alcançado.', $idUsuario);

                $notificacao->inserirNotificacaoPrivada('Pontuação atual em '.$pontosTotal3.'', $idUsuario);

                return 'Level UP 3';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 6 && $contador <= 8 && $nivel == 3){
            $pontosTotal4 = $pontos+40;
            // upar para level 4, e ganhar 40 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET pontuacaolUsuario="'.$pontosTotal4.'", nivelUsuario="4" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 4
                ));


                $_SESSION['nivelUsuario'] = 4;
                $_SESSION['pontuacaolUsuario'] = $pontosTotal4;

                include 'class_notificacao.php';

                $notificacao = new Notificacao();

                $notificacao->inserirNotificacaoPrivada('Parabéns! Nível '.$_SESSION['nivelUsuario'].' alcançado.', $idUsuario);

                $notificacao->inserirNotificacaoPrivada('Pontuação atual em '.$pontosTotal4.'', $idUsuario);

                return 'Level UP 4';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 9 && $contador <= 11 && $nivel == 4){
            $pontosTotal5 = $pontos+50;
            // upar para level 5, e ganhar 50 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET pontuacaolUsuario="'.$pontosTotal5.'", nivelUsuario="5" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 5
                ));


                $_SESSION['nivelUsuario'] = 5;
                $_SESSION['pontuacaolUsuario'] = $pontosTotal5;

                include 'class_notificacao.php';

                $notificacao = new Notificacao();

                $notificacao->inserirNotificacaoPrivada('Parabéns! Nível '.$_SESSION['nivelUsuario'].' alcançado.', $idUsuario);

                $notificacao->inserirNotificacaoPrivada('Pontuação atual em '.$pontosTotal5.'', $idUsuario);

                return 'Level UP 5';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 12 && $contador <= 14 && $nivel == 5){
            $pontosTotal6 = $pontos+60;
            // upar para level 6, e ganhar 60 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET pontuacaolUsuario="'.$pontosTotal6.'", nivelUsuario="6" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 6
                ));


                $_SESSION['nivelUsuario'] = 6;
                $_SESSION['pontuacaolUsuario'] = $pontosTotal6;

                include 'class_notificacao.php';

                $notificacao = new Notificacao();

                $notificacao->inserirNotificacaoPrivada('Parabéns! Nível '.$_SESSION['nivelUsuario'].' alcançado.', $idUsuario);

                $notificacao->inserirNotificacaoPrivada('Pontuação atual em '.$pontosTotal6.'', $idUsuario);

                return 'Level UP 6';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 15 && $contador <= 17 && $nivel == 6){
            $pontosTotal7 = $pontos+70;
            // upar para level 7, e ganhar 70 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET pontuacaolUsuario="'.$pontosTotal7.'", nivelUsuario="7" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 7
                ));


                $_SESSION['nivelUsuario'] = 7;
                $_SESSION['pontuacaolUsuario'] = $pontosTotal7;

                include 'class_notificacao.php';

                $notificacao = new Notificacao();

                $notificacao->inserirNotificacaoPrivada('Parabéns! Nível '.$_SESSION['nivelUsuario'].' alcançado.', $idUsuario);

                $notificacao->inserirNotificacaoPrivada('Pontuação atual em '.$pontosTotal7.'', $idUsuario);

                return 'Level UP 7';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 18 && $contador <= 20 && $nivel == 7){
            $pontosTotal8 = $pontos+80;
            // upar para level 8, e ganhar 80 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET pontuacaolUsuario="'.$pontosTotal8.'", nivelUsuario="8" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 8
                ));


                $_SESSION['nivelUsuario'] = 8;
                $_SESSION['pontuacaolUsuario'] = $pontosTotal8;

                include 'class_notificacao.php';

                $notificacao = new Notificacao();

                $notificacao->inserirNotificacaoPrivada('Parabéns! Nível '.$_SESSION['nivelUsuario'].' alcançado.', $idUsuario);

                $notificacao->inserirNotificacaoPrivada('Pontuação atual em '.$pontosTotal8.'', $idUsuario);

                return 'Level UP 8';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 21 && $contador <= 23 && $nivel == 8){
            $pontosTotal9 = $pontos+90;
            // upar para level 9, e ganhar 90 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET pontuacaolUsuario="'.$pontosTotal9.'", nivelUsuario="9" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 9
                ));


                $_SESSION['nivelUsuario'] = 9;
                $_SESSION['pontuacaolUsuario'] = $pontosTotal9;

                include 'class_notificacao.php';

                $notificacao = new Notificacao();

                $notificacao->inserirNotificacaoPrivada('Parabéns! Nível '.$_SESSION['nivelUsuario'].' alcançado.', $idUsuario);

                $notificacao->inserirNotificacaoPrivada('Pontuação atual em '.$pontosTotal9.'', $idUsuario);

                return 'Level UP 9';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 24 && $contador <= 26 && $nivel == 9){
            $pontosTotal10 = $pontos+100;
            // upar para level 10, e ganhar 100 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET pontuacaolUsuario="'.$pontosTotal10.'", nivelUsuario="10" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 10
                ));


                $_SESSION['nivelUsuario'] = 10;
                $_SESSION['pontuacaolUsuario'] = $pontosTotal10;

                include 'class_notificacao.php';

                $notificacao = new Notificacao();

                $notificacao->inserirNotificacaoPrivada('Parabéns! Nível '.$_SESSION['nivelUsuario'].' alcançado.', $idUsuario);

                $notificacao->inserirNotificacaoPrivada('Pontuação atual em '.$pontosTotal10.'', $idUsuario);

                return 'Level UP 10';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}
?>
