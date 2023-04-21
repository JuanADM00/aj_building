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
                <h2>Create New User</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card" style="border: 1px solid #606060">
                            <div class="card-header" style="background-color: #007bff; color: #ffffff">
                            <h4>New User</h4>
                            </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Full Name</label>
                                        <input type="text" class="form-control" id="txtFullName">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" id="txtEmail">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="text" class="form-control" id="txtPasswordCreate">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" id="btnSave">Save</button>
                                        <a href="<?php echo $URL;?>/users/" class="btn btn-default">Cancel</a>
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
        var names = $('#txtFullName').val(), email = $('#txtEmail').val(), password_create = $('#txtPasswordCreate').val();
        if (names == "") {
            alert('You must enter full name field');
            $('#txtFullName').focus();
        }else if (email == "") {
            alert('You must enter email field');
            $('#txtEmail').focus();
        }else if (password_create == "") {
            alert('You must enter password field');
            $('#txtPasswordCreate').focus();
        }else{
            var url = 'controller_create.php';
            $.get(url, {names:names, email:email, password_create:password_create}, function (datos) {
                $('#response').html(datos);
            });
        }
    });
</script>