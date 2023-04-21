<?php

include('../app/config.php');

$spotNumber = $_GET['spotNumber'];
$spotObs = $_GET['spotObs'];

$statement = $pdo->prepare("INSERT INTO tb_mappings (NUM_SPOT, FREE, AVAILABLE, OBS) VALUES (:NUM_SPOT, 1, 1, :OBS)");

$statement->bindParam("NUM_SPOT", $spotNumber);
$statement->bindParam("OBS", $spotObs);

if ($statement->execute()) {
    echo "Successful Insertion";
    ?>
    <script>location.href = "vehicles_mapping.php";</script>
    <?php 
}else {
    echo "Failed Insertion";
}
?>