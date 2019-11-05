<?php
class Recompensa{
    public $pdo;

    public function conectarBD(){
        include '../conexaoBDpdoPOO.php';
    }

    public function comprarRecompensa($idUsuario, $recompensa, $custo){
        // verificar se tem pontos o suficientes
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM usuario WHERE idUsuario = ".$idUsuario."");

        while ($linhaRecompensa = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $pontos = $linhaRecompensa['pontuacaolUsuario'];

            if($pontos >= $custo){
                // descontar dos pontos
                if($pontos == 0){
                    $pontosNovo = $pontos;
                }else{
                    $pontosNovo = $pontos - $custo;
                }

                try {
                    $this->conectarBD();

                    $stmt = $this->pdo->prepare('UPDATE usuario SET pontuacaolUsuario='.$pontosNovo.' WHERE idUsuario = '.$idUsuario.'');
                    $stmt->execute(array(
                        ':idUsuario'   => $idUsuario
                    ));

                    $_SESSION['pontuacaolUsuario'] = $pontosNovo;

                    // adicionar recompensa aos disponiveis
                    try {
                        $this->conectarBD();

                        $stmt = $this->pdo->prepare("INSERT INTO recompensadispoivel (idUsuario, idRecomensa) VALUES('".$idUsuario."', '".$recompensa."')");

                        $stmt->execute(array(
                            ':idUsuario' => $idUsuario
                        ));

                        // include 'class_notificacao.php';

                        // $notificacao = new Notificacao();

                        // $notificacao->inserirNotificacaoPrivada('Compra realizada com sucesso', $_SESSION['idUsuario']);

                        echo '<script>alert("Item adicionado a biblioteca! (Pontuação atual: '.$pontosNovo.')")</script>';

                    } catch(PDOException $e) {
                        echo 'Error: ' . $e->getMessage();
                        return -1;
                    }

                } catch(PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
            }
        }
    }

    public function aplicarTema($idUsuario, $tema){
        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare('UPDATE usuario SET temaUsuario='.$tema.' WHERE idUsuario = '.$idUsuario.'');
            $stmt->execute(array(
                ':idUsuario'   => $idUsuario
            ));

            $this->conectarBD();

            $consultaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$tema."");

            while ($linhaRecompensa = $consultaRecompensa->fetch(PDO::FETCH_ASSOC)) {
                $nomeRecompensa = $linhaRecompensa['nomeReompensa'];

                $_SESSION['temaAplicada'] = $nomeRecompensa;
            }

            // include 'class_notificacao.php';

            // $notificacao = new Notificacao();

            // $notificacao->inserirNotificacaoPrivada('Tema '.$nomeRecompensa.' aplicada', $_SESSION['idUsuario']);

            echo "<script>alert('Tema aplicado com sucesso!'); window.location.href = \"pagina_eventos.php\";</script>";
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function aplicarSkin($idUsuario, $skin){
        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare('UPDATE usuario SET skinUsuario='.$skin.' WHERE idUsuario = '.$idUsuario.'');
            $stmt->execute(array(
                ':idUsuario'   => $idUsuario
            ));

            $this->conectarBD();

            $consultaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$skin."");

            while ($linhaRecompensa = $consultaRecompensa->fetch(PDO::FETCH_ASSOC)) {
                $nomeRecompensa = $linhaRecompensa['nomeReompensa'];

                $_SESSION['skinAplicada'] = $nomeRecompensa;
            }

            include 'class_notificacao.php';

            $notificacao = new Notificacao();

            $notificacao->inserirNotificacaoPrivada('Skin '.$nomeRecompensa.' aplicada', $_SESSION['idUsuario']);

            echo "<script>alert('Skin aplicada com sucesso!'); window.location.href = \"user.php\";</script>";
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function skinsDisponiveis($idUsuario){
        // consulta de disponiveis
        $this->conectarBD();

        $consultaRecompensaDisponivel = $this->pdo->query("SELECT * FROM recompensadispoivel WHERE idUsuario = ".$idUsuario."");

        echo '<div class="row">';
        while ($linhaRecompensaDisponivel = $consultaRecompensaDisponivel->fetch(PDO::FETCH_ASSOC)) {
            $idRecompensa = $linhaRecompensaDisponivel['idRecomensa'];

            // ver todas as recompensas disponiveis
            $this->conectarBD();

            $consutaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$idRecompensa."");

            while ($linhaRecompensa = $consutaRecompensa->fetch(PDO::FETCH_ASSOC)){
                if ($linhaRecompensa['tipoRecompensa'] == 'skin'){
                    echo '

                    <div class="col-md-4" style="margin-bottom: 90px;">
                        <form method="POST" action="aplicandoSkin.php">
                            <button type="submit" name="skinAplicar" value="'.$idRecompensa.'" style="background: none;border: none; margin-left: -110px;">
                                <div class="card">
                                    <img  style="position: absolute; width: 120px; height:120px; border-radius: 5px;" src="../examples/foto/'.$linhaRecompensa['propriedadeRecompensa'].'">
                                </div>
                            </button>
                        </form>
                    </div>


                    '; // vizualização dos dados
                }
            }
        }
        echo '</div>';
    }

