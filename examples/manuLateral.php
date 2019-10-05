    <div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-1.jpg">
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
          <li class="nav-item active">
            <a class="nav-link" href="./pagina_eventos.php">
              <i class="material-icons">dashboard</i>
              <p>Eventos</p>
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
            <a class="nav-link" href="#">
              <i class="material-icons">person</i>
              <p>Minhas skins</p>
            </a>
          </li>
          <li class="nav-item active-pro ">
            <a class="nav-link" href="#">
              <i class="material-icons">unarchive</i>
              <p>slaaaaa</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
