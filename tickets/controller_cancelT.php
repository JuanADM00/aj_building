<?php

include('../app/config.php');

$id_ticket = $_GET['id'];
$s_number = $_GET['spot'];
$statement = $pdo->prepare("UPDATE tb_tickets SET T_STATE = 'CANCELLED' WHERE ID_TICKET = :ID_TICKET");
$statement->bindParam(':ID_TICKET',$id_ticket);
if ($statement->execute()) {
    //Updating Spot State from FILLED to FREE
    $statement_m = $pdo->prepare("UPDATE tb_mappings SET FREE = 1 WHERE NUM_SPOT = :NUM_SPOT");
    $statement_m->bindParam(':NUM_SPOT',$s_number);
    if ($statement_m->execute()) {
        echo "Successful Update";?>
        <script>location.href = "../main.php";</script>
        <?php
    }else {
        echo "Failed Update";
    }
} else {
    echo "Failed Deletion";
}
?>