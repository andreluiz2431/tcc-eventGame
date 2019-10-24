<div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
            <li class="header-title"> Cores</li>
            <label style="font-size: 66%; margin-left: 25%;">Atualize a página para aplicar</label><br>
            <li class="">
                <a href="javascript:void(0)" class="switch-trigger active-color">

                    <form method="post" action="">
                        <div class="badge-colors ml-auto mr-auto">

                            <?php
                            // ver cores disponíveis
                            include '../conexaoBDpdoPN.php';

                            $consultaRecompensaDisponivel = $pdo->query("SELECT * FROM recompensadispoivel WHERE idUsuario = ".$_SESSION['idUsuario']."");

                            while ($linhaRecompensaDisponivel = $consultaRecompensaDisponivel->fetch(PDO::FETCH_ASSOC)) {
                                $idRecompensa = $linhaRecompensaDisponivel['idRecomensa'];

                                include '../conexaoBDpdoPN.php';

                                $consutaRecompensa = $pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$idRecompensa."");

                                while ($linhaRecompensa = $consutaRecompensa->fetch(PDO::FETCH_ASSOC)){
                                    if ($linhaRecompensa['tipoRecompensa'] == 'tema'){
                                        echo '<input type="submit" name="tema" value="'.$idRecompensa.'" class="badge filter" data-color="'.$linhaRecompensa['propriedadeRecompensa'].'" style="background-color: '.$linhaRecompensa['propriedadeRecompensa'].';">';
                                    }
                                }
                            }
                            ?>

                        </div>
                    </form>

                    <?php
                    // fazer troca de cor do usuário
                    if(isset($_POST['tema'])){
                        include '../conexaoBDpdoPN.php';

                        $consultaRecompensa = $pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$_POST['tema']."");

                        while ($linhaRecompensa = $consultaRecompensa->fetch(PDO::FETCH_ASSOC)) {
                            $nomeRecompensa = $linhaRecompensa['nomeReompensa'];

                            try {
                                include '../conexaoBDpdoPN.php';

                                $stmt = $pdo->prepare('UPDATE usuario SET temaUsuario='.$_POST['tema'].' WHERE idUsuario = '.$_SESSION['idUsuario'].'');
                                $stmt->execute(array(
                                    ':idUsuario'   => $_SESSION['idUsuario'],
                                    ':idRecomensa' => $_POST['tema']
                                ));
                                echo "<script>window.location.href = \"pagina_eventos.php\";</script>";
                                session_start();
                                $_SESSION['temaAplicada'] = $nomeRecompensa;
                            } catch(PDOException $e) {
                                echo 'Error: ' . $e->getMessage();
                            }

                            echo $nomeRecompensa;
                        }
                    }
                    ?>

                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Imagens</li>
            <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-1.jpg" alt="">
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-2.jpg" alt="">
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-3.jpg" alt="">
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-4.jpg" alt="">
                </a>
            </li>
            <li class="button-container">
                <!-- <a href="#" target="_blank" class="btn btn-default btn-block">
Meus temas
</a> -->
            </li>
        </ul>
    </div>
</div>
<?php
if($_SESSION['nomeUsuario'] == "ADM"){
    include 'opcoesADM.php';
}
?>
