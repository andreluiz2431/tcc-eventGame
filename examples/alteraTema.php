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
<input type="submit" name="purple" value="" class="badge filter badge-purple" data-color="purple">
                            <?php
                            // ver cores disponíveis
                            $pdo = new PDO('mysql:host=localhost;dbname=id10730896_banco', 'root', '');
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $consultaRecompensaDisponivel = $pdo->query("SELECT * FROM recompensadispoivel WHERE idUsuario = ".$_SESSION['idUsuario']."");

                            while ($linhaRecompensaDisponivel = $consultaRecompensaDisponivel->fetch(PDO::FETCH_ASSOC)) {
                                $idRecompensa = $linhaRecompensaDisponivel['idRecomensa'];

                                if($idRecompensa == 8){
                                    echo '<input type="submit" name="danger" value="" class="badge filter badge-danger" data-color="danger">';
                                }elseif($idRecompensa == 9){
                                    echo '<input type="submit" name="azure" value="" class="badge filter badge-azure" data-color="azure">';
                                }elseif($idRecompensa == 10){
                                    echo '<input type="submit" name="green" value="" class="badge filter badge-green" data-color="green">';
                                }elseif($idRecompensa == 11){
                                    echo '<input type="submit" name="orange" value="" class="badge filter badge-warning" data-color="orange">';
                                }elseif($idRecompensa == 12){
                                    echo '<input type="submit" name="rose" value="" class="badge filter badge-rose active" data-color="rose">';
                                }
                            }
                            ?>

                        </div>
                    </form>

                    <?php
                    // fazer troca de cor do usuário
                    if(isset($_POST['purple'])){
                        try {
                            $pdo = new PDO('mysql:host=localhost;dbname=id10730896_banco', 'root', '');
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt = $pdo->prepare('UPDATE usuario SET temaUsuario=7 WHERE idUsuario = '.$_SESSION['idUsuario'].'');
                            $stmt->execute(array(
                                ':idUsuario'   => $_SESSION['idUsuario'],
                                ':idRecomensa' => 7
                            ));
                            session_start();
                            $_SESSION['temaAplicada'] = 'Purple';
                        } catch(PDOException $e) {
                            echo 'Error: ' . $e->getMessage();
                        }

                        echo 'purple';
                    }elseif(isset($_POST['azure'])){
                        try {
                            $pdo = new PDO('mysql:host=localhost;dbname=id10730896_banco', 'root', '');
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt = $pdo->prepare('UPDATE usuario SET temaUsuario=9 WHERE idUsuario = '.$_SESSION['idUsuario'].'');
                            $stmt->execute(array(
                                ':idUsuario'   => $_SESSION['idUsuario'],
                                ':idRecomensa' => 9
                            ));
                        } catch(PDOException $e) {
                            echo 'Error: ' . $e->getMessage();
                        }
                        session_start();
                        $_SESSION['temaAplicada'] = 'Blue';
                        echo 'azure';
                    }elseif(isset($_POST['green'])){
                        try {
                            $pdo = new PDO('mysql:host=localhost;dbname=id10730896_banco', 'root', '');
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt = $pdo->prepare('UPDATE usuario SET temaUsuario=10 WHERE idUsuario = '.$_SESSION['idUsuario'].'');
                            $stmt->execute(array(
                                ':idUsuario'   => $_SESSION['idUsuario'],
                                ':idRecomensa' => 10
                            ));
                        } catch(PDOException $e) {
                            echo 'Error: ' . $e->getMessage();
                        }
                        session_start();
                        $_SESSION['temaAplicada'] = 'Green';
                        echo 'green';
                    }elseif(isset($_POST['orange'])){
                        try {
                            $pdo = new PDO('mysql:host=localhost;dbname=id10730896_banco', 'root', '');
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt = $pdo->prepare('UPDATE usuario SET temaUsuario=11 WHERE idUsuario = '.$_SESSION['idUsuario'].'');
                            $stmt->execute(array(
                                ':idUsuario'   => $_SESSION['idUsuario'],
                                ':idRecomensa' => 11
                            ));
                        } catch(PDOException $e) {
                            echo 'Error: ' . $e->getMessage();
                        }
                        session_start();
                        $_SESSION['temaAplicada'] = 'Orange';
                        echo 'orange';
                    }elseif(isset($_POST['danger'])){
                        try {
                            $pdo = new PDO('mysql:host=localhost;dbname=id10730896_banco', 'root', '');
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt = $pdo->prepare('UPDATE usuario SET temaUsuario=8 WHERE idUsuario = '.$_SESSION['idUsuario'].'');
                            $stmt->execute(array(
                                ':idUsuario'   => $_SESSION['idUsuario'],
                                ':idRecomensa' => 8
                            ));
                        } catch(PDOException $e) {
                            echo 'Error: ' . $e->getMessage();
                        }
                        session_start();
                        $_SESSION['temaAplicada'] = 'Red';
                        echo 'danger';
                    }elseif(isset($_POST['rose'])){
                        try {
                            $pdo = new PDO('mysql:host=localhost;dbname=id10730896_banco', 'root', '');
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt = $pdo->prepare('UPDATE usuario SET temaUsuario=12 WHERE idUsuario = '.$_SESSION['idUsuario'].'');
                            $stmt->execute(array(
                                ':idUsuario'   => $_SESSION['idUsuario'],
                                ':idRecomensa' => 12
                            ));
                        } catch(PDOException $e) {
                            echo 'Error: ' . $e->getMessage();
                        }
                        session_start();
                        $_SESSION['temaAplicada'] = 'Pink';
                        echo 'rose';
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
