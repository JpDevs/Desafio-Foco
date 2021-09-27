<?php
include('includes/PHP/config.php');
if(!isset($_SESSION)) {
    session_start();
}
@$getid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
@$id = addslashes($getid);
if(isset($_POST['btneditar'])) {
    $reserva_id = addslashes(filter_input(INPUT_POST,'reserva_id'));
    $cliente_nome = addslashes(filter_input(INPUT_POST,'cliente_nome'));
    $criancas = addslashes(filter_input(INPUT_POST,'criancas'));
    $adultos = addslashes(filter_input(INPUT_POST,'adultos'));
    $status = addslashes(filter_input(INPUT_POST,'status'));
    $suite = addslashes(filter_input(INPUT_POST,'suite'));
    $mysqli->query("UPDATE `reservas` SET `reserva_cliente` = '$cliente_nome', `reserva_tipo_quarto` = '$suite', `adultos` = '$adultos', `kids` = '$criancas', `status` = '$status' WHERE `reservas`.`id` = $id") or die ($mysqli->error);
    $_SESSION['edit'] = true;
    header('Location: index.php');
    }
$queryreserva = $mysqli->query("SELECT * FROM `reservas` WHERE id = $id") or die ($mysqli->error);
$reserva = $queryreserva->fetch_assoc();

if(isset($_GET['editarxml']) && $_GET['editarxml'] == 'true') {
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Editar reserva</title>
    </head>
    <body>
        <center><h3>Editar Reserva</h3>
        <?php if(isset($_SESSION['upeditado'])) { ?>
                <span>Reserva editada com sucesso!</span>
                <br><br>
            <?php unset($_SESSION['upeditado']); } ?>
            <?php if(isset($_SESSION['erro'])) { ?>
                <font color="red"><b>Erro: </b></font><span><?php echo $_SESSION['erro']; ?></span>
                <br><br>
            <?php unset($_SESSION['erro']); } ?>
        <form action="modify.php" method="post" enctype="multipart/form-data">
     <label>Selecione o arquivo XML: </label><br><input type="file" name="reservaxml" required>
     <input type="hidden" value="<?php echo $id;?>" name="id">
      <br>
      <br>
      <button type="submit" name="editxml">Upload</button></form><br>
      <button><a style="color: inherit; text-decoration: none;" href="index.php?id=<?php echo $id; ?>">Voltar</a></button>
        </center>
        <br>
        
    </body>
</html>
<?php
}else {


?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Editar reserva <?php echo $reserva['id']; ?></title>
    </head>
    <body>
    <center>
    <h4>Editar reserva <?php echo $reserva['id']; ?></h4>
    <?php if(isset($_SESSION['editado'])) {?>
        <span>Reserva editada com sucesso!</span> <br><br><?php unset($_SESSION['editado']); } ?>
    <form method="post" action="">
        <label>Id da reserva:</label><input type="text" readonly="" name="reserva_id" value="<?php echo $reserva['reserva_id']; ?>"></input><br><br>
        <label>Nome do cliente:</label><input type="text" value="<?php echo $reserva['reserva_cliente']; ?>" name="cliente_nome"></input><br><br>
        <label>Suite:</label><input type="text" name="suite" value="<?php echo $reserva['reserva_tipo_quarto']; ?>"></input><br><br>
        <label>Adultos:</label><input type="text" name="adultos" value="<?php echo $reserva['adultos']; ?>"></input><br><br>
        <label>Crianças:</label><input type="text" name="criancas" value="<?php echo $reserva['kids']; ?>"></input><br><br>
        <label>Status:</label><select name="status">
        <option value="pendente">Pendente</option>
        <option value="recuperada">Recuperada</option>
        <option value="confirmada">Confirmada</option>
        <option value="cancelada">Cancelada</option>
        </select><br><br>
        <button type="submit" name="btneditar">Editar</button>
    </form>
    <button><a style="color: inherit; text-decoration: none;" href="editar.php?id=<?php echo $id;?>&editarxml=true">Carregar XML</a></button><br><br>
    <button><a style="color: inherit; text-decoration: none;" href="index.php">Voltar</a></button>
    </center>
    </body>
</html>

<?php } ?>