<?php

include('../app/config.php');

$car_plate = $_GET['car_plate'];
$c_name = $_GET['c_name'];
$c_tin = $_GET['c_tin'];
$e_date = $_GET['e_date'];
$e_time = $_GET['e_time'];
$s_number = $_GET['s_number'];
$u_session = $_GET['u_session'];

$statement = $pdo->prepare('INSERT INTO tb_tickets
(CAR_PLATE, C_NAME, C_TIN, S_NUMBER, ENTRY_DATE, ENTRY_TIME, USER_SESSION)
VALUES (:car_plate,:c_name,:c_tin,:s_number,:e_date,:e_time,:u_session)');

$statement->bindParam(':car_plate',$car_plate);
$statement->bindParam(':c_name',$c_name);
$statement->bindParam(':c_tin',$c_tin);
$statement->bindParam(':s_number',$s_number);
$statement->bindParam(':e_date',$e_date);
$statement->bindParam(':e_time',$e_time);
$statement->bindParam(':u_session',$u_session);

if ($statement->execute()) {
    echo "Successful Insertion";
    ?>
    <script>location.href = "<?php echo $URL?>/main.php";</script>
    <?php 
}else {
    echo "Failed Insertion";
}
?>