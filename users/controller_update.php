<?php
include('../app/config.php');

$names = $_GET['names'];
$email = $_GET['email'];
$password_update = $_GET['password_update'];
$id_user = $_GET['id_user'];

//echo $names."-".$email."-".$password_update;

$statement = $pdo->prepare("UPDATE tb_usuarios SET NOMBRES = :NOMBRES, EMAIL = :EMAIL, PASSWORD_USER = :PASSWORD_USER, DT_ACTUALIZACION = NOW() WHERE ID = :ID");

$statement->bindParam("NOMBRES", $names);
$statement->bindParam("EMAIL", $email);
$statement->bindParam("PASSWORD_USER", $password_update);
$statement->bindParam("ID", $id_user);
if ($statement->execute()) {
    echo "Successful Update";?>
    <script>location.href = "index.php";</script>
    <?php
} else {
    echo "Failed Update";
}
?>