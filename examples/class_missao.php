<?php
class Missao{
    public $id;
    public $titulo;
    public $sobre;
    public $idevento;
    public $recompensa;
    
    public $pdo;
    
    public function conectarBD(){
        $this->pdo = new PDO('mysql:host=localhost;dbname=id10730896_banco', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public function inserir(){
        
        try {
            $this->conectarBD();
   
        $stmt = $this->pdo->prepare("INSERT INTO missao (tituloMissao, sobreMissao, idRecomensa) VALUES(:tituloMissao, :sobreMissao, :idRecomensa)");
            $stmt->execute(array(
              ':tituloMissao' => "$this->titulo",
                ':sobreMissao' => "$this->sobre",
                ':idRecomensa' => "$this->recompensa"
                ));
   
        return $this->pdo->lastInsertId();
        
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return -1;
        }
    }
    
    public function inserir_intermediaria($idMissao, $idEvento){
        //consulta de id de evento
        $this->conectarBD();
  
        $consulta = $this->pdo->query("SELECT idEvento FROM Evento;");
  
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $this->idevento = $linha['idEvento'];
        }
        
        //para intermediaria MissaoEvento
        try {
            $this->conectarBD();
   
        $stmt = $this->pdo->prepare("INSERT INTO missaoevento (idMissao, idEvento) VALUES(:idMissao, :idEvento)");
            $stmt->execute(array(
              ':idMissao' => $idMissao,
                ':idEvento' => $idEvento
                ));
   
            echo $stmt->rowCount(); 
            echo "<script language='javascript' type='text/javascript'> alert('Cadastro de evento efetuado com sucesso!');</script>";
            echo"<script>window.location.href = \"pagina_eventos.php\";</script>";
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function recompensas_cadastradas(){
        $this->conectarBD();
  
        $consulta = $this->pdo->query("SELECT * FROM recompensa;");
  
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$linha['idRecomensa']."'>".$linha['nomeReompensa']."</option>";
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
        $pdo = new PDO('mysql:host=localhost;dbname=id10120250_banco', 'id10120250_root', 'andre2001');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
        $consulta = $pdo->query("SELECT idUsuario, nomeUsuario, senhaUsuario, emailUsuario, pontuacaoLUsuario FROM Usuario;");
  
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "<b>ID:</b> {$linha['idUsuario']}, <b>Nome:</b> {$linha['nomeUsuario']}, <b>Email:</b> {$linha['emailUsuario']}, <b>Pontos:</b> {$linha['pontuacaoLUsuario']}<br />";
        }
    }
}
?>