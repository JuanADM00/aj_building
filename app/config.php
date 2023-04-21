<?php

define('SERVER', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('BD', 'parkingrecord');

$server = "mysql:dbname=".BD."; host=".SERVER;

try {
    $pdo = new PDO($server,USER,PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    //echo "Conexión exitosa a la BD";
} catch (PDOException $e) {
    echo "<script>alert('Error a la BD')</script>";
}

$URL = "http://localhost/www.ajbuilding.com"
?>