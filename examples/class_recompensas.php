<?php
class Recompensa{
    public $pdo;

    public function conectarBD(){
        include '../conexaoBDpdoPOO.php';
    }

    public function vizualizarTemas(){ // mostrar primeiro as disponiveis depois as indisponiveis
        // consulta de disponiveis
        $this->conectarBD();

        $consultaRecompensaDisponivel = $this->pdo->query("SELECT * FROM recompensadispoivel WHERE idUsuario = ".$_SESSION['idUsuario']."");

        while ($linhaRecompensaDisponivel = $consultaRecompensaDisponivel->fetch(PDO::FETCH_ASSOC)) {
            $idRecompensa = $linhaRecompensaDisponivel['idRecomensa'];

            // ver todas as recompensas disponiveis
            $this->conectarBD();

            $consutaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$idRecompensa."");

            while ($linhaRecompensa = $consutaRecompensa->fetch(PDO::FETCH_ASSOC)){
                if ($linhaRecompensa['tipoRecompensa'] == 'tema'){
                    echo '

                    <div class="col-md-4">
                                <a href="#">
                                    <div class="card">
                                        <div style="position: absolute; width: 120px; height:120px; background-color: '.$linhaRecompensa['propriedadeRecompensa'].'; border-radius: 5px 0 0 5px;">
                                        </div>
                                        <div class="card-body" style="margin-left: 40%;">
                                            <h6 class="card-category text-gray">Tema '.$linhaRecompensa['nomeReompensa'].'</h6>
                                            <label>Custo: '.$linhaRecompensa['custoRecompensa'].' Pontos</label>
                                            <br>
                                            <label>Você já possui</label>
                                        </div>
                                    </div>
                                </a>
                            </div>

                    '; // vizualização dos dados
                }
            }
        }

        // ver todos temas menos os ja disponiveis
        $this->conectarBD();

        $consutaRecompensaT = $this->pdo->query("SELECT * FROM recompensa");

        while ($linhaRecompensaT = $consutaRecompensaT->fetch(PDO::FETCH_ASSOC)){
            if ($linhaRecompensaT['idRecomensa'] != $idRecompensa && $linhaRecompensaT['tipoRecompensa'] == 'tema'){
                echo '

                    <div class="col-md-4">
                                <a href="#">
                                    <div class="card">
                                        <div style="position: absolute; width: 120px; height:120px; background-color: '.$linhaRecompensaT['propriedadeRecompensa'].'; border-radius: 5px 0 0 5px;">
                                        </div>
                                        <div class="card-body" style="margin-left: 40%;">
                                            <h6 class="card-category text-gray">Tema '.$linhaRecompensaT['nomeReompensa'].'</h6>
                                            <label>Custo: '.$linhaRecompensaT['custoRecompensa'].' Pontos</label>
                                            <br>
                                            <label>Você não possui ainda</label>
                                        </div>
                                    </div>
                                </a>
                            </div>

                    '; // vizualização dos dados
            }
        }
    }

    public function vizualizarSkins(){ // mostrar primeiro as disponiveis depois as indisponiveis
        // consulta de disponiveis
        $this->conectarBD();

        $consultaRecompensaDisponivel = $this->pdo->query("SELECT * FROM recompensadispoivel WHERE idUsuario = ".$_SESSION['idUsuario']."");

        while ($linhaRecompensaDisponivel = $consultaRecompensaDisponivel->fetch(PDO::FETCH_ASSOC)) {
            $idRecompensa = $linhaRecompensaDisponivel['idRecomensa'];

            // ver todas as recompensas disponiveis
            $this->conectarBD();

            $consutaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$idRecompensa."");

            while ($linhaRecompensa = $consutaRecompensa->fetch(PDO::FETCH_ASSOC)){
                if ($linhaRecompensa['tipoRecompensa'] == 'skin'){
                    echo 'Disponiveis'.$linhaRecompensa['idRecomensa'].'<br>'; // vizualização dos dados
                }
            }
        }

        // ver todos temas menos os ja disponiveis
        $this->conectarBD();

        $consutaRecompensaT = $this->pdo->query("SELECT * FROM recompensa");

        while ($linhaRecompensaT = $consutaRecompensaT->fetch(PDO::FETCH_ASSOC)){
            if ($linhaRecompensaT['idRecomensa'] != $idRecompensa && $linhaRecompensaT['tipoRecompensa'] == 'skin'){
                echo 'Indisponiveis'.$linhaRecompensaT['idRecomensa'].'<br>'; // vizualização dos dados
            }
        }
    }
}
?>
