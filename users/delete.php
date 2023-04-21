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

                <h2>Delete User</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-danger" style="border: 1px solid #777777">
                                <div class="card-header">
                                    <h3 class="card-title">Do you really want to delete this record?</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Full Name</label>
                                        <input type="text" class="form-control" id="txtFullName" value="<?php echo $nombres?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" id="txtEmail" value="<?php echo $email?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="text" class="form-control" id="txtPasswordDelete" value="<?php echo $password_user?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-danger" id="btnDelete">Delete</button>
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
    $('#btnDelete').click(function () {
        var id_user = <?php echo $id_get;?>, url = 'controller_delete.php';
        $.get(url, {id_user:id_user}, function (datos) {
            $('#response').html(datos);
        });
    });
</script>