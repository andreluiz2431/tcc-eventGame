<?php
class ADM{
    public $pdo;

    public function conectarBD(){
        include '../conexaoBDpdoPOO.php';
    }

    public function consultarUsuarios(){
        include 'condicaoCores2.php';

        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM usuario");

        echo '<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-primary" style="'.$cor.'">
                                        <h4 class="card-title ">Usuários</h4>
                                        <p class="card-category">Dados registrados na tabela do Banco de Dados</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" style="overflow-x: scroll;width: 100%;">
                                                <thead class=" text-primary">
                                                    <th>
                                                        ID
                                                    </th>
                                                    <th>
                                                        Nome
                                                    </th>
                                                    <th>
                                                        E-mail
                                                    </th>
                                                    <th>
                                                        Pontos
                                                    </th>
                                                    <th>
                                                        Nível
                                                    </th>
                                                    <th>
                                                        Tema aplicada
                                                    </th>
                                                    <th>
                                                        Skin
                                                    </th>
                                                </thead>
                                                <tbody>';

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $idUsuario = $linha['idUsuario'];
            $nomeUsuario = $linha['nomeUsuario'];
            $emailUsuario = $linha['emailUsuario'];
            $pontuacaolUsuario = $linha['pontuacaolUsuario'];
            $nivelUsuario = $linha['nivelUsuario'];
            $temaUsuario = $linha['temaUsuario'];
            $skinUsuario = $linha['skinUsuario'];

            echo '<tr>
                                                        <td>
                                                            '.$idUsuario.'
                                                        </td>
                                                        <td>
                                                            '.$nomeUsuario.'
                                                        </td>
                                                        <td>
                                                            '.$emailUsuario.'
                                                        </td>
                                                        <td>
                                                            '.$pontuacaolUsuario.'
                                                        </td>
                                                        <td>
                                                            '.$nivelUsuario.'
                                                        </td>
                                                        <td>
                                                            '.$temaUsuario.'
                                                        </td>
                                                        <td>
                                                            '.$skinUsuario.'
                                                        </td>
                                                    </tr>';
        }
        echo '</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
    }

    public function consultarEventos(){
        include 'condicaoCores2.php';

        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM evento");

        echo '<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-primary" style="'.$cor.'">
                                        <h4 class="card-title ">Eventos</h4>
                                        <p class="card-category">Dados registrados na tabela do Banco de Dados</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" style="overflow-x: scroll;width: 1800px;">
                                                <thead class=" text-primary">
                                                    <th>
                                                        ID
                                                    </th>
                                                    <th>
                                                        Título
                                                    </th>
                                                    <th>
                                                        Anfitrião
                                                    </th>
                                                    <th>
                                                        Data de início
                                                    </th>
                                                    <th>
                                                        Data de encerramento
                                                    </th>
                                                    <th>
                                                        Hora de início
                                                    </th>
                                                    <th>
                                                        Hora de encerramento
                                                    </th>
                                                    <th>
                                                        Local
                                                    </th>
                                                    <th>
                                                        Cidade
                                                    </th>
                                                    <th>
                                                        UF
                                                    </th>
                                                    <th>
                                                        País
                                                    </th>
                                                    <th>
                                                        Área
                                                    </th>
                                                    <th>
                                                        Sobre
                                                    </th>
                                                </thead>
                                                <tbody>';

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $idEvento = $linha['idEvento'];
            $tituloEvento = $linha['tituloEvento'];
            $idUsuario = $linha['idUsuario'];
            $dataInicioEvento = $linha['dataInicioEvento'];
            $dataFimEvento = $linha['dataFimEvento'];
            $horaInicioEvento = $linha['horaInicioEvento'];
            $horaFimEvento = $linha['horaFimEvento'];
            $localEvento = $linha['localEvento'];
            $cidadeEvento = $linha['cidadeEvento'];
            $estadoEvento = $linha['estadoEvento'];
            $paisEvento = $linha['paisEvento'];
            $areaAcademicaEvento = $linha['areaAcademicaEvento'];
            $sobreEvento = $linha['sobreEvento'];

            echo '<tr>
                                                        <td>
                                                            '.$idEvento.'
                                                        </td>
                                                        <td>
                                                            '.$tituloEvento.'
                                                        </td>
                                                        <td>
                                                            '.$idUsuario.'
                                                        </td>
                                                        <td>
                                                            '.$dataInicioEvento.'
                                                        </td>
                                                        <td>
                                                            '.$dataFimEvento.'
                                                        </td>
                                                        <td>
                                                            '.$horaInicioEvento.'
                                                        </td>
                                                        <td>
                                                            '.$horaFimEvento.'
                                                        </td>
                                                        <td>
                                                            '.$localEvento.'
                                                        </td>
                                                        <td>
                                                            '.$cidadeEvento.'
                                                        </td>
                                                        <td>
                                                            '.$estadoEvento.'
                                                        </td>
                                                        <td>
                                                            '.$paisEvento.'
                                                        </td>
                                                        <td>
                                                            '.$areaAcademicaEvento.'
                                                        </td>
                                                        <td>
                                                            '.$sobreEvento.'
                                                        </td>
                                                    </tr>';

        }

        echo '</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
    }

    public function consultarMissoes(){
        include 'condicaoCores2.php';

        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM missao");

        echo '<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-primary" style="'.$cor.'">
                                        <h4 class="card-title ">Missões</h4>
                                        <p class="card-category">Dados registrados na tabela do Banco de Dados</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" style="overflow-x: scroll;width: 100%;">
                                                <thead class=" text-primary">
                                                    <th>
                                                        ID
                                                    </th>
                                                    <th>
                                                        Título
                                                    </th>
                                                    <th>
                                                        Sobre
                                                    </th>
                                                    <th>
                                                        ID Recompensa
                                                    </th>
                                                </thead>
                                                <tbody>';

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $idMissao = $linha['idMissao'];
            $tituloMissao = $linha['tituloMissao'];
            $sobreMissao = $linha['sobreMissao'];
            $idRecomensa = $linha['idRecomensa'];

            echo '<tr>
                                                        <td>
                                                            '.$idMissao.'
                                                        </td>
                                                        <td>
                                                            '.$tituloMissao.'
                                                        </td>
                                                        <td>
                                                            '.$sobreMissao.'
                                                        </td>
                                                        <td>
                                                            '.$idRecomensa.'
                                                        </td>
                                                        </tr>';
        }

        echo '</tbody></table></div></div></div></div></div>';
    }

    public function inserirTemas($nome, $propriedade, $custo){
        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare("INSERT INTO recompensa (tipoRecompensa, nomeReompensa, propriedadeRecompensa, custoRecompensa) VALUES('tema', '".$nome."', '".$propriedade."', '".$custo."')");

            $stmt->execute(array(
                ':tipoRecompensa' => 'tema'
            ));

            include 'class_notificacao.php';

            $notificacao = new Notificacao();

            $notificacao->inserirNotificacaoPublica('Olha só, tema '.$nome.' adicionado no sistema!');

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return -1;
        }
    }

    public function inserirSkins($nome, $propriedade, $custo){
        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare("INSERT INTO recompensa (tipoRecompensa, nomeReompensa, propriedadeRecompensa, custoRecompensa) VALUES('skin', '".$nome."', '".$propriedade."', '".$custo."')");

            $stmt->execute(array(
                ':tipoRecompensa' => 'skin'
            ));

            include 'class_notificacao.php';

            $notificacao = new Notificacao();

            $notificacao->inserirNotificacaoPublica('Nossa, skin '.$nome.' adicionada no sistema!');

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return -1;
        }
    }
}
?>
