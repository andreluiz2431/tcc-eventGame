<?php
class Recompensa{
    public $pdo;

    public function conectarBD(){
        include '../conexaoBDpdoPOO.php';
    }

    public function vizualizarTemas(){ // mostrar primeiro as disponiveis depois as indisponiveis
        session_start();
        // consulta de disponiveis
        $this->conectarBD();

        $consultaRecompensaDisponivel = $this->pdo->query("SELECT * FROM recompensadispoivel WHERE idUsuario = ".$_SESSION['idUsuario']."");

        while ($linhaRecompensaDisponivel = $consultaRecompensaDisponivel->fetch(PDO::FETCH_ASSOC)) {
            $idRecompensa = $linhaRecompensaDisponivel['idRecomensa'];

            // ver todas as recompensas disponiveis
            $this->conectarBD();

            $consutaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$idRecompensa."");

            while ($linhaRecompensa = $consutaRecompensa->fetch(PDO::FETCH_ASSOC)){
                if ($linhaRecompensa['tipoRecompensa'] == 'tema'){
                    echo 'Disponiveis'.$linhaRecompensa['idRecomensa'].'<br>'; // vizualização dos dados
                }
            }
        }

        // ver todos temas menos os ja disponiveis
        $this->conectarBD();

        $consutaRecompensaT = $this->pdo->query("SELECT * FROM recompensa");

        while ($linhaRecompensaT = $consutaRecompensaT->fetch(PDO::FETCH_ASSOC)){
            if ($linhaRecompensaT['idRecomensa'] != $idRecompensa && $linhaRecompensaT['tipoRecompensa'] == 'tema'){
                echo 'Indisponiveis'.$linhaRecompensaT['idRecomensa'].'<br>'; // vizualização dos dados
            }
        }
    }

    public function vizualizarSkins(){ // mostrar primeiro as disponiveis depois as indisponiveis
        session_start();
        // consulta de disponiveis
        $this->conectarBD();

        $consultaRecompensaDisponivel = $this->pdo->query("SELECT * FROM recompensadispoivel WHERE idUsuario = ".$_SESSION['idUsuario']."");

        while ($linhaRecompensaDisponivel = $consultaRecompensaDisponivel->fetch(PDO::FETCH_ASSOC)) {
            $idRecompensa = $linhaRecompensaDisponivel['idRecomensa'];

            // ver todas as recompensas disponiveis
            $this->conectarBD();

            $consutaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$idRecompensa."");

            while ($linhaRecompensa = $consutaRecompensa->fetch(PDO::FETCH_ASSOC)){
                if ($linhaRecompensa['tipoRecompensa'] == 'skin'){
                    echo 'Disponiveis'.$linhaRecompensa['idRecomensa'].'<br>'; // vizualização dos dados
                }
            }
        }

        // ver todos temas menos os ja disponiveis
        $this->conectarBD();

        $consutaRecompensaT = $this->pdo->query("SELECT * FROM recompensa");

        while ($linhaRecompensaT = $consutaRecompensaT->fetch(PDO::FETCH_ASSOC)){
            if ($linhaRecompensaT['idRecomensa'] != $idRecompensa && $linhaRecompensaT['tipoRecompensa'] == 'skin'){
                echo 'Indisponiveis'.$linhaRecompensaT['idRecomensa'].'<br>'; // vizualização dos dados
            }
        }
    }
}
?>
