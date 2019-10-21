<?php
class ADM{
    public $pdo;

    public function conectarBD(){
        include '../conexaoBDpdoPOO.php';
    }

    public function consultarUsuarios(){
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM usuario");

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $idUsuario = $linha['idUsuario'];
            $nomeUsuario = $linha['nomeUsuario'];
            $emailUsuario = $linha['emailUsuario'];
            $pontuacaolUsuario = $linha['pontuacaolUsuario'];
            $nivelUsuario = $linha['nivelUsuario'];
            $temaUsuario = $linha['temaUsuario'];
            $skinUsuario = $linha['skinUsuario'];
        }
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
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM missao");

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $idMissao = $linha['idMissao'];
            $tituloMissao = $linha['tituloMissao'];
            $sobreMissao = $linha['sobreMissao'];
            $idRecomensa = $linha['idRecomensa'];
        }
    }

    public function inserirTemas($nome){ // falta planejar
        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare("INSERT INTO recompensa (tipoRecompensa, nomeReompensa) VALUES('tema', '".$nome."')");

            $stmt->execute(array(
                ':tipoRecompensa' => 'tema'
            ));

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return -1;
        }
    }

    public function inserirSkins($nome){ // falta planejar
        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare("INSERT INTO recompensa (tipoRecompensa, nomeReompensa) VALUES('skin', '".$nome."')");

            $stmt->execute(array(
                ':tipoRecompensa' => 'skin'
            ));

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return -1;
        }
    }
}
?>
