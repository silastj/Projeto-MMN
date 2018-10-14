<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script type='text/javascript' src="js/jquery.min.js"></script>
    <script type='text/javascript' src="js/bootstrap.min.js"></script>
</head>




<?php
session_start();
require_once 'config.php';

    //  Quando eu clicar em entrar sera enviado para a propria pagina do login.php conforme abaixo 

    // Se o meu campo de email nao estiver vazio, isso a primeira linha  
    // se a linha 10 e 11 é preenchida pelo usuario  
if(!empty($_POST['email'])) {             
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $senha = md5($senha);
    // a linha 15 ira verificar no banco de dados conforme a variavel que eu criei no config.php $pdo

    $sql = $pdo->prepare("SELECT * FROM usuarios  WHERE email = :email AND senha = :senha");
         
                                // $sql ="SELECT id FROM usuarios WHERE email = ? AND senha = ?";
                                //$sql = $pdo->prepare($sql);

    // vamos subistituir :email :senha

         $sql->bindValue(':email', $email);
         $sql->bindValue(':senha', $senha);
         $sql->execute();     // esse comando vou executar

    // isso é so para debugar o comando echo $sql->rowCount();exit;

    //verificar se ouve algum retorno na linha 29
    // se ouve algum retorno se foi maior que o zero ouve algum retorno o usuario acertou o login
         if($sql->rowCount() > 0) {   
         $sql = $sql->fetch();      // ele acertando eu vou pegar o id do usuario (fetch pega o id)
            
         $_SESSION['mmnlogin'] = $sql['id'];             // salvar na sessao o id do usuario logado
         
            header('Location: index.php');            // caso ele acertou ele volta para o index.php
            exit;
             
        }   
          else {            
                 echo 'Usuario e/ou Senha errados!';    // se nao, ele exibe essa mensagem
          } 


    
}

?>


<!--  formulario de login abaixo -->

<body>

    <div class='container'>
    

        <img src="imagens/mmn.jpg" class="img-responsive img-rounded ">
                <h2 id='login'><kbd>Login</kbd></h2>

    

            <form method='POST'class='form-horizontal'>

     
                <div class='form-group-sm'>
                    <label for="email" class='email'>E-mail</label>
                    <input type='email' name="email" class="form-control"autofocus placeholder='silastj@hotmail.com'/>
                </div>
                <div class='form-group-sm'>
                    <label for="pwd" class='email' title='Seu email'>Senha</label>
                    <input type='password' name="senha" class="form-control" placeholder='******'/>
                </div>
                    <input type="submit" value="Entrar" class="btn btn-info" />
            </form>

            <a href="#teste-1" data-toggle="collapse" id='link-2'> Teste </a>
        <div id="teste-1" class="collapse">
             <strong> Email:</strong> teste@teste.com <strong>Senha:</strong> teste
        </div>

        <!-- <button data-toggle="collapse" data-target='#teste-1'>Teste</button>
        <div id="teste-1" class="collapse">
           <strong> Email:</strong> teste@teste.com <strong>Senha:</strong> teste
        </div> -->


        <div class="panel panel-success">
            <div class="panel-footer">Desenvolvedor
                 <a href='http://www.asilas.6te.net' target='blank' id='link-1'>Asilas.6te.net</a>
            </div>
        </div>



    </div>

</body>

</html>
