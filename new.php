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
    $fonte_reserva = $reserva->Booking['source'];
    $reserva_chegada = $reserva->Booking->RoomStay->StayDate['arrival'];
    $reserva_saida = $reserva->Booking->RoomStay->StayDate['departure'];
    $reserva_adultos = $reserva->GuestCount['adultos'];
    $reserva_criancas = $reserva->GuestCount['child'];

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

    echo $reserva_chegada;

    
    //$mysqli->query("INSERT INTO") or die ($mysqli->error); // 
}

?>