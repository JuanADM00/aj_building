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
                <h2>Info Deletion</h2>
                <br>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-outline card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Do you really want to delete this record?</h3>
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
                                        <label for="">Business's name</label>
                                        <input type="text" class="form-control" id="txtBName" value="<?php echo $b_name?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Business's activity</label>
                                        <input type="text" class="form-control" id="txtBActivity" value="<?php echo $b_activity?>" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Business's address</label>
                                        <input type="text" class="form-control" id="txtBAddress" value="<?php echo $b_address?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Business's area</label>
                                        <input type="text" class="form-control" id="txtBArea" value="<?php echo $b_area?>" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Business's state/department</label>
                                        <input type="text" class="form-control" id="txtBDepartment" value="<?php echo $b_department?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Business's nation</label>
                                        <input type="text" class="form-control" id="txtBNation" value="<?php echo $b_nation?>" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Business's phone number</label>
                                        <input type="text" class="form-control" id="txtBPhoneNumber" value="<?php echo $b_tel?>" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="infos.php" class="btn btn-default btn-block">Cancel</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger btn-block" id="btnDelete">
                                            Delete
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
    $('#btnDelete').click(function () {
        var id_info = <?php echo $id_info_get?>;
        var url = 'controller_delete.php';
            $.get(url, {id_info:id_info}, function (datos) {
                $('#response').html(datos);
            });
    });
</script>