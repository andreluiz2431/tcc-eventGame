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
}
?>
