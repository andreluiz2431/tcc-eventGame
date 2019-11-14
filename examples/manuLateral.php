<div class="sidebar" data-background-color="<?php if($_SESSION['nomeUsuario'] == "ADM"){echo '';}else{echo 'black';} ?>" style="
   background-color:
 <?php include 'condicaoCores2.php'; echo $idCor; ?>

   ">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

Tip 2: you can also add an image using data-image tag
-->
    <div class="logo">
        <a href="pagina_eventos.php" class="simple-text logo-normal">
            EVENTGAME
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item">
                    <a class="nav-link" href="./pagina_eventos.php" style="margin: 0 15px; background-color: <?php include 'condicaoCores2.php'; echo $idCor; ?>;filter:contrast(140%);box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4);border-radius: 3px;padding-left: 10px;">
                        <i class="material-icons" style="color: #fff;">dashboard</i>
                        <p style="color: #fff;">Eventos</p>
                    </a>
            </li>
            <?php
            if($_SESSION['nivelUsuario'] >= 10){
                echo '<li class="nav-item ">
            <a class="nav-link" href="cadastro_evento.php">
              <i class="material-icons">content_paste</i>
              <p>Criar evento</p>
            </a>
          </li>';
            }
            ?>
            <li class="nav-item ">
                <a class="nav-link" href="#">
                    <i class="material-icons">library_books</i>
                    <p>Sobre</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link">
                    <i class="material-icons"></i>
                    <p>Outros</p>
                </a>
            </li>
            <?php
            if($_SESSION['nivelUsuario'] >= 10){
                echo '<li class="nav-item ">
            <a class="nav-link" href="meus_eventos.php">
              <i class="material-icons">person</i>
              <p>Gerenciar meus eventos</p>
            </a>
          </li>';
            }
            ?>
            <li class="nav-item ">
                <a class="nav-link" href="inscricoes.php">
                    <i class="material-icons">person</i>
                    <p>Minhas inscrições</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="missoes.php">
                    <i class="material-icons">person</i>
                    <p>Minhas missões</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="skins.php">
                    <i class="material-icons">person</i>
                    <p>Minhas skins</p>
                </a>
            </li>
            <?php if($_SESSION['nomeUsuario'] == "ADM"){echo '<li class="nav-item active-pro ">
            <div class="nav-link" href="">
              <i class="material-icons">book</i>
              <p>ADM on!</p>
            </div>
          </li>';}else{echo '';} ?>

        </ul>
    </div>
</div>
