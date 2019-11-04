<?php

// muitos problemas

class Notificacao{
    public $pdo;

    public function conectarBD(){
        include '../conexaoBDpdoPOO.php';
    }

    public function contarNotificacoes($autor){
        $this->conectarBD();

        $numero = $this->pdo->query("SELECT * FROM notificacao WHERE (autor = ".$autor.") or (autor = 0)")->rowCount();

        return $numero;
    }

    public function verNotificacao($autor){ // ver apenas as 10 ultimas
        // ver todos no qual autor eh equivalente ao usuario logado ou igual a 0;
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM notificacao WHERE (autor = ".$autor.") or (autor = 0) order by autor desc");

        $contador = 0;
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            if(isset($linha['notificacao'])){
                $notificacao = $linha['notificacao'];

                $contador++;

                echo '<label class="dropdown-item">'.$notificacao.'</label>';

                if($contador >= 10){
                    break;
                }
            }
        }
        if($contador == 0){
            echo '<label class="dropdown-item"><i>Sem notificações</i></label>';
        }
    }

    public function inserirNotificacaoPublica($texto){ // inserir todas ações publicas no qual todos usuários podem saber (exemplo: eventos criados)
        // autor igual a 0
        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare("INSERT INTO notificacao (notificacao, autor) VALUES ('".$texto."', 0)");
            $stmt->execute(array(
                ':notificacao' => "$texto"
            ));

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return -1;
        }
    }

    public function inserirNotificacaoPrivada($texto, $autor){ // inserir todas ações privadas (exemplo: troca de tema, se inscreveu...)
        // autor igual a seu identificador
        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare("INSERT INTO notificacao (notificacao, autor) VALUES ('".$texto."', ".$autor.")");
            $stmt->execute(array(
                ':notificacao' => "$texto"
            ));

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return -1;
        }
    }
}
?>
