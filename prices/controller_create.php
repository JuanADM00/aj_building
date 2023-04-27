<?php

include('../app/config.php');

$amount = $_GET['amount'];
$detail = $_GET['detail'];
$p_value = $_GET['p_value'];
$currency = $_GET['currency'];
$currency = strtoupper($currency);

$statement = $pdo->prepare("INSERT INTO tb_prices (AMOUNT, DETAIL, P_VALUE, CURRENCY) VALUES (:AMOUNT, :DETAIL, :P_VALUE, :CURRENCY)");

$statement->bindParam(":AMOUNT", $amount);
$statement->bindParam(":DETAIL", $detail);
$statement->bindParam(":P_VALUE", $p_value);
$statement->bindParam(":CURRENCY", $currency);


if ($statement->execute()) {
    echo "Successful Insertion";
    ?>
    <script>location.href = "index.php";</script>
    <?php 
}else {
    echo "Failed Insertion";
}
?>