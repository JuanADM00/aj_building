<?php

include('../app/config.php');

session_start();
if (isset($_SESSION['user_session'])) {
    session_destroy();
    header("Location: ".$URL."/");
}
?>