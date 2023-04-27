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
                <h2>Prices List</h2>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Set prices</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sn table-striped">
                                    <th><center>Number</center></th>
                                    <th><center>Amount</center></th>
                                    <th><center>Detail</center></th>
                                    <th><center>Price</center></th>
                                    <th><center>Currency</center></th>
                                    <th><center>Actions</center></th>
                                    <?php
                                    $counter = 0;
                                    $query_prices = $pdo->prepare("SELECT * FROM tb_prices");
                                    $query_prices->execute();
                                    $prices = $query_prices->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($prices as $price) {
                                        $id_price = $price['ID_PRICE'];
                                        $amount = $price['AMOUNT'];
                                        $detail = $price['DETAIL'];
                                        $p_value = $price['P_VALUE'];
                                        $currency = $price['CURRENCY'];
                                        $counter = $counter + 1;
                                        ?>
                                        <tr>
                                            <td><center><?php echo $counter;?></center></td>
                                            <td><center><?php echo $amount;?></center></td>
                                            <td><center><?php echo $detail;?></center></td>
                                            <td><center><?php echo $p_value;?></center></td>
                                            <td><center><?php echo $currency;?></center></td>
                                            <td>
                                                <center>
                                                    <a href="update.php?id=<?php echo $id_price;?>" class="btn btn-success">Update</a>
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