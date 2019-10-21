<?php
include 'condicaoCores2.php';
?>
<div class="fixed-plugin" style="margin-top: 5%">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i style="font-size: 120%;color: white;">ADM</i>
        </a>
        <ul class="dropdown-menu" style="overflow-y: scroll;overflow-x: hidden; height: 300px;">
            <li class="header-title"> Menu do Administrador</li>
            <label style="font-size: 66%; margin-left: 15%;">Aqui possui opções excluisivas de ADM</label><br>
            <li class="header-title">Adicionar recompensas</li>
            <li class="button-container">
                <a target="_blank" class="btn btn-default btn-block" style="<?php echo $cor; ?>" id="modal-tema" href="#modal-container-tema" role="button" data-toggle="modal">Temas</a>
            </li>
            <li class="button-container">

                <a target="_blank" class="btn btn-default btn-block" style="<?php echo $cor; ?>" id="modal-skin" href="#modal-container-skin" role="button" data-toggle="modal">Skins</a>


            </li>
            <li class="header-title">Consultar tabelas do BD</li>
            <li class="button-container">
                <form method="post" action="consultaTabelasBD.php">
                    <input type="submit" name="tabelaUsuarios" target="_blank" class="btn btn-default btn-block" style="<?php echo $cor; ?>" value="Usuarios">
                </form>
            </li>
            <li class="button-container">
                <form method="post" action="consultaTabelasBD.php" style="margin-top: -4%">
                    <input type="submit" name="tabelaEventos" target="_blank" class="btn btn-default btn-block" style="<?php echo $cor; ?>" value="Eventos">
                </form>
            </li>
            <li class="button-container">
                <form method="post" action="consultaTabelasBD.php" style="margin-top: -4%">
                    <input type="submit" name="tabelaMissoes" target="_blank" class="btn btn-default btn-block" style="<?php echo $cor; ?>" value="Missoes">
                </form>
            </li>
        </ul>
    </div>
</div>
