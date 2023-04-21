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
                <h2>Users List</h2>
                <br>
                <table class="table table-bordered table-sn table-striped">
                    <th><center>Number</center></th>
                    <th>Username</th>
                    <th>Email</th>
                    <th><center>Actions</center></th>
                    <?php
                    $counter = 0;
                    $query_users = $pdo->prepare("SELECT ID, NOMBRES, EMAIL FROM tb_usuarios WHERE ACTIVO = 1");
                    $query_users->execute();
                    $usuarios = $query_users->fetchAll(PDO::FETCH_ASSOC);//ResultSet de usuarios - tipo Array
                    foreach ($usuarios as $usuario) {
                        $id = $usuario['ID'];
                        $nombres = $usuario['NOMBRES'];
                        $email = $usuario['EMAIL'];
                        $counter = $counter + 1;
                    ?>
                        <tr>
                        <td><center><?php echo $counter;?></center></td>
                        <td><?php echo $nombres;?></td>
                        <td><?php echo $email;?></td>
                        <td>
                            <center>
                                <a href="update.php?id=<?php echo $id?>" class="btn btn-success">Edit</a>
                                <a href="delete.php?id=<?php echo $id?>" class="btn btn-danger">Delete</a>
                            </center>
                        </td>
                    </tr>
                    <?php
                    }                    
                    ?>
                </table>
                </br>
            </div>
        </div>
        <?php include('../layout/admin/footer.php');?>
    </div>
    <?php include('../layout/admin/footer_links.php');?>
</body>
</html>