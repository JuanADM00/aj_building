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
                <h2>Role Deletion</h2>
                <?php
                $id_role = $_GET['id'];
                $query_roles = $pdo->prepare("SELECT ID_ROLE, NOMBRE_ROL FROM tb_roles WHERE ID_ROLE = '$id_role' AND ACTIVO = 1");
                $query_roles->execute();
                $roles = $query_roles->fetchAll(PDO::FETCH_ASSOC);//ResultSet de roles - tipo Array
                foreach ($roles as $role) {
                    $id_rol = $role['ID_ROLE'];
                    $nombre_rol = $role['NOMBRE_ROL'];
                }                    
                ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-danger" style="border: 1px solid #777777">
                            <div class="card-header">
                            <h4>Do you really want to delete this record?</h4>
                            </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Role Name</label>
                                        <input type="text" class="form-control" id="txtRoleName" value = "<?php echo $nombre_rol;?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-danger" id="btnDelete">Delete</button>
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
    $('#btnDelete').click(function () {
        var id_rol = <?php echo $id_role;?>;
        var url = 'controller_delete.php';
        $.get(url, {id_rol:id_rol}, function (datos) {
            $('#response').html(datos);
        });
    });
</script>