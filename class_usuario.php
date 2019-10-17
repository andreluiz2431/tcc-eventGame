<?php
class Usuario{
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $pontuacao;
    public $recompensa;
    public $nivel;
    public $tema;
    public $skin;

    public $pdo;

    public function __construct(){
        $this->pontuacao = 10;
        $this->nivel = 1;
    }

    public function conectarBD(){
        include 'conexaoBDpdoPOO.php';
    }

    public function inserir(){

        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare("INSERT INTO usuario (nomeUsuario, senhaUsuario, emailUsuario, pontuacaoLUsuario, idRecomensa, nivelUsuario, temaUsuario, skinUsuario) VALUES(:nomeUsuario, :senhaUsuario, :emailUsuario, :pontuacaoLUsuario, :idRecomensa, :nivelUsuario, :temaUsuario, :skinUsuario)");
            $stmt->execute(array(
                ':nomeUsuario' => "$this->nome", ':senhaUsuario' => "$this->senha", ':emailUsuario' => "$this->email", ':pontuacaoLUsuario' => "$this->pontuacao", ':idRecomensa' => $this->recompensa, ':nivelUsuario' => $this-nivel, ':temaUsuario' => 7, ':skinUsuario' => 3
            ));

            echo $stmt->rowCount(); 
            echo"<script>window.location.href = 'index.php';</script>";
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function login(){
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM usuario")or die('Erro na busca por usuário');
        $ver = false;
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            if(($_POST["email"] == $linha['emailUsuario']) && (md5($_POST["senha"]) == $linha['senhaUsuario'])){


                $_SESSION['idUsuario'] = $linha['idUsuario'];
                $_SESSION['emailUsuario'] = $linha['emailUsuario'];
                $_SESSION['senhaUsuario'] = $linha['senhaUsuario'];
                $_SESSION['nomeUsuario'] = $linha['nomeUsuario'];
                $_SESSION['pontuacaolUsuario'] = $linha['pontuacaolUsuario'];
                $_SESSION['idRecomensa'] = $linha['idRecomensa'];
                $_SESSION['nivelUsuario'] = $linha['nivelUsuario'];

                // definir qual o tema do usuario
                $this->conectarBD();

                $consultaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$linha['temaUsuario']."");

                while ($linhaRecompensa = $consultaRecompensa->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION['temaAplicada'] = $linhaRecompensa['nomeReompensa'];
                }

                // definir qual a skin do usuario
                $this->conectarBD();

                $consultaRecompensa1 = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$linha['skinUsuario']."");

                while ($linhaRecompensa1 = $consultaRecompensa1->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION['skinAplicada'] = $linhaRecompensa1['nomeReompensa'];
                }

                $this->levelUp($linha['idUsuario']);

                $ver = true;

                echo "<script language='javascript' type='text/javascript'> alert('Login efetuado com sucesso!');</script>";
                echo "<script>window.location.href = \"examples/pagina_eventos.php\";</script>";
                break;
            }
        }
        if($ver == false){
            echo"<script language='javascript' type='text/javascript'> alert('E-mail ou senha incorretos, ou você não possui cadastro');</script>";
        }
    }

    public function levelUp($idUsuario){
        // consulta de progressos
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM progressomissao WHERE idUsuario = ".$idUsuario."");

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $progresso = $linha['progressoMissao'];

            // condição caso progresso em 100%, e contar quantos em 100% para dar level UP
            $contador = 0;
            if($progresso == 100){
                $contador++;
            }
        }

        // consulta de nivel
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT nivelUsuario FROM usuario WHERE idUsuario = ".$idUsuario."");

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $nivel = $linha['nivelUsuario'];
        }

        // se determinada quantidade de progressos em 100% dar level UP para tall nível
        if($contador == 1 && $contador < 2 && $nivel == 1){
            // upar para level 2, e ganhar 20 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET nivelUsuario="2" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 2
                ));

                session_start();
                $_SESSION['nivelUsuario'] = 2;
                echo"<script language='javascript' type='text/javascript'> alert('Nível aumentado para 2!');</script>"; // pensar a respeito
                return 'Level UP 2';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 3 && $contador <= 5 && $nivel == 2){
            // upar para level 3, e ganhar 30 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET nivelUsuario="3" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 3
                ));

                session_start();
                $_SESSION['nivelUsuario'] = 3;
                return 'Level UP 3';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 6 && $contador <= 8 && $nivel == 3){
            // upar para level 4, e ganhar 40 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET nivelUsuario="4" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 4
                ));


                session_start();
                $_SESSION['nivelUsuario'] = 4;
                return 'Level UP 4';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 9 && $contador <= 11 && $nivel == 4){
            // upar para level 5, e ganhar 50 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET nivelUsuario="5" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 5
                ));


                session_start();
                $_SESSION['nivelUsuario'] = 5;
                return 'Level UP 5';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 12 && $contador <= 14 && $nivel == 5){
            // upar para level 6, e ganhar 60 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET nivelUsuario="6" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 6
                ));


                session_start();
                $_SESSION['nivelUsuario'] = 6;
                return 'Level UP 6';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 15 && $contador <= 17 && $nivel == 6){
            // upar para level 7, e ganhar 70 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET nivelUsuario="7" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 7
                ));


                session_start();
                $_SESSION['nivelUsuario'] = 7;
                return 'Level UP 7';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 18 && $contador <= 20 && $nivel == 7){
            // upar para level 8, e ganhar 80 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET nivelUsuario="8" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 8
                ));


                session_start();
                $_SESSION['nivelUsuario'] = 8;
                return 'Level UP 8';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 21 && $contador <= 23 && $nivel == 8){
            // upar para level 9, e ganhar 90 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET nivelUsuario="9" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 9
                ));


                session_start();
                $_SESSION['nivelUsuario'] = 9;
                return 'Level UP 9';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }elseif($contador >= 24 && $contador <= 26 && $nivel == 9){
            // upar para level 10, e ganhar 100 pontos
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET nivelUsuario="10" WHERE idUsuario = '.$idUsuario.'');
                $stmt->execute(array(
                    ':nivelUsuario'   => 10
                ));


                session_start();
                $_SESSION['nivelUsuario'] = 10;
                return 'Level UP 10';

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}
?>
