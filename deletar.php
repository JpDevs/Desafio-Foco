<?php
if(!isset($_SESSION)) {
    session_start();
}
include('includes/PHP/config.php');
$getid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$id = addslashes($getid);
$mysqli->query("DELETE FROM `reservas` WHERE id = $id");
$_SESSION['deletada'] = true;
header('Location:' . $_SERVER['HTTP_REFERER']);
?>