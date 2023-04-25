<?php

include('../app/config.php');

$c_name = $_GET['c_name'];
$c_tin = $_GET['c_tin'];
$car_plate = $_GET['car_plate'];

//Querying whether
$query_clients = $pdo->prepare("SELECT * FROM tb_clients WHERE CAR_PLATE = '$car_plate'");
$query_clients->execute();
$clients_data = $query_clients->fetchAll(PDO::FETCH_ASSOC);
if (!empty($clients_data)) {
    echo "This client is already registered";
}else{
    echo "No problem";
    $statement = $pdo->prepare('INSERT INTO tb_clients (FULLNAME_CLIENT, TIN_CLIENT, CAR_PLATE) VALUES (:FULLNAME_CLIENT,:TIN_CLIENT,:CAR_PLATE)');
    $statement->bindParam(':FULLNAME_CLIENT',$c_name);
    $statement->bindParam(':TIN_CLIENT',$c_tin);
    $statement->bindParam(':CAR_PLATE',$car_plate);
    if ($statement->execute()) {
        echo "Successful Insertion";
    }else{
        echo "Failed Insertion";
    }
}
?>