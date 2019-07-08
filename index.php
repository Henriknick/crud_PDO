<!DOCTYPE html>
<?php
include_once './crud_cliente.php';
$con = new crud_cliente();
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Sistema Crud</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            if(isset($_POST['nome'])){//verifica se clicou no botao cadstrar ou editar
                
                if(isset($_GET['id_up']) && !empty($_GET['id_up']) ){ //se clicou em editar - atualiza dados
                    $id_upd = addslashes($_GET['id_up']);
                    $n = addslashes($_POST['nome']);
                    $t = addslashes($_POST['telefone']);
                    $e = addslashes($_POST['email']);
                    
                    //verifica se todos os campos estão preechidos
                    if(!empty($n) && !empty($t) && !empty($e)){
                        $con->editar($id_upd, $n, $t, $e);//chama função editar
                        header("location: index.php");
                    } else {
                        ?>
                            <div class="aviso">
                                <h4>Preecha todos os campos</h4>
                            </div> 
                        <?php
                    }
                } else { ////se clicou em cadastrar - novo cadastro no banco
                    $n = addslashes($_POST['nome']);
                    $t = addslashes($_POST['telefone']);
                    $e = addslashes($_POST['email']);               
                    if(!empty($n) && !empty($t) && !empty($e)){//verifica se imput nao vazio
                        //Cadastrar
                        if(!$con->cadastrar($n, $t, $e))//chama função cadastrar no banco
                        {?>
                            <div class="aviso">
                                <h4>Email já cadastrado no banco</h4>
                            </div> 
                        <?php
                        }
                    }
                    else
                    {
                        ?>
                            <div class="aviso">
                                <h4>Preencha todos os campos</h4>
                            </div> 
                        <?php
                    }
                }
                                
            } 
        ?>
        <?php 
            if(isset($_GET['id_up']) && !empty($_GET['id_up'])){//verifica se clicou em Editar
                $id_update = $_GET['id_up'];
                $res = $con->buscaUpdate($id_update);  
            }
        ?>
        <section id="esquerda">
            <form method="POST">
                <h2>Cadastrar Cliente</h2>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="<?php if(isset($_GET['id_up']) && !empty($_GET['id_up'])){echo $res['nome'];}?>">
                <label for="telefone">TELEFONE</label>
                <input type="text" name="telefone" id="telefone" value="<?php if(isset($_GET['id_up']) && !empty($_GET['id_up'])){echo $res['telefone'];}?>">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php if(isset($_GET['id_up']) && !empty($_GET['id_up'])){echo $res['email'];}?>">
                <input type="submit" value="<?php if(isset($res)){echo"Atualizar";}else{echo"Cadastrar";}?>">                    
            </form>
        </section>

        <section id="direita">
            <table>
                <tr id="titulo">
                    <td>NOME</td>
                    <td>FONE</td>
                    <td>EMAIL</td>
                    <td>AÇÕES</td>


                </tr>
                <?php
                //---BUSCA DADOS NO BANCO E EXIBE PARA USUARIO-----------------------
                $data = $con->buscar();
                if (count($data) > 0) {//verifica se há pessoas cadastradas no banco
                    for ($i = 0; $i < count($data); $i++) {
                        echo "<tr>";
                        foreach ($data[$i] as $key => $value) {
                            if ($key != "id") {
                                echo "<td>$value</td>";
                            }
                        }
                ?>
                        <td>
                            <a href="index.php?id_up=<?php echo $data[$i]['id']; ?>">Editar</a>
                            <a href="index.php?id=<?php echo $data[$i]['id']; ?>">Excluir</a>
                        </td>
                        <?php 
                            //---EXCLUINDO PELO ID----
                            if(isset($_GET['id']) && !empty($_GET['id'])){
                                $id_cliente = addslashes($_GET['id']);
                                $con->excluir($id_cliente);
                                header('location: index.php');
                            } 
                        ?>

                <?php
                        echo "</tr>";
                    }
                } else 
                    {//banco de dados vazío
                 ?>
            </table>
                <div class="aviso">
                    <h4>Ainda não hà pessoas cadastradas no banco</h
                </div>  
                <?php 
                    }
                ?>
        </section>
    </body>
</html>

