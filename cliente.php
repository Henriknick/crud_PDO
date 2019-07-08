<?php


class cliente {
    //atributos
    private $pdo;
    //Métodos
    public function __construct($dbname,$host,$user,$senha) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
        } catch (PDOException $exc) {
            echo "Erro ao conectar no banco ".$exc->getMessage();
        } catch (PDOException $exc){
            echo "Erro generico ".$exc->getMessage();
        }      
    }
    
    //-----METODO BUSCAR DADOS NO BANCO -----------
    public function buscarDados() {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM cliente ORDER BY id");
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    //-----METODO CADASTRA$R DADOS NO BANCO -----------
    public function cadastrarDados($nome,$fone,$email){
        //VERIFICAR SE JÁ EXISTE EMAIL CADASTRADO NO BANCO
        $cmd = $this->pdo->prepare("SELECT id from cliente WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();
        if($cmd->rowCount()>0){
            return false;
        } else {
            //CADASTRA NOVO USUARIO NO BANCO
            $cmd = $this->pdo->prepare("INSERT INTO cliente (nome,telefone,email) WHERE (:n,:t,:e)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $fone);
            $cmd->bindValue(":e", $email);
            $cmd->execute();
            return true;
        }
        
    }
}
