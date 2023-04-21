<?php

include('../app/config.php');
$car_plate = $_GET['car_plate'];

$car_plate = strtoupper($car_plate);

$id_client = "";
$nombre_client = "";
$nit_client = "";

$query_search = $pdo->prepare("SELECT * FROM tb_clients WHERE CAR_PLATE = '$car_plate'");
$query_search->execute();
$clients = $query_search->fetchAll(PDO::FETCH_ASSOC);//ResultSet de roles - tipo Array
foreach ($clients as $client) {
    $id_client = $client['ID_CLIENT'];
    $nombre_client = $client['FULLNAME_CLIENT'];
    $nit_client = $client['TIN_CLIENT'];
}
if ($nombre_client == "") {
    ?>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label">Client Name:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label">TIN:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control">
        </div>
    </div>
    <?php
}else {
    ?>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label">Client Name:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php echo $nombre_client?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label">TIN:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php echo $nit_client?>" readonly>
        </div>
    </div>
    <?php
}
?>