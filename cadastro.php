<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script type='text/javascript' src="js/jquery.min.js"></script>
    <script type='text/javascript' src="js/bootstrap.min.js"></script>
</head>

<?php
session_start();
require 'config.php';

// quando for cadastrado o usuario segue a confirmacao abaixo

if(!empty($_POST['nome']) && !empty($_POST['email'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']); // recebendo o nome e email 
     
       // precido do que para cadastrar?

    $id_pai = $_SESSION['mmnlogin'];  // usuario da sessao 
    $senha = md5($email);             // dados para cadastro

    // verificar se o email esta cadastrado

    $sql = $pdo->prepare('SELECT * FROM usuarios WHERE email = :email');
    $sql->bindValue(':email', $email);
    $sql->execute();
      
    // se ele não achou ele vai enserir abaixo e vai para o index, se nao ele envia usuario ja cadastrado

    if($sql->rowCount() == 0) {
        $sql = $pdo->prepare("INSERT INTO usuarios (id_pai, nome, email, senha) VALUES (:id_pai, :nome, :email, :senha)");
        $sql->bindValue(':id_pai', $id_pai);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

                                                                                //echo $sql->rowCount();exit;


        header('Location: index.php');
        exit;
    }
    else{
        echo 'Usuario ja esta Cadastrado!';
    }



 }

?>

<body>

    <div class='container'>

          <img src="imagens/mmn.jpg" class="img-responsive img-rounded ">
    <h2 id='login'><kbd>Cadastrar Novos Usuários</kbd></h2>
 <form method='POST'class='form-horizontal'>

     
            <div class='form-group-xs'>
            <label for="email" class='email'>Nome</label>
                <input type='text' name="nome" class="form-control"autofocus/>
            </div>
            <div class='form-group-xs'>
            <label for="pwd" class='email' >E-mail</label>
                <input type='email' name="email" class="form-control" />
            </div>
            <input type="submit" value="Cadastrar" class="btn btn-default" />

        </form>
        </form>
        <div class="panel panel-success">
            <div class="panel-footer">Desenvolvedor
                 <a href='http://www.asilas.6te.net' target='blank' id='link-1'>Asilas.6te.net</a>
            </div>
        </div>


</div>

</body>

</html>