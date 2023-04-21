<?php
include('../app/config.php');

$id_user = $_POST['id_user'];
$rol = $_POST['rol'];


$statement = $pdo->prepare("UPDATE tb_usuarios SET ROL = :ROL, DT_ACTUALIZACION = NOW() WHERE ID = :ID");

$statement->bindParam(':ROL',$rol);
$statement->bindParam(':ID',$id_user);
if ($statement->execute()) {
    echo "Successful Update";?>
    <script>location.href = "assignment.php";</script>
    <?php
} else {
    echo "Failed Update";
}
?>