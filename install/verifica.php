<?php
error_reporting(0);
if(!isset($_SESSION)) {
    session_start();
}
include('../includes/PHP/conexao.php');
$mysqli = new mysqli($host,$user,$pass,$bd);

if($mysqli->connect_errno) {
    $instalador= '<?php $instalado = false; ?>';
    $instala=fopen('../includes/php/conexao.php' , 'w');
    fwrite($instala,$instalador);
    fclose($instala);
    $_SESSION['erroinstall'] = $mysqli->connect_errno;
    header('Location: index.php');
} else {
    header('Location: index.php');
}

?>