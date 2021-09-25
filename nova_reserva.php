<?php
include('includes/PHP/config.php');
if(!isset($_SESSION)) {
    session_start();
}
$queryreservas = $mysqli->query("SELECT * FROM `reservas`") or die ($mysqli->error);
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nova reserva</title>
    </head>
    <body>
        <center><h3>Nova Reserva</h3>
        <?php if(isset($_SESSION['upload'])) { ?>
                <span>Reserva adicionada com sucesso!</span>
                <br><br>
            <?php unset($_SESSION['upload']); } ?>
        <form action="new.php" method="post" enctype="multipart/form-data">
     <label>Selecione o arquivo XML: </label><br><input type="file" name="reservaxml" required>
      <br>
      <br>
      <button type="submit" name="novoxml">Upload</button></form><br>
      <button><a style="color: inherit; text-decoration: none;" href="index.php">Voltar</a></button>
        </center>
        <br>
        
    </body>
</html>