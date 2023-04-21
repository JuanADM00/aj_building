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
                <h2>Spot Registration</h2>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Do not forget to fill in every field</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Spot Number</label>
                                            <input type="number" id="txtSpotNumber" class="form-control" oninput="this.value = this.valueAsNumber">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Spot Current State</label>
                                            <select name="" id="txtSpotState" class="form-control">
                                                <option value="AVAILABLE">AVAILABLE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Notes</label>
                                            <textarea name="" id="txtSpotObs" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="" class="btn btn-default btn-block">Cancel</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-block" id="btnRegister">
                                            Register
                                        </button>
                                    </div>
                                </div>
                                <div id="response"></div>
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
    $('#btnRegister').click(function () {
        var spotNumber = $('#txtSpotNumber').val(),
        spotState = $('#txtSpotState').val(),
        spotObs = $('#txtSpotObs').val();
        if (spotNumber == "") {
            alert('You must enter spot number field');
            $('#txtSpotNumber').focus();
        }else{
            var url = 'controller_create.php';
            $.get(url, {spotNumber:spotNumber, spotObs:spotObs}, function (datos) {
                $('#response').html(datos);
            });
        }
    });
</script>