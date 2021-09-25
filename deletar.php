<?php
include('includes/PHP/config.php');
$getid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$id = addslashes($getid);
?>