<?php
include('../app/config.php');
include('../layout/admin/user_session_data.php');
?>
<!DOCTYPE html>
<html lang="es">
<head><?php include('../layout/admin/head.php');?></head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('../layout/admin/menu.php');?>
        <div class="content-wrapper">
            <br>
            <div class="container">
                <h2>Clients Update</h2>
                <br>
                <div class="row">
                    <div class="col-md-10">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">Data Update</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <?php
                            $id_client_get = $_GET['id'];
                            $query_clients = $pdo->prepare("SELECT FULLNAME_CLIENT, TIN_CLIENT, CAR_PLATE FROM tb_clients WHERE ID_CLIENT = '$id_client_get'");
                            $query_clients->execute();
                            $clients = $query_clients->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($clients as $client) {
                                $c_fullname = $client['FULLNAME_CLIENT'];
                                $c_tin = $client['TIN_CLIENT'];
                                $car_plate = $client['CAR_PLATE'];
                            }
                            ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Client Name <span style="color: red"><b>*</b></span></label>
                                            <input type="text" class="form-control" id="txtClientFullname" value="<?php echo $c_fullname?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Client TIN <span style="color: red"><b>*</b></span></label>
                                            <input type="text" class="form-control" id="txtClientTIN" value="<?php echo $c_tin?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Car Plate <span style="color: red"><b>*</b></span></label>
                                            <input type="text" class="form-control" id="txtCarPlate" value="<?php echo $car_plate?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <a href="index.php" class="btn btn-default">Cancel</a>
                                                <button class="btn btn-success" id="btnUpdateClient">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="response"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../layout/admin/footer.php');?>
    </div>
<?php include('../layout/admin/footer_links.php');?>
</body>
</html>

<script>
    $('#btnUpdateClient').click(function () {
        var c_fullname = $('#txtClientFullname').val(),
        c_tin = $('#txtClientTIN').val(),
        car_plate = $('#txtCarPlate').val(),
        id_client = "<?php echo $id_client_get?>";
        if (c_fullname == "") {
            alert('You must enter client full name field');
            $('#txtClientFullname').focus();
        }else if (c_tin == "") {
            alert('You must enter client TIN field');
            $('#txtClientTIN').focus();
        }else if (car_plate == "") {
            alert('You must enter car plate field');
            $('#txtCarPlate').focus();
        }else{
            var url = 'controller_update.php';
            $.get(url, {c_fullname:c_fullname, c_tin:c_tin, car_plate:car_plate, id_client:id_client}, function (datos) {
                $('#response').html(datos);
            });
        }
    });
</script>