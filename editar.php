<?php
include('includes/PHP/config.php');
$getid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$id = addslashes($getid);
$queryreserva = $mysqli->query("SELECT * FROM `reservas` WHERE id = $id") or die ($mysqli->error);
$reserva = $queryreserva->fetch_assoc();
if(isset($_GET['xml']) && $_GET['xml'] == 'true') {

}else {


?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Editar reserva <?php echo $reserva['id']; ?></title>
    </head>
    <body>
    <center>
    <h4>Editar reserva <?php echo $reserva['id']; ?>
    <form method="post" action="">
        
    </form>
    
    </center>
    </body>
</html>

<?php } ?>