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
                <h2>Create New Role</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card" style="border: 1px solid #606060">
                            <div class="card-header" style="background-color: #007bff; color: #ffffff">
                            <h4>New Role</h4>
                            </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Role Name</label>
                                        <input type="text" class="form-control" id="txtRoleName">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" id="btnSave">Save</button>
                                        <a href="<?php echo $URL;?>/roles/" class="btn btn-default">Cancel</a>
                                    </div>
                                    <div id="response"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
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
    $('#btnSave').click(function () {
        var roleName = $('#txtRoleName').val();
        if (roleName == "") {
            alert('You must enter role name field');
            $('#txtRoleName').focus();
        }else{
            var url = 'controller_create.php';
            $.get(url, {roleName:roleName}, function (datos) {
                $('#response').html(datos);
            });
        }
    });
</script>