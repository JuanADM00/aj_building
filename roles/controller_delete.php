<?php

include('../app/config.php');

$id_rol = $_GET['id_rol'];
$statement = $pdo->prepare("UPDATE tb_roles SET ACTIVO = 0, DT_ELIMINACION = NOW() WHERE ID_ROLE = '$id_rol'");
if ($statement->execute()) {
    echo "Successful Deletion";?>
    <script>location.href = "index.php";</script>
    <?php
} else {
    echo "Failed Deletion";
}
?>