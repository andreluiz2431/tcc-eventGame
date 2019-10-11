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
        include '../conexaoBDpdoPOO.php';
    }

    public function inserir(){

        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare("INSERT INTO usuario (nomeUsuario, senhaUsuario, emailUsuario, pontuacaoLUsuario, idRecomensa, nivelUsuario, temaUsuario, skinUsuario) VALUES(:nomeUsuario, :senhaUsuario, :emailUsuario, :pontuacaoLUsuario, :idRecomensa, :nivelUsuario, :temaUsuario, :skinUsuario)");
            $stmt->execute(array(
                ':nomeUsuario' => "$this->nome", ':senhaUsuario' => "$this->senha", ':emailUsuario' => "$this->email", ':pontuacaoLUsuario' => "$this->pontuacao", ':idRecomensa' => $this->recompensa, ':nivelUsuario' => $this-nivel, ':temaUsuario' => $this->tema, ':skinUsuario' => $this->skin
            ));

            echo $stmt->rowCount(); 
            echo"<script>window.location.href = \"pagina_eventos.php\";</script>";
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function alterarDadosUsuario($id, $nome, $email){

        $this->conectarBD();

        $consultadados = $this->pdo->query("SELECT senhaUsuario FROM usuario WHERE idUsuario = $id");

        while ($linhadados = $consultadados->fetch(PDO::FETCH_ASSOC)) {
            $senha = $linhadados['senhaUsuario'];
        }

        try {
            $this->conectarBD();

            $stmt = $this->pdo->prepare('UPDATE usuario SET nomeUsuario = :nomeUsuario, senhaUsuario = :senhaUsuario, emailUsuario = :emailUsuario WHERE idUsuario = :idUsuario');
            $stmt->execute(array(
                ':idUsuario'   => $id,
                ':nomeUsuario' => $nome,
                ':senhaUsuario' => $senha,
                ':emailUsuario'   => $email
            ));

            echo "<label style='color:red'>Dados alterados com sucesso!</label>";
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function alterarSenhaUsuario($id, $senhaAtual, $senhaNova){

        $this->conectarBD();

        $consultadados = $this->pdo->query("SELECT * FROM usuario WHERE idUsuario = $id");

        while ($linhadados = $consultadados->fetch(PDO::FETCH_ASSOC)) {
            $nome = $linhadados['nomeUsuario'];
            $email = $linhadados['emailUsuario'];
            $senha = $linhadados['senhaUsuario'];
        }

        if($senha == md5($senhaAtual)){
            try {
                $this->conectarBD();

                $stmt = $this->pdo->prepare('UPDATE usuario SET nomeUsuario = :nomeUsuario, senhaUsuario = :senhaUsuario, emailUsuario = :emailUsuario WHERE idUsuario = :idUsuario');
                $stmt->execute(array(
                    ':idUsuario'   => $id,
                    ':nomeUsuario' => $nome,
                    ':senhaUsuario' => md5($senhaNova),
                    ':emailUsuario'   => $email
                ));

                echo "<label style='color:red'>Senha alterada com sucesso!</label>";
            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }else{
            echo "<label style='color:red'>Senha atual incorreta!</label>";
        }
    }

    public function login(){
        $this->conectarBD();

        $consulta = $this->pdo->query("SELECT * FROM usuario;")or die('Erro na busca por usuário');
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

                $ver = true;

                echo "<script language='javascript' type='text/javascript'> alert('Login efetuado com sucesso!');</script>";
                echo "<script>window.location.href = \"pagina_eventos.php\";</script>";
                break;
            }
        }
        if($ver == false){
            echo"<script language='javascript' type='text/javascript'> alert('E-mail ou senha incorretos, ou você não possui cadastro');</script>";
        }
    }
}
?>
