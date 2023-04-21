<?php
include('../app/config.php');

$id_info = $_GET['id_info'];
$b_Name = $_GET['b_Name'];
$b_Activity = $_GET['b_Activity'];
$b_Address = $_GET['b_Address'];
$b_Area = $_GET['b_Area'];
$b_Department = $_GET['b_Department'];
$b_Nation = $_GET['b_Nation'];
$b_PhoneNumber = $_GET['b_PhoneNumber'];

$statement = $pdo->prepare("UPDATE tb_infos SET B_NAME = :B_NAME, B_ACTIVITY = :B_ACTIVITY, B_ADDRESS = :B_ADDRESS, B_AREA = :B_AREA, B_DEPARTMENT = :B_DEPARTMENT, B_NATION = :B_NATION, B_TEL = :B_TEL WHERE ID_INFO = :ID_INFO");

$statement->bindParam(':B_NAME',$b_Name);
$statement->bindParam(':B_ACTIVITY',$b_Activity);
$statement->bindParam(':B_ADDRESS',$b_Address);
$statement->bindParam(':B_AREA',$b_Area);
$statement->bindParam(':B_DEPARTMENT',$b_Department);
$statement->bindParam(':B_NATION',$b_Nation);
$statement->bindParam(':B_TEL',$b_PhoneNumber);
$statement->bindParam(":ID_INFO", $id_info);
if ($statement->execute()) {
    echo "Successful Update";?>
    <script>location.href = "infos.php";</script>
    <?php
} else {
    echo "Failed Update";
}
?>