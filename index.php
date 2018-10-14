<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MMN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script type='text/javascript' src="js/jquery.min.js"></script>
    <script type='text/javascript' src="js/bootstrap.min.js"></script>
</head>



<?php

session_start();  // iniciar uma sessao 
require 'config.php'; // conecta com a pagina config.php
require_once 'funcoes.php';

// se existi um usuario logado

if(empty($_SESSION['mmnlogin'])) {
    header('Location: login.php');     // se ele estiver vazia ela entra no php, se estiver logado ela segue
    exit;      // se estiver logado ele para por aqui                        
}
$id = $_SESSION['mmnlogin'];   // pegar o nome do usuario é apartir do id o login do usuario

$sql = $pdo->prepare("SELECT 
usuarios.nome,
patentes.nome as p_nome FROM usuarios LEFT JOIN patentes ON 
patentes.id = usuarios.patente
WHERE usuarios.id = :id"); // puxar o nome atras do id
    $sql->bindValue(':id', $id);   // receber uma variavel id
    $sql->execute();

  if($sql->rowCount() > 0) {        // se ele achou o usuario, se ele achou passa a frente
    $sql = $sql->fetch();
    $nome = $sql['nome'];
    $p_nome = $sql['p_nome'];

  }
  else {
      header('Location: login.php');
      exit;
      
  }
// aqui ira mostrar os usuarios cadastro pelo id principal

$lista = listar($id, $limite);

?>

<body>

    <div class='container'>
        <div class='jumbotron text-center'>
            <h2> Sistema Marketing Multinível</h2>
        </div>
           <img src="imagens/mmn.jpg" class="img-responsive img-rounded ">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#home" data-toggle='tab'>Usuário</a>
            </li>
            <li>
                <a href="#sobre" data-toggle='tab'>Nível</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id='home' class="tab-pane active in fade">
                <?php echo $nome; ?>
            </div>
            <div id='sobre' class="tab-pane fade">
                <?php echo $p_nome; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading">Lista de Cadastros</div>
                        <div class="panel-body">
                            <?php exibir($lista); ?>
                    </div>
                </div>
            </div>


        </div>

        <ul class="pager">
            <li class="previous"><a href='cadastro.php'>Cadastrar novos usuários</a></li>
            <li class="next"><a href='sair.php'>Sair</a></li>

        </ul>

        <div class="panel panel-success">
            <div class="panel-footer">Desenvolvedor
                 <a href='http://www.asilas.6te.net' target='blank' id='link-1'>Asilas.6te.net</a>
            </div>
        </div>


    <div>

</body>

</html>