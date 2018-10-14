<?php
session_start();
require 'config.php';
 
unset($_SESSION['mmnlogin']);     // aqui ele tira o login com o comando unset
header('Location: login.php');   // aqui ele direciona para fazer para a pagina fazer o login
exit;




