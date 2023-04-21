<?php

include('../app/config.php');

$roleName = $_GET['roleName'];

$statement = $pdo->prepare("INSERT INTO tb_roles (NOMBRE_ROL) VALUES (:NOMBRE_ROL)");
$statement->bindParam("NOMBRE_ROL", $roleName);


if ($statement->execute()) {
    echo "Successful Insertion";
    ?>
    <script>location.href = "index.php";</script>
    <?php 
}else {
    echo "Failed Insertion";
}
?>