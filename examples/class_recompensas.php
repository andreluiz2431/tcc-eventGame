<?php
class Recompensa{
    public $pdo;

    public function conectarBD(){
        include '../conexaoBDpdoPOO.php';
    }

    public function vizualizarTemas(){ // mostrar primeiro as disponiveis depois as indisponiveis
        include 'condicaoCores2.php';
        // consulta de disponiveis
        $this->conectarBD();

        $consultaRecompensaDisponivel = $this->pdo->query("SELECT * FROM recompensadispoivel WHERE idUsuario = ".$_SESSION['idUsuario']."");

        while ($linhaRecompensaDisponivel = $consultaRecompensaDisponivel->fetch(PDO::FETCH_ASSOC)) {
            $idRecompensa = $linhaRecompensaDisponivel['idRecomensa'];

            // ver todas as recompensas disponiveis
            $this->conectarBD();

            $consutaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$idRecompensa."");

            while ($linhaRecompensa = $consutaRecompensa->fetch(PDO::FETCH_ASSOC)){
                if($linhaRecompensa['custoRecompensa'] <= 0){
                    $custo = 'Gratis';
                }else{
                    $custo = $linhaRecompensa['custoRecompensa'].' Pontos';
                }

                if ($linhaRecompensa['tipoRecompensa'] == 'tema'){
                    echo '

                    <div class="col-md-4">
                                <a id="modal-'.$idRecompensa.'" href="#modal-container-'.$idRecompensa.'" role="button" data-toggle="modal">
                                    <div class="card">
                                        <div style="position: absolute; width: 120px; height:120px; background-color: '.$linhaRecompensa['propriedadeRecompensa'].'; border-radius: 5px 0 0 5px;">
                                        </div>
                                        <div class="card-body" style="margin-left: 40%;">
                                            <h6 class="card-category text-gray">Tema '.$linhaRecompensa['nomeReompensa'].'</h6>
                                            <label>Custo: '.$custo.'</label>
                                            <br>
                                            <label><i>Você já possui</i></label>
                                        </div>
                                    </div>
                                </a>
                            </div>


<div class="modal fade" id="modal-container-'.$idRecompensa.'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" action="temas.php">
            <div class="modal-content" style="width: 500px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">
                        <b>Tema '.$linhaRecompensa['nomeReompensa'].'</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="height: auto; overflow: auto;">

                    <div class="col-md-16">
                        <div class="">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Tema já em sua biblioteca, deseja aplica-la?</label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fechar
                    </button>
                    <input type="submit" class="btn btn-primary pull-right" value="Aplicar" style="'.$cor.'">
                </div>

            </div>
        </form>
    </div>
</div>


                    '; // vizualização dos dados
                }
            }
        }

        // ver todos temas menos os ja disponiveis
        $this->conectarBD();

        $consutaRecompensaT = $this->pdo->query("SELECT * FROM recompensa");

        while ($linhaRecompensaT = $consutaRecompensaT->fetch(PDO::FETCH_ASSOC)){
            if($linhaRecompensaT['custoRecompensa'] <= 0){
                $custoT = 'Gratis';
            }else{
                $custoT = $linhaRecompensaT['custoRecompensa'].' Pontos';
            }

            if(empty($idRecompensa)){
                $idRecompensa = 0;
            }

            if ($linhaRecompensaT['idRecomensa'] != $idRecompensa && $linhaRecompensaT['tipoRecompensa'] == 'tema'){
                echo '

                    <div class="col-md-4">
                                <a id="modal-'.$linhaRecompensaT['idRecomensa'].'" href="#modal-container-'.$linhaRecompensaT['idRecomensa'].'" role="button" data-toggle="modal">
                                    <div class="card">
                                        <div style="position: absolute; width: 120px; height:120px; background-color: '.$linhaRecompensaT['propriedadeRecompensa'].'; border-radius: 5px 0 0 5px;">
                                        </div>
                                        <div class="card-body" style="margin-left: 40%;">
                                            <h6 class="card-category text-gray">Tema '.$linhaRecompensaT['nomeReompensa'].'</h6>
                                            <label>Custo: '.$custoT.'</label>
                                            <br>
                                            <label><b>Você não possui ainda</b></label>
                                        </div>
                                    </div>
                                </a>
                            </div>


<div class="modal fade" id="modal-container-'.$linhaRecompensaT['idRecomensa'].'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" action="temas.php">
            <div class="modal-content" style="width: 500px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">
                        <b>Tema '.$linhaRecompensaT['nomeReompensa'].'</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="height: auto; overflow: auto;">

                    <div class="col-md-16">
                        <div class="">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">

                                    ';
                if($custoT == 'Gratis'){
                    echo '<label>Tema '.$custoT.', deseja adicionar a biblioteca?</label>';
                }else{
                    echo '<label>Você ainda não possui este tema, deseja trocar por '.$custoT.'?</label>';
                }


                echo '

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fechar
                    </button>

                    ';
                if($custoT == 'Gratis'){
                    echo '<input type="submit" class="btn btn-primary pull-right" value="Adicionar" style="'.$cor.'">';
                }else{
                    echo '<input type="submit" class="btn btn-primary pull-right" value="Trocar" style="'.$cor.'">';
                }


                echo '


                </div>

            </div>
        </form>
    </div>
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
