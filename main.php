<?php

include('app/config.php');
include('layout/admin/user_session_data.php');

//Retrieving ID_INFO
$query_infos = $pdo->prepare("SELECT ID_INFO FROM tb_infos");
$query_infos->execute();
$infos = $query_infos->fetchAll(PDO::FETCH_ASSOC);
foreach ($infos as $info) {
    $id_info = $info['ID_INFO'];
}


/*Retrieving bill number
$counter_bn = -1;
$query_bills = $pdo->prepare("SELECT COUNT(ID_BILL) FROM tb_billing");
$query_bills->execute();
$counter_bn = $query_bills->fetchColumn();
$counter_bn = $counter_bn + 1;*/
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include('layout/admin/head.php');?>
    </head>
    <body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('layout/admin/menu.php');?>
        <div class="content-wrapper">
            <br>
            <div class="container">
                <h2>Welcome to AJ-Building Parking System</h2>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Current Map</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    $query_mapping = $pdo->prepare("SELECT ID_MAP, NUM_SPOT, FREE FROM tb_mappings WHERE AVAILABLE = 1");
                                    $query_mapping->execute();
                                    $mappings = $query_mapping->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($mappings as $mapping) {
                                        $id_map = $mapping['ID_MAP'];
                                        $num_spot = $mapping['NUM_SPOT'];
                                        $free = $mapping['FREE'];
                                        if ($free == 1) {?>
                                            <div class="col">
                                                <center>
                                                    <h2><?php echo $num_spot;?></h2>
                                                    <button class="btn btn-success" style="width: 100%; height: 109px" data-toggle="modal" data-target="#modal<?php echo $id_map;?>">
                                                        <p>FREE</p>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal<?php echo $id_map;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Entry of the vehicle</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                <form>
                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">Car plate: <span><b style="color: red">*</b></span></label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" style="text-transform: uppercase" class="form-control" id="carPlate<?php echo $id_map;?>">
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <button class="btn btn-primary" id="btnSearchClient<?php echo $id_map;?>" type="button">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                                                </svg>
                                                                                Search
                                                                            </button>
                                                                            <script>
                                                                                $('#btnSearchClient<?php echo $id_map;?>').click(function() {
                                                                                    var car_plate = $('#carPlate<?php echo $id_map;?>').val();
                                                                                    var id_map = "<?php echo $id_map;?>";
                                                                                    if (car_plate == "") {
                                                                                        alert('You must enter car plate field');
                                                                                        $('#carPlate<?php echo $id_map;?>').focus();
                                                                                    }else{
                                                                                        var url = 'clients/controller_search_clients.php';
                                                                                        $.get(url, {car_plate:car_plate, id_map:id_map}, function (datos) {
                                                                                            $('#researchResponse<?php echo $id_map;?>').html(datos);
                                                                                        });
                                                                                    }
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                    </div>

                                                                    <div id="researchResponse<?php echo $id_map;?>"></div>
                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">Entry Date:</label>
                                                                        <div class="col-sm-9">
                                                                            <?php
                                                                            date_default_timezone_set("America/Bogota");
                                                                            $currentDateTime = date("Y-m-d h:i:s");
                                                                            $day = date('d');
                                                                            $month = date('m');
                                                                            $year = date('Y');
                                                                            ?>
                                                                            <input type="date" class="form-control" id="dateEntry<?php echo $id_map;?>" value="<?php echo $year."-".$month."-".$day?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">Entry Time:</label>
                                                                        <div class="col-sm-9">
                                                                            <?php
                                                                            date_default_timezone_set("America/Bogota");
                                                                            $currentDateTime = date("Y-m-d h:i:s");
                                                                            $hour = date('H');
                                                                            $minute = date('i');
                                                                            ?>
                                                                            <input type="time" class="form-control" id="timeEntry<?php echo $id_map;?>" value="<?php echo $hour.":".$minute?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">Spot Number:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" id="spot<?php echo $id_map;?>" value="<?php echo $num_spot?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <button type="button" class="btn btn-primary" id="btnPrintTicket<?php echo $id_map?>">Print ticket</button>
                                                                    <script>
                                                                        $('#btnPrintTicket<?php echo $id_map?>').click(function () {
                                                                            var car_plate = $('#carPlate<?php echo $id_map;?>').val();
                                                                            var c_name = $('#c_name<?php echo $id_map;?>').val();
                                                                            var c_tin = $('#c_tin<?php echo $id_map;?>').val();
                                                                            var e_date = $('#dateEntry<?php echo $id_map;?>').val();
                                                                            var e_time = $('#timeEntry<?php echo $id_map;?>').val();
                                                                            var s_number = $('#spot<?php echo $id_map?>').val();
                                                                            var u_session = "<?php echo $nombres_session?>";
                                                                            if (car_plate == "") {
                                                                                alert("Empty required fields");
                                                                                $('#carPlate<?php echo $id_map;?>').focus();
                                                                            }else if (c_name == "") {
                                                                                alert("Empty required fields");
                                                                                $('#c_name<?php echo $id_map;?>').focus();
                                                                            }else if (c_tin == "") {
                                                                                alert("Empty required fields");
                                                                                $('#c_tin<?php echo $id_map;?>').focus();
                                                                            }else{
                                                                                var url_s = 'parking/spot_controller.php';
                                                                                $.get(url_s, {s_number:s_number}, function (datos) {
                                                                                    $('#response_spot').html(datos);
                                                                                });
                                                                                
                                                                                var url_c = 'clients/controller_register_clients.php';
                                                                                $.get(url_c, {c_name:c_name, c_tin:c_tin, car_plate:car_plate}, function (datos) {
                                                                                    $('#response_client').html(datos);
                                                                                });

                                                                                var url_t = 'tickets/controller_registerT.php';
                                                                                $.get(url_t, {car_plate:car_plate, c_name:c_name, c_tin:c_tin, e_date:e_date, e_time:e_time, s_number:s_number, u_session:u_session}, function (datos) {
                                                                                    $('#response_ticket').html(datos);
                                                                                });
                                                                            }
                                                                        });
                                                                    </script>
                                                                </div>
                                                                <div id="response_spot"></div>
                                                                <div id="response_client"></div>
                                                                <div id="response_ticket"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </center>
                                            </div>
                                            <?php
                                        }else {
                                            ?>
                                            <div class="col">
                                                <center>
                                                    <h2><?php echo $num_spot;?></h2>
                                                    <button class="btn btn-danger" id="btn_filled<?php echo $id_map;?>" data-toggle="modal" data-target="#exampleModal<?php echo $id_map;?>">
                                                        <img src="<?php echo $URL?>/public/assets/car.png" alt="" width="60px">
                                                    </button>
                                                    <?php

                                                    $query_data = $pdo->prepare("SELECT * FROM tb_tickets WHERE S_NUMBER = '$num_spot' ORDER BY ID_TICKET DESC LIMIT 1");
                                                    $query_data->execute();
                                                    $o_tickets = $query_data->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($o_tickets as $o_ticket) {
                                                        $id_ticket = $o_ticket['ID_TICKET'];
                                                        $car_plate = $o_ticket['CAR_PLATE'];
                                                        $c_name = $o_ticket['C_NAME'];
                                                        $c_tin = $o_ticket['C_TIN'];
                                                        $e_date = $o_ticket['ENTRY_DATE'];
                                                        $e_time = $o_ticket['ENTRY_TIME'];
                                                    }?>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal<?php echo $id_map;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Client Data</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">Car plate:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" style="text-transform: uppercase" class="form-control" id="carPlate<?php echo $id_map;?>" value="<?php echo $car_plate?>" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">Client Name:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" id="c_name<?php echo $id_map;?>" value ="<?php echo $c_name?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">TIN:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" id="c_tin<?php echo $id_map;?>" value ="<?php echo $c_tin?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">Entry Date:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="date" class="form-control" id="dateEntry<?php echo $id_map;?>" value ="<?php echo $e_date?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">Entry Time:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="time" class="form-control" id="timeEntry<?php echo $id_map;?>" value ="<?php echo $e_time?>" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">Spot Number:</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" id="spot<?php echo $id_map;?>" value ="<?php echo $num_spot?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <a href="tickets/controller_cancelT.php?id=<?php echo $id_ticket;?>&&spot=<?php echo $num_spot;?>" class="btn btn-danger">Cancel ticket</a>
                                                                    <a href="tickets/reprint_ticket.php?id=<?php echo $id_ticket;?>" class="btn btn-primary">Print ticket again</a>
                                                                    <button type="button" class="btn btn-success" id="btnInvoice<?php echo $id_map;?>">Invoice</button>
                                                                    <?php
                                                                    //Retrieving ID_CLIENT
                                                                    $query_clients = $pdo->prepare("SELECT ID_CLIENT FROM tb_clients WHERE CAR_PLATE = '$car_plate'");
                                                                    $query_clients->execute();
                                                                    $clients = $query_clients->fetchAll(PDO::FETCH_ASSOC);
                                                                    foreach ($clients as $client) {
                                                                        $id_client = $client['ID_CLIENT'];
                                                                    }
                                                                    //////////?>
                                                                    <script>
                                                                        $('#btnInvoice<?php echo $id_map;?>').click(function () {
                                                                            var id_info = "<?php echo $id_info?>";
                                                                            var id_client = "<?php echo $id_client?>";
                                                                            var entry_date = "<?php echo $e_date?>";
                                                                            var entry_time = "<?php echo $e_time?>";
                                                                            var num_spot = "<?php echo $num_spot?>";
                                                                            var u_session = "<?php echo $nombres_session?>";

                                                                            var url_b = 'billing/controller_register_bill.php';
                                                                            $.get(url_b, {id_info:id_info, id_client:id_client, entry_date:entry_date, entry_time:entry_time, num_spot:num_spot, u_session:u_session}, function (datos) {
                                                                                $('#response_billing<?php echo $id_map;?>').html(datos);
                                                                            });
                                                                        });
                                                                    </script>
                                                                </div>
                                                                <div id="response_billing<?php echo $id_map;?>"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </center>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('layout/admin/footer.php');?>
    </div>
        <?php include('layout/admin/footer_links.php');?>
    </body>
</html>
