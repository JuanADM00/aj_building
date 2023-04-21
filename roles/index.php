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
                <h2>Roles List</h2>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-sn table-striped">
                            <th><center>Number</center></th>
                            <th>Role Name</th>
                            <th><center>Actions</center></th>
                            <?php
                            $counter = 0;
                            $query_roles = $pdo->prepare("SELECT ID_ROLE, NOMBRE_ROL FROM tb_roles WHERE ACTIVO = 1");
                            $query_roles->execute();
                            $roles = $query_roles->fetchAll(PDO::FETCH_ASSOC);//ResultSet de roles - tipo Array
                            foreach ($roles as $role) {
                                $id_rol = $role['ID_ROLE'];
                                $nombre_rol = $role['NOMBRE_ROL'];
                                $counter = $counter + 1;
                                ?>
                            <tr>
                                <td><center><?php echo $counter;?></center></td>
                                <td><?php echo $nombre_rol;?></td>
                                <td>
                                    <center>
                                        <a href="delete.php?id=<?php echo $id_rol;?>" class="btn btn-danger">Delete</a>
                                    </center>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
                </br>
            </div>
        </div>
        <?php include('../layout/admin/footer.php');?>
    </div>
    <?php include('../layout/admin/footer_links.php');?>
</body>
</html>