<?php

include('../app/config.php');

$names = $_GET['names'];
$email = $_GET['email'];
$password_create = $_GET['password_create'];

//echo $names." - ".$email." - ".$password_create;

$statement = $pdo->prepare("INSERT INTO tb_usuarios (NOMBRES, EMAIL, PASSWORD_USER) VALUES (:NOMBRES, :EMAIL, :PASSWORD_USER)");

$statement->bindParam("NOMBRES", $names);
$statement->bindParam("EMAIL", $email);
$statement->bindParam("PASSWORD_USER", $password_create);


if ($statement->execute()) {
    echo "Successful Insertion";
    ?>
    <script>location.href = "../roles/assignment.php";</script>
    <?php 
}else {
    echo "Failed Insertion";
}
?>