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
                <h2>Info Update</h2>
                <br>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">Do not forget to fill in every field</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <?php
                            $id_info_get = $_GET['id'];
                            $query_infos = $pdo->prepare("SELECT * FROM tb_infos WHERE ID_INFO = $id_info_get");
                            $query_infos->execute();
                            $infos = $query_infos->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($infos as $info) {
                                $b_name = $info['B_NAME'];
                                $b_activity = $info['B_ACTIVITY'];
                                $b_address = $info['B_ADDRESS'];
                                $b_area = $info['B_AREA'];
                                $b_department = $info['B_DEPARTMENT'];
                                $b_nation = $info['B_NATION'];
                                $b_tel = $info['B_TEL'];
                            }
                            ?>
                            <div class="card-body" style="display: block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Business's name <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="txtBName" value="<?php echo $b_name?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Business's activity <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="txtBActivity" value="<?php echo $b_activity?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Business's address <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="txtBAddress" value="<?php echo $b_address?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Business's area <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="txtBArea" value="<?php echo $b_area?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Business's state/department <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="txtBDepartment" value="<?php echo $b_department?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Business's nation <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="txtBNation" value="<?php echo $b_nation?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Business's phone number <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="txtBPhoneNumber" value="<?php echo $b_tel?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="infos.php" class="btn btn-default btn-block">Cancel</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-success btn-block" id="btnUpdate">
                                            Update
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
    $('#btnUpdate').click(function () {
        var id_info = <?php echo $id_info_get?>;
        var b_Name = $('#txtBName').val();
        var b_Activity = $('#txtBActivity').val();
        var b_Address = $('#txtBAddress').val();
        var b_Area = $('#txtBArea').val();
        var b_Department = $('#txtBDepartment').val();
        var b_Nation = $('#txtBNation').val();
        var b_PhoneNumber = $('#txtBPhoneNumber').val();
        if (b_Name == "") {
            alert('Empty required field(s)');
            $('#txtBName').focus();
        }else if (b_Activity == "") {
            alert('Empty required field(s)');
            $('#txtBActivity').focus();
        }else if (b_Address == "") {
            alert('Empty required field(s)');
            $('#txtBAddress').focus();
        }else if (b_Area == "") {
            alert('Empty required field(s)');
            $('#txtBArea').focus();
        }else if (b_Department == "") {
            alert('Empty required field(s)');
            $('#txtBDepartment').focus();
        }else if (b_Nation == "") {
            alert('Empty required field(s)');
            $('#txtBNation').focus();
        }else if (b_PhoneNumber == "") {
            alert('Empty required field(s)');
            $('#txtBPhoneNumber').focus();
        }else{
            var url = 'controller_update.php';
            $.get(url, {id_info:id_info, b_Name:b_Name, b_Activity:b_Activity, b_Address:b_Address, b_Area:b_Area, b_Department:b_Department, b_Nation:b_Nation, b_PhoneNumber:b_PhoneNumber}, function (datos) {
                $('#response').html(datos);
            });
        }
    });
</script>