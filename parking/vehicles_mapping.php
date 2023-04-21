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
                <h2>Parking Spots</h2>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-sn table-striped">
                            <th><center>Number</center></th>
                            <th>Space Number</th>
                            <th><center>State</center></th>
                            <?php
                            $counter = 0;
                            $query_mapping = $pdo->prepare("SELECT ID_MAP, NUM_SPOT FROM tb_mappings WHERE AVAILABLE = 1");
                            $query_mapping->execute();
                            $mappings = $query_mapping->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($mappings as $mapping) {
                                $id_map = $mapping['ID_MAP'];
                                $num_spot = $mapping['NUM_SPOT'];
                                $counter = $counter + 1;
                                ?>
                                <tr>
                                    <td><center><?php echo $counter;?></center></td>
                                    <td><?php echo $num_spot;?></td>
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