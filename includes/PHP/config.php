<?php
error_reporting(0);
if(!isset($_SESSION)) {
    session_start();
}
require('conexao.php');
$mysqli = new mysqli($host,$user,$pass,$bd);
//-
if($mysqli->connect_errno) {
    $instalador = 1;
    $_SESSION['errobd'] = $mysqli->connect_error;
    echo ('<center>Erro ao conectar ao banco de dados: ' . $_SESSION['errobd'] . '<br>');
    die('<button><a style="text-decoration: none;" href="./install/verifica.php">Prosseguir para o instalador</a></button></center>');
} else {
    if(isset($_SESSION['errobd'])) {
        unset($_SESSION['errobd']);
        $mysqli->set_charset('utf-8');
    }

    $instalador = 0;
}

//Usar cURL ou file_Get_contents
$opcao = 'fileget'; //'curl';
//Define se o XML é interno ou externo ()
$sxml = 'interno'; //'interno';

?>