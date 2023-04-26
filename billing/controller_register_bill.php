<?php

include('../app/config.php');

$id_info = $_GET['id_info'];
$id_client = $_GET['id_client'];
$entry_date = $_GET['entry_date'];
$entry_time = $_GET['entry_time'];
$num_spot = $_GET['num_spot'];
$u_session = $_GET['u_session'];

$statement = $pdo->prepare('INSERT INTO tb_billing
(ID_INFO,ID_CLIENT,ENTRY_DATE,ENTRY_TIME,S_NUMBER,DETAIL,PRICE,AMOUNT,TOTAL,TOTAL_AMOUNT,U_SESSION,QR)
VALUES ( :ID_INFO,:ID_CLIENT,:ENTRY_DATE,:ENTRY_TIME,:S_NUMBER,:DETAIL,:PRICE,:AMOUNT,:TOTAL,:TOTAL_AMOUNT,:U_SESSION,:QR)');

$statement->bindParam(':ID_INFO',$id_info);
$statement->bindParam(':ID_CLIENT',$id_client);
$statement->bindParam(':ENTRY_DATE',$entry_date);
$statement->bindParam(':ENTRY_TIME',$entry_time);
$statement->bindParam(':S_NUMBER',$num_spot);

///Retrieving department
$b_department = "";
$query_infos = $pdo->prepare("SELECT B_DEPARTMENT FROM tb_infos WHERE ID_INFO = '$id_info'");
$query_infos->execute();
$infos = $query_infos->fetchAll(PDO::FETCH_ASSOC);
foreach ($infos as $info) {
    $b_department = $info['B_DEPARTMENT'];
}
date_default_timezone_set("America/Bogota");
$currentDateTime = date("Y-m-d H:i:s");
$day = date('d');
$dateObj = DateTime::createFromFormat('!m', date('m'));
$month = $dateObj->format('F');
$year = date('Y');
$fechaFactura = $b_department." ".$month." ".$day.", ".$year;

//Time difference between entry datetime and exit datetime
$entry_dt = strtotime($entry_date." ".$entry_time);
$exit_dt = strtotime($currentDateTime);
$time_spent= round(abs($entry_dt - $exit_dt) / 60,2); //Time difference in minutes
$int_hours = intdiv($time_spent, 60);
$minutes = $time_spent % 60;
$detail = $int_hours." hour(s) and".$minutes." minute(s) parking service";

$statement->bindParam(':DETAIL',$detail);
$statement->bindParam(':PRICE',$PRICE);
$statement->bindParam(':AMOUNT',$AMOUNT);
$statement->bindParam(':TOTAL',$TOTAL);
$statement->bindParam(':TOTAL_AMOUNT',$TOTAL_AMOUNT);
$statement->bindParam(':U_SESSION',$u_session);
$statement->bindParam(':QR',$QR);

/*if($statement->execute()){
    echo 'success';
    //header('Location:' .$URL.'/');
}else{
    echo 'error al registrar a la base de datos';
}*/

?>