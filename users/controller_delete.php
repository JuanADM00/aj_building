<?php

include('../app/config.php');

$id_user = $_GET['id_user'];
$statement = $pdo->prepare("UPDATE tb_usuarios SET ACTIVO = 0, DT_ELIMINACION = NOW() WHERE ID = '$id_user'");
if ($statement->execute()) {
    echo "Successful Deletion";?>
    <script>location.href = "index.php";</script>
    <?php
} else {
    echo "Failed Deletion";
}
?>