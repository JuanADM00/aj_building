<?php

include('../app/config.php');

$c_name = $_GET['c_name'];
$c_tin = $_GET['c_tin'];
$car_plate = $_GET['car_plate'];

$statement = $pdo->prepare('INSERT INTO tb_clients
(FULLNAME_CLIENT, TIN_CLIENT, CAR_PLATE)
VALUES (:FULLNAME_CLIENT,:TIN_CLIENT,:CAR_PLATE)');

$statement->bindParam(':FULLNAME_CLIENT',$c_name);
$statement->bindParam(':TIN_CLIENT',$c_tin);
$statement->bindParam(':CAR_PLATE',$car_plate);

if ($statement->execute()) {
    echo "Successful Insertion";
}else {
    echo "Failed Insertion";
}
?>