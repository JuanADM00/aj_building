<?php

include('../app/config.php');

$id_price = $_GET['id_price'];
$amount = $_GET['amount'];
$detail = $_GET['detail'];
$p_value = $_GET['p_value'];
$currency = $_GET['currency'];
$currency = strtoupper($currency);

$statement = $pdo->prepare("UPDATE tb_prices SET AMOUNT = :AMOUNT, DETAIL = :DETAIL, P_VALUE = :P_VALUE, CURRENCY = :CURRENCY WHERE ID_PRICE = :ID_PRICE");

$statement->bindParam(":AMOUNT", $amount);
$statement->bindParam(":DETAIL", $detail);
$statement->bindParam(":P_VALUE", $p_value);
$statement->bindParam(":CURRENCY", $currency);
$statement->bindParam(":ID_PRICE", $id_price);


if ($statement->execute()) {
    echo "Successful Update";
    ?>
    <script>location.href = "index.php";</script>
    <?php 
}else {
    echo "Failed Update";
}
?>