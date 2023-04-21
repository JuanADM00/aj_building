<?php

include('../app/config.php');

session_start();

$usuario_user = $_POST['usuario'];
$password_user = $_POST['password_user'];

$query_login = $pdo->prepare("SELECT * FROM tb_usuarios WHERE EMAIL = '$usuario_user' AND PASSWORD_USER = '$password_user' AND ACTIVO = 1");
$query_login->execute();
$usuarios = $query_login->fetchAll(PDO::FETCH_ASSOC);//ResultSet de usuarios - tipo Array

if (!empty($usuarios)) {
    ?>
    <div class="alert alert-success" role="alert">
            Usuario Correcto
    </div>
    <script>
        location.href = "main.php";
    </script>
    <?php
    $_SESSION['user_session'] = $usuario_user;
}else{
    ?>
    <div class="alert alert-danger" role="alert">
            Credenciales Incorrectas
    </div>
    <script>
        $('#txtUser').val('');
        $('#txtPassword').val('');
        $('#txtUser').focus();
    </script>
    <?php
}
//if ($user == "juanpis1326@gmail") {
    //?>
    <!--<div class="alert alert-success" role="alert">
            Usuario Correcto
    </div> -->
    <?php
//}else {
    ?>
    <!--<div class="alert alert-danger" role="alert">
            Usuario Incorrecto
    </div> -->
    <?php
//}
?>