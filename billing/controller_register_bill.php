<?php

include('../app/config.php');

$id_info = $_GET['id_info'];
$id_client = $_GET['id_client'];
$entry_date = $_GET['entry_date'];
$entry_time = $_GET['entry_time'];
$num_spot = $_GET['num_spot'];
$u_session = $_GET['u_session'];

///Retrieving department
$b_department = "";
$query_infos = $pdo->prepare("SELECT B_DEPARTMENT FROM tb_infos WHERE ID_INFO = '$id_info'");
$query_infos->execute();
$infos = $query_infos->fetchAll(PDO::FETCH_ASSOC);
foreach ($infos as $info) {
    $b_department = $info['B_DEPARTMENT'];
}
date_default_timezone_set("America/Bogota");
$dt_String = date("Y-m-d H:i:s");
$exit_dateTime = new \DateTime($dt_String);
$exit_date = $exit_dateTime->format('Y-m-d');
$exit_time = $exit_dateTime->format('H:i:s');



//Time difference between entry datetime and exit datetime
$diff = $exit_dateTime->diff(new DateTime($entry_date." ".$entry_time));

//Price calculation

$sql = ""; $detail = "";
if (($diff->d) > 0) {
    $sql = "SELECT P_VALUE, CURRENCY FROM tb_prices WHERE AMOUNT = '$diff->d' AND DETAIL = 'DAYS'";
}else if (($diff->h) > 0){
    $sql = "SELECT P_VALUE, CURRENCY FROM tb_prices WHERE AMOUNT = '$diff->h' AND DETAIL = 'HOURS'";
} else {
    $sql = "SELECT MIN(P_VALUE) AS P_VALUE, CURRENCY FROM tb_prices WHERE DETAIL = 'HOURS'";
}
$query_prices = $pdo->prepare($sql);
$query_prices->execute();
$prices = $query_prices->fetchAll(PDO::FETCH_ASSOC);
foreach ($prices as $price) {
    $p_value = $price['P_VALUE'];
    $currency = $price['CURRENCY'];
}
if (($diff->d) > 0) {
    $detail = $detail."".$diff->d." Day(s) ";
}if (($diff->h) > 0){
    $detail = $detail."".$diff->h." Hour(s) ";
}
$amount = 1;
$detail = $detail."".$diff->i.' Minute(s) parking service';


//Retrieving client data
$query_clients = $pdo->prepare("SELECT FULLNAME_CLIENT, TIN_CLIENT, CAR_PLATE FROM tb_clients WHERE ID_CLIENT = '$id_client'");
$query_clients->execute();
$clients = $query_clients->fetchAll(PDO::FETCH_ASSOC);
foreach ($clients as $client) {
    $c_fullname = $client['FULLNAME_CLIENT'];
    $c_tin = $client['TIN_CLIENT'];
    $car_plate = $client['CAR_PLATE'];
}
/////////////////////////

$QR = "Factura realizada por el sistema de parqueo AJ-Building al cliente ".$id_client." de nombre ".$c_fullname.", NIT ".$c_tin." y placa de vehículo
 ".$car_plate." el día ".$exit_date." a las ".$exit_time;

$statement = $pdo->prepare('INSERT INTO tb_billing
(ID_INFO,ID_CLIENT,ENTRY_DATE,EXIT_DATE,ENTRY_TIME,EXIT_TIME,S_NUMBER,DETAIL,PRICE,AMOUNT,TOTAL,TOTAL_AMOUNT,U_SESSION,QR)
VALUES ( :ID_INFO,:ID_CLIENT,:ENTRY_DATE,:EXIT_DATE,:ENTRY_TIME,:EXIT_TIME,:S_NUMBER,:DETAIL,:PRICE,:AMOUNT,:TOTAL,:TOTAL_AMOUNT,:U_SESSION,:QR)');

$statement->bindParam(':ID_INFO',$id_info);
$statement->bindParam(':ID_CLIENT',$id_client);
$statement->bindParam(':ENTRY_DATE',$entry_date);
$statement->bindParam(':EXIT_DATE',$exit_date);
$statement->bindParam(':ENTRY_TIME',$entry_time);
$statement->bindParam(':EXIT_TIME',$exit_time);
$statement->bindParam(':S_NUMBER',$num_spot);
$statement->bindParam(':DETAIL',$detail);
$statement->bindParam(':PRICE',$p_value);
$statement->bindParam(':AMOUNT',$amount);
$statement->bindParam(':TOTAL',$p_value);
$statement->bindParam(':TOTAL_AMOUNT',$p_value);
$statement->bindParam(':U_SESSION',$u_session);
$statement->bindParam(':QR',$QR);
if($statement->execute()){
    $statement = $pdo->prepare("UPDATE tb_mappings SET FREE = 1 WHERE NUM_SPOT = :NUM_SPOT");

    $statement->bindParam(":NUM_SPOT", $num_spot);

    $statement2 = $pdo->prepare("UPDATE tb_tickets SET T_STATE = 'INVOICED' WHERE S_NUMBER = :S_NUMBER");
    $statement2->bindParam(":S_NUMBER", $num_spot);
    if ($statement->execute() && $statement2->execute()) {
        echo "Successful Action";
        ?>
        <script>location.href = "billing/invoice.php";</script>
        <?php
    } else {
        echo "Failed Update";
    }
}else{
    echo 'Failed Action';
}

?>