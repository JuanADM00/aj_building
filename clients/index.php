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
                <h2>Clients List</h2>
                <br>
                <div class="row">
                    <div class="col-md-10">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Registered Clients</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sn table-striped">
                                    <th><center>Number</center></th>
                                    <th><center>Client Full Name</center></th>
                                    <th><center>Client TIN</center></th>
                                    <th><center>Car Plate</center></th>
                                    <th><center>Actions</center></th>
                                    <?php
                                    $counter = 0;
                                    $query_clients = $pdo->prepare("SELECT * FROM tb_clients");
                                    $query_clients->execute();
                                    $clients = $query_clients->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($clients as $client) {
                                        $id_client = $client['ID_CLIENT'];
                                        $c_fullname = $client['FULLNAME_CLIENT'];
                                        $c_tin = $client['TIN_CLIENT'];
                                        $car_plate = $client['CAR_PLATE'];
                                        $counter = $counter + 1;
                                        ?>
                                        <tr>
                                            <td><center><?php echo $counter;?></center></td>
                                            <td><?php echo $c_fullname;?></td>
                                            <td><?php echo $c_tin;?></td>
                                            <td><?php echo $car_plate;?></td>
                                            <td>
                                                <center>
                                                    <a href="update.php?id=<?php echo $id_client;?>" class="btn btn-success">Update</a>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
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