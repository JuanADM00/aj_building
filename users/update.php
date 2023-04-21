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

                <?php
                $id_get = $_GET['id'];
                $query_user = $pdo->prepare("SELECT ID, NOMBRES, EMAIL, PASSWORD_USER FROM tb_usuarios WHERE ID = '$id_get' AND ACTIVO = 1");
                $query_user->execute();
                $usuarios = $query_user->fetchAll(PDO::FETCH_ASSOC);
                foreach ($usuarios as $usuario) {
                    $id = $usuario['ID'];
                    $nombres = $usuario['NOMBRES'];
                    $email = $usuario['EMAIL'];
                    $password_user = $usuario['PASSWORD_USER'];
                }
                ?>

                <h2>Update User</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-success" style="border: 1px solid #777777">
                                <div class="card-header">
                                    <h3 class="card-title">New Data</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Full Name</label>
                                        <input type="text" class="form-control" id="txtFullName" value="<?php echo $nombres?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" id="txtEmail" value="<?php echo $email?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="text" class="form-control" id="txtPasswordUpdate" value="<?php echo $password_user?>">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" id="btnUpdate">Update</button>
                                        <a href="<?php echo $URL;?>/users/" class="btn btn-default">Cancel</a>
                                    </div>
                                    <div id="response"></div>
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
    $('#btnUpdate').click(function () {
        var names = $('#txtFullName').val(), email = $('#txtEmail').val(), password_update = $('#txtPasswordUpdate').val(), id_user = <?php echo $id_get;?>;
        if (names == "") {
            alert('You must enter full name field');
            $('#txtFullName').focus();
        }else if (email == "") {
            alert('You must enter email field');
            $('#txtEmail').focus();
        }else if (password_update == "") {
            alert('You must enter password field');
            $('#txtPasswordUpdate').focus();
        }else{
            var url = 'controller_update.php';
            $.get(url, {names:names, email:email, password_update:password_update, id_user:id_user}, function (datos) {
                $('#response').html(datos);
            });
        }
    });
</script>