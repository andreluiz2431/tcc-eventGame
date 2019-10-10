<div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
            <li class="header-title"> Cores</li>
            <li class="">
                <a href="javascript:void(0)" class="switch-trigger active-color">

                    <form method="post" action="">
                        <div class="badge-colors ml-auto mr-auto">
                            <input type="submit" name="purple" value="" class="badge filter badge-purple" data-color="purple"><!--  ta no BD e programado -->
                            <input type="submit" name="azure" value="" class="badge filter badge-azure" data-color="azure"><!--  ta no BD -->
                            <input type="submit" name="green" value="" class="badge filter badge-green" data-color="green"><!--  ta no BD -->
                            <input type="submit" name="orange" value="" class="badge filter badge-warning" data-color="orange"><!--  ta no BD -->
                            <input type="submit" name="danger" value="" class="badge filter badge-danger" data-color="danger"><!--  ta no BD e programado -->
                            <input type="submit" name="rose" value="" class="badge filter badge-rose active" data-color="rose"><!--  ta no BD -->
                        </div>
                    </form>

                    <?php
                    if(isset($_POST['purple'])){
                        try {
                            $pdo = new PDO('mysql:host=localhost;dbname=id10730896_banco', 'root', '');
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt = $pdo->prepare('UPDATE recompensadispoivel SET idUsuario='.$_SESSION['idUsuario'].',idRecomensa=7 WHERE idUsuario = '.$_SESSION['idUsuario'].'');
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

                            $stmt = $pdo->prepare('UPDATE recompensadispoivel SET idUsuario='.$_SESSION['idUsuario'].',idRecomensa=9 WHERE idUsuario = '.$_SESSION['idUsuario'].'');
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

                            $stmt = $pdo->prepare('UPDATE recompensadispoivel SET idUsuario='.$_SESSION['idUsuario'].',idRecomensa=10 WHERE idUsuario = '.$_SESSION['idUsuario'].'');
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

                            $stmt = $pdo->prepare('UPDATE recompensadispoivel SET idUsuario='.$_SESSION['idUsuario'].',idRecomensa=11 WHERE idUsuario = '.$_SESSION['idUsuario'].'');
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

                            $stmt = $pdo->prepare('UPDATE recompensadispoivel SET idUsuario='.$_SESSION['idUsuario'].',idRecomensa=8 WHERE idUsuario = '.$_SESSION['idUsuario'].'');
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

                            $stmt = $pdo->prepare('UPDATE recompensadispoivel SET idUsuario='.$_SESSION['idUsuario'].',idRecomensa=12 WHERE idUsuario = '.$_SESSION['idUsuario'].'');
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
                <a href="#" target="_blank" class="btn btn-default btn-block">
                    Meus temas
                </a>
            </li>
        </ul>
    </div>
</div>
