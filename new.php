<?php
include('includes/PHP/config.php');
if(!isset($_SESSION)) { //Starta a sessão, caso não exista.
    session_start();
}
//-

//-
if($sxml == 'externo') {
    $caminhoxml = ''; //colocar URL do xml.
if($opcao == 'fileget') { //Se opção = file_get, ele executa o comando em questão.
    $url = file_get_contents($caminhoxml);
} else if ($opcao == 'curl') { //Mas se for cURL,ele executa o outro comando.
    $ch = curl_init($caminhoxml);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $caminhoxml);
    $url = curl_exec ($ch);
    curl_close($ch);
} else { //Caso não seja nenhum dos dois, ele mata a aplicação, pois não tem formas de realizar o request.
    die('Erro: XML não reconhecido.');
}

$xml = simplexml_load_string($url); //Carrega o XML


}
else if ($sxml == 'interno') {
    $caminhoxml = './includes/XML/new.xml'; //Colocar caminho do xml
    $xml = simplexml_load_file($caminhoxml); //Carrega o XML
} else {
    die('Erro: XML não reconhecido.');
}

foreach($xml->Bookings as $reserva) { 

    $id_reserva = $reserva->Booking['id']; 
    $tipo_request = $reserva->Booking['type'];
    $reserva_criacao = $reserva->Booking['createDateTime'];
    $reserva_fonte = $reserva->Booking['source'];
    $reserva_chegada = $reserva->Booking->RoomStay->StayDate['arrival'];
    $reserva_saida = $reserva->Booking->RoomStay->StayDate['departure'];
    $reserva_adultos = $reserva->Booking->RoomStay->GuestCount['adult'];
    $reserva_criancas = $reserva->Booking->RoomStay->GuestCount['child'];
    $reserva_quarto = $reserva->Booking->RoomStay['roomTypeID'];
    //-
    $cliente_fullname = $reserva->Booking->PrimaryGuest->Name['givenName'] . ' ' . $reserva->Booking->PrimaryGuest->Name['surname'];
    $cliente_telefone = $reserva->Booking->PrimaryGuest->Phone['countryCode'] . $reserva->Booking->PrimaryGuest->Phone['cityAreaCode'] . $reserva->Booking->PrimaryGuest->Phone['number'];
    $cliente_email = $reserva->Booking->PrimaryGuest->Email;
    //-
    $cliente_cartao_bandeira = $reserva->Booking->RoomStay->PaymentCard['cardCode'];
    $cliente_cartao_numero = $reserva->Booking->RoomStay->PaymentCard['cardNumber'];
    $cliente_cartao_validade = $reserva->Booking->RoomStay->PaymentCard['expireDate'];
    $cliente_cartao_cvv = $reserva->Booking->RoomStay->PaymentCard['seriesCode'];
    $cliente_cartao_titular = $reserva->Booking->RoomStay->PaymentCard->CardHolder['name'];
    $cliente_cartao_endereco = $reserva->Booking->RoomStay->PaymentCard->CardHolder['address'];
    $cliente_cartao_cidade = $reserva->Booking->RoomStay->PaymentCard->CardHolder['city'];
    $cliente_cartao_estado = $reserva->Booking->RoomStay->PaymentCard->CardHolder['stateProv'];
    $cliente_cartao_pais = $reserva->Booking->RoomStay->PaymentCard->CardHolder['country'];
    $cliente_cartao_cep = $reserva->Booking->RoomStay->PaymentCard->CardHolder['postalCode'];
    //-
    if($reserva->Booking['status'] == 'pending') {
        $reserva_status = 'pendente';
    } else if($reserva->Booking['status'] == 'retrieved') {
        $reserva_status = 'recuperada';
    } else if($reserva->Booking['status'] == 'confirmed') {
        $reserva_status = 'confirmada';
    } else if ($reserva->Booking['status'] == 'expired') {
        $reserva_status = 'cancelada';
    } else {
        $reserva_status = 'pendente';
    }

    //echo $reserva_quarto;

    $qryquarto = $mysqli->query("SELECT `quarto_nome` FROM `tipos_quartos` WHERE id = $reserva_quarto") or die ($mysqli->error);
    if($qryquarto->num_rows <=0 ) {
        $tipo_quarto = $reserva_quarto; 
    } else {
        $tipo_quarto = $qryquarto->fetch_assoc()['quarto_nome'];
    }

    $mysqli->query("INSERT INTO `reservas` (`reserva_id`, `reserva_cliente`, `reserva_tipo_quarto`, `reserva_criacao`, `reserva_fonte`, `adultos`, `kids`, `chegada`, `saida`, `status`) VALUES ('$id_reserva', '$cliente_fullname', '$tipo_quarto', '$reserva_criacao', '$reserva_fonte', '$reserva_adultos', '$reserva_criancas', '$reserva_chegada', '$reserva_saida', '$reserva_status')") or die ($mysqli->error); // 
    $mysqli->query("INSERT INTO `cliente_cartao` (`cartao_id`, `cartao_cliente`, `cartao_titular`, `cartao_bandeira`, `cartao_numero`, `cartao_validade`, `cartao_cvv`, `cartao_endereco`) VALUES (NULL, '$cliente_fullname', '$cliente_cartao_titular', '$cliente_cartao_bandeira', '$cliente_cartao_numero', '$cliente_cartao_validade', '$cliente_cartao_cvv', '$cliente_cartao_endereco')") or die ($mysqli->error);
}

?>