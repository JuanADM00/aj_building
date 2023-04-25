<?php

include('../app/config.php');
$car_plate = $_GET['car_plate'];
$id_map = $_GET['id_map'];
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
        <label for="staticEmail" class="col-sm-3 col-form-label">Client Name: <span><b style="color: red">*</b></span></label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="c_name<?php echo $id_map;?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label">TIN: <span><b style="color: red">*</b></span></label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="c_tin<?php echo $id_map;?>">
        </div>
    </div>
    <?php
}else {
    ?>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label">Client Name: <span><b style="color: red">*</b></span></label>
        <div class="col-sm-9">
            <input type="text" class="form-control"  id="c_name<?php echo $id_map;?>" value="<?php echo $nombre_client?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label">TIN: <span><b style="color: red">*</b></span></label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="c_tin<?php echo $id_map;?>" value="<?php echo $nit_client?>" readonly>
        </div>
    </div>
    <?php
}
//Searching car plate into tickets BD table
$query_tickets = $pdo->prepare("SELECT * FROM tb_tickets WHERE CAR_PLATE = '$car_plate' AND T_STATE = 'FILLED'");
$query_tickets->execute();
$tickets_data = $query_tickets->fetchAll(PDO::FETCH_ASSOC);
if (!empty($tickets_data)) {
    ?><div class="alert alert-danger">This vehicle is currently parked</div>
    <script>
        $('#btnPrintTicket<?php echo $id_map?>').attr('disabled', 'disabled');
    </script>
    <?php
}else {
    ?><div class="alert alert-info">No problem</div>
    <script>
        $('#btnPrintTicket<?php echo $id_map?>').removeAttr('disabled');
    </script>
    <?php
}
?>