<?php
// conexao com o banco de dados

try {
    global $pdo;
   // $pdo = new PDO('mysql:host=localhost;dbname=projeto_mmn;charset=utf8', 'root', '');
    $pdo = new PDO('mysql:host=;dbname=ctdntmed_projeto_mmn;charset=utf8', '', '');
    $pdo->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);

} catch(PDOException $e) {
    echo "ERROR: ".$e->getMessage();
    exit;
}

$limite = 3;  // mostrar na lista de consulta

$patentes = array(


);

