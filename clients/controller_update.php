<?php
include('../app/config.php');

$c_fullname = $_GET['c_fullname'];
$c_tin = $_GET['c_tin'];
$car_plate = $_GET['car_plate'];
$id_client = $_GET['id_client'];

$statement = $pdo->prepare("UPDATE tb_clients SET FULLNAME_CLIENT = :FULLNAME_CLIENT, TIN_CLIENT = :TIN_CLIENT, CAR_PLATE = :CAR_PLATE WHERE ID_CLIENT = :ID_CLIENT");

$statement->bindParam(":FULLNAME_CLIENT", $c_fullname);
$statement->bindParam(":TIN_CLIENT", $c_tin);
$statement->bindParam(":CAR_PLATE", $car_plate);
$statement->bindParam(":ID_CLIENT", $id_client);
if ($statement->execute()) {
    echo "Successful Update";?>
    <script>location.href = "index.php";</script>
    <?php
} else {
    echo "Failed Update";
}
?>