    public function fotoAplicada($idUsuario){ // mostrar skin aplicada no perfil
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT skinUsuario FROM usuario WHERE idUsuario = ".$idUsuario."");

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $idSkinUsuario = $linha['skinUsuario'];

            $this->conectarBD();

            $consultaR = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$idSkinUsuario."");

            while ($linhaR = $consultaR->fetch(PDO::FETCH_ASSOC)) {
                $skinUsuario = $linhaR['propriedadeRecompensa'];

                return $skinUsuario;
            }
        }
    }

    public function vizualizarTemas(){ // mostrar primeiro as disponiveis depois as indisponiveis
        include 'condicaoCores2.php';
        // consulta de disponiveis
        $this->conectarBD();
$listaIDs = array();
        $consultaRecompensaDisponivel = $this->pdo->query("SELECT * FROM recompensadispoivel WHERE idUsuario = ".$_SESSION['idUsuario']."");

        while ($linhaRecompensaDisponivel = $consultaRecompensaDisponivel->fetch(PDO::FETCH_ASSOC)) {
            $idRecompensa = $linhaRecompensaDisponivel['idRecomensa'];
$listaIDs[] = $idRecompensa;
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
            <div class="modal-content" style="width: 129%;">
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

                    <input type="hidden" name="addBibTemaG" value="'.$idRecompensa.'">

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

        if(empty($listaIDs)){
            $consutaRecompensaT = $this->pdo->query("SELECT * FROM recompensa");
        }
        else{
            $consutaRecompensaT = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa NOT IN (".implode(", ", $listaIDs).")");
        }

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
            <div class="modal-content" style="width: 450px;">
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

<input name="addBibTema" type="hidden" value="'.$linhaRecompensaT['idRecomensa'].'">
<input name="custoTemaD" type="hidden" value="'.$linhaRecompensaT['custoRecompensa'].'">

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

        include 'condicaoCores2.php';
        // consulta de disponiveis
        $this->conectarBD();

        $consultaRecompensaDisponivel = $this->pdo->query("SELECT * FROM recompensadispoivel WHERE idUsuario = ".$_SESSION['idUsuario']."");
        $listaIDs = array();
        while ($linhaRecompensaDisponivel = $consultaRecompensaDisponivel->fetch(PDO::FETCH_ASSOC)) {
            $idRecompensa = $linhaRecompensaDisponivel['idRecomensa'];
            $listaIDs[] = $idRecompensa;
            // ver todas as recompensas disponiveis
            $this->conectarBD();

            $consutaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$idRecompensa."");

            while ($linhaRecompensa = $consutaRecompensa->fetch(PDO::FETCH_ASSOC)){
                if($linhaRecompensa['custoRecompensa'] <= 0){
                    $custo = 'Gratis';
                }else{
                    $custo = $linhaRecompensa['custoRecompensa'].' Pontos';
                }

                if ($linhaRecompensa['tipoRecompensa'] == 'skin'){
                    echo '

                    <div class="col-md-4">
                                <a id="modal-'.$idRecompensa.'" href="#modal-container-'.$idRecompensa.'" role="button" data-toggle="modal">
                                    <div class="card">

                                        <img  style="position: absolute; width: 120px; height:120px; border-radius: 5px 0 0 5px;" src="../examples/foto/'.$linhaRecompensa['propriedadeRecompensa'].'">

                                        <div class="card-body" style="margin-left: 40%;">
                                            <h6 class="card-category text-gray">Skin '.$linhaRecompensa['nomeReompensa'].'</h6>
                                            <label>Custo: '.$custo.'</label>
                                            <br>
                                            <label><i>Você já possui</i></label>
                                        </div>
                                    </div>
                                </a>
                            </div>


<div class="modal fade" id="modal-container-'.$idRecompensa.'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" action="skins.php">
            <div class="modal-content" style="width: 129%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">
                        <b>Skin '.$linhaRecompensa['nomeReompensa'].'</b>
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
                                        <label>Skin já em sua biblioteca, deseja aplica-la?</label>
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

                    <input type="hidden" name="addBibSkinG" value="'.$idRecompensa.'">

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

        if(empty($listaIDs)){
            $consutaRecompensaT = $this->pdo->query("SELECT * FROM recompensa");
        }
        else{
            $consutaRecompensaT = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa NOT IN (".implode(", ", $listaIDs).")");
        }



        while ($linhaRecompensaT = $consutaRecompensaT->fetch(PDO::FETCH_ASSOC)){
            if($linhaRecompensaT['custoRecompensa'] <= 0){
                $custoT = 'Gratis';
            }else{
                $custoT = $linhaRecompensaT['custoRecompensa'].' Pontos';
            }

            if(empty($idRecompensa)){
                $idRecompensa = 0;
            }

            if ($linhaRecompensaT['idRecomensa'] != $idRecompensa && $linhaRecompensaT['tipoRecompensa'] == 'skin'){
                echo '

                    <div class="col-md-4">
                                <a id="modal-'.$linhaRecompensaT['idRecomensa'].'" href="#modal-container-'.$linhaRecompensaT['idRecomensa'].'" role="button" data-toggle="modal">
                                    <div class="card">

                                <img  style="position: absolute; width: 120px; height:120px; border-radius: 5px 0 0 5px;" src="../examples/foto/'.$linhaRecompensaT['propriedadeRecompensa'].'">

                                        <div class="card-body" style="margin-left: 40%;">
                                            <h6 class="card-category text-gray">Skin '.$linhaRecompensaT['nomeReompensa'].'</h6>
                                            <label>Custo: '.$custoT.'</label>
                                            <br>
                                            <label><b>Você não possui ainda</b></label>
                                        </div>
                                    </div>
                                </a>
                            </div>


<div class="modal fade" id="modal-container-'.$linhaRecompensaT['idRecomensa'].'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" action="skins.php">
            <div class="modal-content" style="width: 99%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">
                        <b>Skin '.$linhaRecompensaT['nomeReompensa'].'</b>
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
                    echo '<label>Skin '.$custoT.', deseja adicionar a biblioteca?</label>';
                }else{
                    echo '<label>Você ainda não possui esta skin, deseja trocar por '.$custoT.'?</label>';
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

<input name="addBibSkin" type="hidden" value="'.$linhaRecompensaT['idRecomensa'].'">
<input name="custoSkinD" type="hidden" value="'.$linhaRecompensaT['custoRecompensa'].'">
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
}
?>
