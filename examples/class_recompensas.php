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
                                            <label>Você já possui</label>
                                        </div>
                                    </div>
                                </a>
                            </div>


<div class="modal fade" id="modal-container-'.$idRecompensa.'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" action="temas.php">
            <div class="modal-content" style="width: 150%;">
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
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nome do tema</label>
                                            <input type="text" name="nomeTema" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Valor do tema</label>
                                            <input type="text" name="custoTema" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div>
                                            <input type="color" name="corTema" class="form-control">
                                        </div>
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
                    <input type="submit" class="btn btn-primary pull-right" value="Concluir" style="'.$cor.'">
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
                                <a id="modal-tema-'.$idRecompensa.'" href="#modal-container-tema" role="button" data-toggle="modal">
                                    <div class="card">
                                        <div style="position: absolute; width: 120px; height:120px; background-color: '.$linhaRecompensaT['propriedadeRecompensa'].'; border-radius: 5px 0 0 5px;">
                                        </div>
                                        <div class="card-body" style="margin-left: 40%;">
                                            <h6 class="card-category text-gray">Tema '.$linhaRecompensaT['nomeReompensa'].'</h6>
                                            <label>Custo: '.$custoT.'</label>
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
