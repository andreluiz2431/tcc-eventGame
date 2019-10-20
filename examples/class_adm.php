<?php
class ADM{
    public $pdo;

    public function conectarBD(){
        include 'conexaoBDpdoPOO.php';
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
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM evento");

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
        }
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

    public function inserirTemas(){ // falta planejar

    }

    public function inserirSkins(){ // falta planejar

    }
}
?>
