<?php

class conecta {
    private $conn;
    
    
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:dbname=crud;host=localhost","root",""); 
            
        } catch (PDOException $exc) {
            echo "Erro ao Acessar o Banco ". $exc->getMessage();
        } catch (PDOException $ex){
            echo "Erro Generico".$ex->getMessage();
        }
    }
    
}



