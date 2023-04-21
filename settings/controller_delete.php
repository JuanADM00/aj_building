<?php

include('../app/config.php');

$id_info = $_GET['id_info'];
$statement = $pdo->prepare("DELETE FROM tb_infos WHERE ID_INFO = :ID_INFO");
$statement->bindParam(':ID_INFO',$id_info);
if ($statement->execute()) {
    echo "Successful Deletion";?>
    <script>location.href = "infos.php";</script>
    <?php
} else {
    echo "Failed Deletion";
}
?>