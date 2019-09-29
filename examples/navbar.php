<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="#"><?php echo utf8_encode($nome); ?></a>
            <a class="navbar-brand" href="#">Nível <?php echo $nivel; ?></a>
            <a class="navbar-brand" href="#">Pontos <?php echo $pontos; ?></a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form" method="post" action="pagina_eventos.php">
                <div class="input-group no-border">
                    <input type="text" name="busca" class="form-control" placeholder="Pesquisar...">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">notifications</i>
                        <span class="notification">5</span>
                        <p class="d-lg-none d-md-block">
                            Some Actions
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Inscrito no evento tall</a>
                        <a class="dropdown-item" href="#">...</a>
                        <a class="dropdown-item" href="#">Notificações aqui!</a>
                        <a class="dropdown-item" href="#">...</a>
                        <a class="dropdown-item" href="#">...</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                            Conta
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="user.php">Perfil</a>
                        <a class="dropdown-item" href="#">Configurações</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="sair.php">Sair</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
