<?php

include('../app/config.php');

$s_number = $_GET['s_number'];

$statement = $pdo->prepare("UPDATE tb_mappings SET FREE = 0 WHERE NUM_SPOT = :NUM_SPOT");
$statement->bindParam(":NUM_SPOT", $s_number);
if ($statement->execute()) {
    echo "Successful Update";
} else {
    echo "Failed Update";
}
?>