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
    die('<button><a style="color: inherit; text-decoration: none;" href="./install/verifica.php">Prosseguir para o instalador</a></button></center>');
} else {
    if(isset($_SESSION['errobd'])) {
        unset($_SESSION['errobd']);
        $mysqli->set_charset('utf-8');
    }
    $queryxml = $mysqli->query("SELECT request FROM `configuracoes` WHERE id = 1") or die ($mysqli->error);
    $queryrequest = $mysqli->query("SELECT tipo_consulta FROM `configuracoes` WHERE id = 1") or die ($mysqli->error);
    $qry = $mysqli->query("SELECT * FROM `configuracoes` WHERE id = 1");
    //Usar cURL ou file_Get_contents
    $opcao = $queryrequest->fetch_assoc()['tipo_consulta'];
    //Define se o XML é interno ou externo ()
    $sxml = $queryxml->fetch_assoc()['request'];
    //-
    $nomehotel = $qry->fetch_assoc()['nome_hotel'];
    $instalador = 0;
}



?>