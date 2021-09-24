<?php
include('includes/PHP/config.php');
$queryreservas = $mysqli->query("SELECT * FROM `reservas`") or die ($mysqli->error);
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Reservas</title>
    </head>
    <body>
        <center><h3>Reservas</h3>
        <button><a style="text-decoration: none;" href="nova_reserva.php">Nova Reserva</a></button>
        <br>
        <br>
        <table border="1">
            
            <th>ID</th>
            <th>Nome do cliente</th>
            <th>Suite</th>
            <th>Adultos</th>
            <th>Crianças</th>
            <th>Chegada</th>
            <th>Saida</th>
            <th>Status</th>
            <th>Feita em</th>
           <center> <th>Ações</th></center>
            <?php while($reservas = $queryreservas->fetch_assoc()) { ?>
                <tr>
                <td><?php echo $reservas['reserva_id']; ?></td>
                <td><?php echo $reservas['reserva_cliente']; ?></td>
                <td><?php echo $reservas['reserva_tipo_quarto']; ?></td>
                <td><?php echo $reservas['adultos']; ?></td>
                <td><?php echo $reservas['kids']; ?></td>
                <td><?php echo $reservas['chegada']; ?></td>
                <td><?php echo $reservas['saida']; ?></td>
                <td><?php echo $reservas['status']; ?></td>
                <td><?php echo $reservas['reserva_criacao']; ?></td>
                <td><button>Editar</button>
                <button>Deletar</button></td>
            </tr>
                <?php } ?>
            </tabel>
    </center>
    </body>
</html>