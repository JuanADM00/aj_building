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
                <h2>Users - Roles Assignment</h2>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Users List</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sn table-striped">
                                    <th><center>Number</center></th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th><center>Assign Role</center></th>
                                    <?php
                                    $counter = 0;
                                    $query_users = $pdo->prepare("SELECT ID, ROL, NOMBRES, EMAIL FROM tb_usuarios WHERE ACTIVO = 1");
                                    $query_users->execute();
                                    $usuarios = $query_users->fetchAll(PDO::FETCH_ASSOC);//ResultSet de usuarios - tipo Array
                                    foreach ($usuarios as $usuario) {
                                        $id = $usuario['ID'];
                                        $nombres = $usuario['NOMBRES'];
                                        $email = $usuario['EMAIL'];
                                        $rol = $usuario['ROL'];
                                        $counter = $counter + 1;
                                    ?>
                                    <tr>
                                        <td><center><?php echo $counter;?></center></td>
                                        <td><?php echo $nombres;?></td>
                                        <td><?php echo $email;?></td>
                                        <td>
                                            <center>
                                                <?php
                                                if ($rol == "") {
                                                    ?>
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal<?php echo $id;?>">
                                                    Assign
                                                    </button>
                                                    <div class="modal fade" id="exampleModal<?php echo $id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Assign Role</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="controller_assign.php" method="post">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="">User Full Name</label>
                                                                                <input type="text" class="form-control" value="<?php echo $nombres;?>" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="">Email</label>
                                                                                <input type="text" class="form-control" value="<?php echo $email;?>" readonly>
                                                                                <input type="text" name="id_user" value="<?php echo $id;?>" hidden>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="">Role</label>
                                                                                <select name="rol" id="" class="form-control">
                                                                                <?php
                                                                                $query_roles = $pdo->prepare("SELECT ID_ROLE, NOMBRE_ROL FROM tb_roles WHERE ACTIVO = 1");
                                                                                $query_roles->execute();
                                                                                $roles = $query_roles->fetchAll(PDO::FETCH_ASSOC);//ResultSet de roles - tipo Array
                                                                                foreach ($roles as $role) {
                                                                                    $id_rol = $role['ID_ROLE'];
                                                                                    $nombre_rol = $role['NOMBRE_ROL'];
                                                                                    ?>
                                                                                    <option value="<?php echo $nombre_rol;?>"><?php echo $nombre_rol;?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Assign Role</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                    <?php
                                                }else {
                                                    echo $rol;
                                                }
                                                ?>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
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