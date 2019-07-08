<?php

class crud_cliente {
    
    private $conn;//-----------PREPARA CONEXAO COM O BANCO---------------------
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:dbname=crud;host=localhost","root","");
        } catch (PDOException $ex) {
            echo "Erro ao conectar no banco" . $ex->getMessage();
        }
    }
    
    //-----------FUNÇÃO BUSCAR DADOS NO BANCO---------------------------
    public function buscar() {
        $cmd = $this->conn->prepare("SELECT * FROM cliente ORDER BY id");
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    //-----------FUNÇÃO CADASTRAR NO BANCO---------------------------
    public function cadastrar($nome,$fone,$email) {
        //---VERIFICA SE EXISTE EMAIL DE USUARIO NO BANCO --------
        $cmd = $this->conn->prepare("SELECT id FROM cliente WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();
        if($cmd->rowCount()>0){//---email já existe no banco
            return false;
        } else {//---email não encontrado
            $cmd = $this->conn->prepare("INSERT INTO cliente (nome,telefone,email)VALUES(:n,:t,:e)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $fone);
            $cmd->bindValue(":e", $email);
            $cmd->execute();
            return true;
        }     
    }
    
    //-----------FUNÇÃO EXCLUIR NO BANCO---------------------------
    public function excluir($id) {
        $cmd = $this->conn->prepare("DELETE FROM cliente WHERE id=:id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }
    
    //-----------FUNÇÃO BUSCA NO BANCO PARA EDIT-------------------
    public function buscaUpdate($id) {
        $cmd = $this->conn->prepare("SELECT * FROM cliente WHERE id=:id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    
    //-----------FUNÇÃO ATUALIZAR NO BANCO ------------------------
    public function editar($id,$nome,$telefone,$email){
        $cmd = $this->conn->prepare("UPDATE cliente SET nome=:n, telefone=:t, email=:e WHERE id=:id");
        $cmd->bindValue(":id", $id);
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":t", $telefone);
        $cmd->bindValue(":e", $email);
        $cmd->execute();
    }
}
