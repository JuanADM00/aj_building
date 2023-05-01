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
                <h2>Data</h2>
                <br>
                <script>
                    $(document).ready(function() {
                    $('#table_id').DataTable( {
                        "pageLength": 5,
                        "language": {
                            "emptyTable": "No info",
                            "info": "Showing _START_ to _END_ of _TOTAL_ Settings",
                            "infoEmpty": "Showing 0 to 0 of 0 Setting",
                            "infoFiltered": "(_MAX_ Total Settings Filtering)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Show _MENU_ Settings",
                            "loadingRecords": "Loading...",
                            "processing": "Processing...",
                            "search": "Search:",
                            "zeroRecords": "No results found",
                            "paginate": {
                                "first": "First",
                                "last": "Last",
                                "next": "Next",
                                "previous": "Previous"
                            }
                        }
                    });
                });
                </script>
                <a href="create.php" class="btn btn-primary">Register new info</a><br><br>
                <table id="table_id" class="table table-bordered table-sn table-striped">
                    <thead>
                        <th><center>Number</center></th>
                        <th>Business's name</th>
                        <th>Business's activity</th>
                        <th>Business's address</th>
                        <th>Business's area</th>
                        <th>Business's state/department</th>
                        <th>Business's nation</th>
                        <th>Business's phone number</th>
                        <th><center>Actions</center></th>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 0;
                        $query_infos = $pdo->prepare("SELECT * FROM tb_infos");
                        $query_infos->execute();
                        $infos = $query_infos->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($infos as $info) {
                            $id_info = $info['ID_INFO'];
                            $b_name = $info['B_NAME'];
                            $b_activity = $info['B_ACTIVITY'];
                            $b_address = $info['B_ADDRESS'];
                            $b_area = $info['B_AREA'];
                            $b_department = $info['B_DEPARTMENT'];
                            $b_nation = $info['B_NATION'];
                            $b_tel = $info['B_TEL'];
                            $counter = $counter + 1;
                        ?>
                            <tr>
                            <td><center><?php echo $counter;?></center></td>
                            <td><?php echo $b_name;?></td>
                            <td><?php echo $b_activity;?></td>
                            <td><?php echo $b_address;?></td>
                            <td><?php echo $b_area;?></td>
                            <td><?php echo $b_department;?></td>
                            <td><?php echo $b_nation;?></td>
                            <td><?php echo $b_tel;?></td>
                            <td>
                                <center>
                                    <a href="update.php?id=<?php echo $id_info?>" class="btn btn-success">Edit</a>
                                    <a href="delete.php?id=<?php echo $id_info?>" class="btn btn-danger">Delete</a>
                                </center>
                            </td>
                        </tr>
                        <?php
                        }                    
                        ?>
                    </tbody>
                </table>
                </br>
            </div>
        </div>
        <?php include('../layout/admin/footer.php');?>
    </div>
    <?php include('../layout/admin/footer_links.php');?>
</body>
</html>