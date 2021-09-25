<?php
include('includes/PHP/config.php');
if(!isset($_SESSION)) {
    session_start();
}
if(isset($_POST['zerar'])) {
    $mysqli->query("DELETE FROM `reservas`");
    $mysqli->query("ALTER TABLE `reservas` AUTO_INCREMENT = 0");
    $_SESSION['zerado'] = true;
}
$queryreservas = $mysqli->query("SELECT * FROM `reservas`") or die ($mysqli->error);
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Reservas</title>
    </head>
    <body>
        <center><h3>Reservas</h3>
        <?php if(isset($_SESSION['zerado'])) { echo 'Reservas zeradas com sucesso!' . '<br><br>'; unset($_SESSION['zerado']);} ?>
        <?php if(isset($_SESSION['edit'])) { echo 'Reserva editada com sucesso!' . '<br><br>'; unset($_SESSION['edit']);} ?>
        <?php if(isset($_SESSION['deletada'])) { echo 'Reserva deletada com sucesso!' . '<br><br>'; unset($_SESSION['deletada']);} ?>
        <button><a style="color: inherit; text-decoration: none;" href="nova_reserva.php">Nova Reserva</a></button>
        <br>
        <br>
        <form method="post" action="">
            <button name="zerar" type="submit">Zerar Reservas</button>
        </form>
        <br>
        <br>
        <table border="1">
            <th> &nbsp;</th>
            <th>ID da reserva</th>
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
                <td><?php echo $reservas['id']; ?></td>
                <td><?php echo $reservas['reserva_id']; ?></td>
                <td><?php echo $reservas['reserva_cliente']; ?></td>
                <td><?php echo $reservas['reserva_tipo_quarto']; ?></td>
                <td><?php echo $reservas['adultos']; ?></td>
                <td><?php echo $reservas['kids']; ?></td>
                <td><?php echo $reservas['chegada']; ?></td>
                <td><?php echo $reservas['saida']; ?></td>
                <td><?php echo $reservas['status']; ?></td>
                <td><?php echo $reservas['reserva_criacao']; ?></td>
                <td><button><a style="color: inherit; text-decoration: none;" href="editar.php?id=<?php echo $reservas['id']; ?>">Editar</a></button>
                <button><a style="color: inherit; text-decoration: none;" href="deletar.php?id=<?php echo $reservas['id']; ?>">Deletar</a></button></td>
            </tr>
                <?php } ?>
            </tabel>
    </center>
    </body>
</html>