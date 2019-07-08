        <?php
        
        //=======CONEXAO COM BANCO ================// 
        
        try {
            $con = new PDO("mysql:dbname=crud;host=localhost;charset=utf8","root","");
        } catch (PDOException $exc) {
            echo "Erro no Banco ".$exc->getMessage();
        } catch (PDOException $exc) {
            echo "Erro generico " .$exc->getMessage();
        } 
              
        //=======INSERT NO BANCO ================
        $dados = array('Jr','999998888','jr@gmail.com');
       
        $stmt = $con->prepare("INSERT INTO cliente (nome, telefone,email) VALUES (?,?,?)");
        $stmt->execute($dados);

       
//        $stmt->bindValue(':N',"FAND");
//        $stmt->bindValue(':F', 912218888);
//        $stmt->bindValue(':M', "fand@gmail.com");
//        $stmt->execute();
        
        /*=======DELETE NO BANCO ================
        $stmt = $con->prepare("DELETE FROM cliente WHERE id = :ID");
        $stmt->bindValue(':ID', 2);
        $stmt->execute();
        */
        
        /*=======UPDATE NO BANCO ================
        $stmt = $con->prepare("UPDATE cliente SET nome=:N WHERE id=:ID");
        $stmt->bindValue(':N', "DAVI");
        $stmt->bindValue(':ID', 1);
        $stmt->execute();*/
        
        /*=======SELECT NO BANCO ================
        $stmt = $con->prepare("SELECT * FROM cliente WHERE id=:ID");
        $stmt->bindValue(':ID', 3);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value) {
            echo $key.": ".$value."<br>";
        }*/
        ?>

