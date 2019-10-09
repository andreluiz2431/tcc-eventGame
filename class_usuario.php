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
        $this->pdo = new PDO('mysql:host=localhost;dbname=id10730896_banco', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function inserir(){

        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare("INSERT INTO usuario (nomeUsuario, senhaUsuario, emailUsuario, pontuacaoLUsuario, idRecomensa, nivelUsuario, temaUsuario, skinUsuario) VALUES(:nomeUsuario, :senhaUsuario, :emailUsuario, :pontuacaoLUsuario, :idRecomensa, :nivelUsuario, :temaUsuario, :skinUsuario)");
            $stmt->execute(array(
                ':nomeUsuario' => "$this->nome", ':senhaUsuario' => "$this->senha", ':emailUsuario' => "$this->email", ':pontuacaoLUsuario' => "$this->pontuacao", ':idRecomensa' => $this->recompensa, ':nivelUsuario' => $this-nivel, ':temaUsuario' => $this->tema, ':skinUsuario' => $this->skin
            ));

            echo $stmt->rowCount(); 
            echo"<script>window.location.href = 'index.php';</script>";
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function deletar(){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=id10120250_banco', 'id10120250_root', 'andre2001');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('DELETE FROM Usuario WHERE idUsuario = :idUsuario');
            $stmt->bindParam(':idUsuario', $this->id);
            $stmt->execute();

            echo $stmt->rowCount();
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function alterar(){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=id10120250_banco', 'id10120250_root', 'andre2001');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('UPDATE Usuario SET nomeUsuario = :nomeUsuario, senhaUsuario = :senhaUsuario, emailUsuario = :emailUsuario WHERE idUsuario = :idUsuario');
            $stmt->execute(array(
                ':idUsuario'   => $this->id,
                ':nomeUsuario' => $this->nome,
                ':senhaUsuario' => $this->senha,
                ':emailUsuario'   => $this->email
            ));

            echo $stmt->rowCount();
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function consultar(){
        $pdo = new PDO('mysql:host=localhost;dbname=id10120250_banco', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $pdo->query("SELECT idUsuario, nomeUsuario, senhaUsuario, emailUsuario, pontuacaoLUsuario FROM Usuario;");

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "<b>ID:</b> {$linha['idUsuario']}, <b>Nome:</b> {$linha['nomeUsuario']}, <b>Email:</b> {$linha['emailUsuario']}, <b>Pontos:</b> {$linha['pontuacaoLUsuario']}<br />";
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
                $_SESSION['temaUsuario'] = $linha['temaUsuario'];
                $_SESSION['skinUsuario'] = $linha['skinUsuario'];


                // pegar skin ou tema disponivel do usuario
                $this->conectarBD();

                $consultaRecompensaDisponivel = $this->pdo->query("SELECT * FROM recompensadispoivel WHERE idUsuario = ".$linha['idUsuario']."")or die('Erro na busca por recompensa disponivel');

                while ($linhaRecompensaDisponivel = $consultaRecompensaDisponivel->fetch(PDO::FETCH_ASSOC)) {
                    $recompensaAplicada = $linhaRecompensaDisponivel['idRecomensa'];
                }

                // definir o que é tema ou skin
                $this->conectarBD();

                $consultaRecompensa = $this->pdo->query("SELECT * FROM recompensa WHERE idRecomensa = ".$recompensaAplicada."")or die('Erro na busca por recompensa');

                while ($linhaRecompensa = $consultaRecompensa->fetch(PDO::FETCH_ASSOC)) {
                    $tipoRecompensa = $linhaRecompensa['tipoRecompensa'];

                    if($tipoRecompensa == 'skin'){
                        $_SESSION['skinAplicada'] = $linhaRecompensa['nomeReompensa'];
                    } elseif ($tipoRecompensa == 'tema'){
                        $_SESSION['temaAplicada'] = $linhaRecompensa['nomeReompensa'];
                    }else{
                        $_SESSION['skinAplicada'] = 0;
                        $_SESSION['temaAplicada'] = 'Purple';
                    }
                }


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
}
?>
