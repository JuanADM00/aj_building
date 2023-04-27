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
                <h2>Prices Update</h2>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">Carefully fill out all the fields</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                $id_price_get = $_GET['id'];
                                $query_prices = $pdo->prepare("SELECT AMOUNT, DETAIL, P_VALUE, CURRENCY FROM tb_prices WHERE ID_PRICE = '$id_price_get'");
                                $query_prices->execute();
                                $prices = $query_prices->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($prices as $price) {
                                    $amount = $price['AMOUNT'];
                                    $detail = $price['DETAIL'];
                                    $p_value = $price['P_VALUE'];
                                    $currency = $price['CURRENCY'];
                                }
                                ?>
                                <div class="row">
                                    <script>
                                    function isNumberKey(evt) {
                                        var charCode = (evt.which) ? evt.which : evt.keyCode
                                        if (charCode > 31 && (charCode < 48 || charCode > 57))
                                        return false;
                                        return true;
                                    }
                                    </script>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Amount <span style="color: red"><b>*</b></span></label>
                                            <input type="number" min="0" class="form-control" onkeydown="return isNumberKey(event)" id="nAmount" value="<?php echo $amount?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Detail <span style="color: red"><b>*</b></span></label>
                                            <select name="" class="form-control" id="txtDetail" value="<?php echo $detail?>">
                                                <?php
                                                if ($detail == "HOURS") {
                                                    ?>
                                                    <option value="HOURS">HOURS</option>
                                                    <option value="DAYS">DAYS</option>
                                                    <?php
                                                }else {
                                                    ?>
                                                    <option value="DAYS">DAYS</option>
                                                    <option value="HOURS">HOURS</option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Price Value <span style="color: red"><b>*</b></span></label>
                                            <input type="number" min="0" class="form-control" onkeydown="return isNumberKey(event)" id="nValue" value="<?php echo $p_value?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Currency <span style="color: red"><b>*</b></span></label>
                                            <input type="text" class="form-control" style="text-transform: uppercase" id="txtCurrency" value="<?php echo $currency?>">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="index.php" class="btn btn-default">Cancel</a>
                                        <button class="btn btn-success" id="btnUpdatePrice">Register Price</button>
                                    </div>
                                </div>
                                <script>
                                    $('#btnUpdatePrice').click(function () {
                                        var id_price = <?php echo $id_price_get?>,
                                        amount = $('#nAmount').val();
                                        detail = $('#txtDetail').val();
                                        p_value = $('#nValue').val();
                                        currency = $('#txtCurrency').val();
                                        if (amount == "") {
                                            alert("Empty required fields");
                                            $('#nAmount').focus();
                                        } else if (p_value == "") {
                                            alert("Empty required fields");
                                            $('#nValue').focus();
                                        } else if (currency == "") {
                                            alert("Empty required fields");
                                            $('#txtCurrency').focus();
                                        } else{
                                            var url = 'controller_update.php';
                                            $.get(url, {id_price:id_price, amount:amount, detail:detail, p_value:p_value, currency:currency}, function (datos) {
                                                $('#response').html(datos);
                                            });
                                        }
                                    });
                                </script>
                            </div>
                            <div id="response"></div>
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