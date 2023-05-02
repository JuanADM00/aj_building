<?php

session_start();
if (isset($_SESSION['user_session'])) {
    $user_session = $_SESSION['user_session'];
    $query_session = $pdo->prepare("SELECT NOMBRES, ROL FROM tb_usuarios WHERE EMAIL = '$user_session' AND ACTIVO = 1");
    $query_session->execute();
    $user_sessions = $query_session->fetchAll(PDO::FETCH_ASSOC);//ResultSet de usuarios - tipo Array
    foreach ($user_sessions as $session) {
        $nombres_session = $session['NOMBRES'];
        $role_session = $session['ROL'];
    }
}else{
    echo "You must be logged";
    header('Location: '.$URL.'/login');
}
?>