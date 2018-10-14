<?php

session_start();  // iniciar uma sessao 
require 'config.php'; // conecta com a pagina config.php
require_once 'funcoes.php';

// fazer uma query e pegar todos os usuarios do sistema , apenas quero o id

$sql = "SELECT id FROM usuarios";
$sql = $pdo->query($sql);  // executar 
$usuarios = array();

if($sql->rowCount() > 0) {
   $usuarios =$sql->fetchAll();

    foreach($usuarios as $chave => $usuario) {
          $usuarios[$chave]['filhos'] = calcular_cadastros($usuario['id'], $limite);
    } 
}

// as patentes verificar , quantidade de filhos e basear nas patentes
$sql = "SELECT * FROM patentes ORDER BY min DESC";
$sql = $pdo->query($sql);
$patentes = array();

if($sql->rowCount() >= 0) {
    $patentes = $sql->fetchAll();
}
// dentro do foreach de cada usuario percorrer as patentes e atualiza ela no banco de dados
foreach($usuarios as $usuario) {

    
    
     foreach($patentes as $patente) {
        if(intval($usuario['filhos'] >= intval($patente['min']))) {
              
            $sql = "UPDATE usuarios SET patente = :patente WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':patente', $patente['id']);
            $sql->bindValue(':id', $usuario['id']);
            $sql->execute();

            break;


        }
     }

}
