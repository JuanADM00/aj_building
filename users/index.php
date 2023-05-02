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
                <script>
                    $(document).ready(function() {
                    $('#table_id').DataTable( {
                        "pageLength": 5,
                        "language": {
                            "emptyTable": "No info",
                            "info": "Showing _START_ to _END_ of _TOTAL_ Users",
                            "infoEmpty": "Showing 0 to 0 of 0 Users",
                            "infoFiltered": "(_MAX_ Total Users Filtering)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Show _MENU_ Users",
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
                <table id="table_id" class="table table-bordered table-sn table-striped">
                    <thead>
                        <th><center>Number</center></th>
                        <th>Username</th>
                        <th>Email</th>
                        <th><center>Actions</center></th>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>
                <hr>
                <a href="generate_report.php" class="btn btn-primary">
                    Generate reports
                    <i class="fa fa">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                            <path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v6zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z"/>
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                        </svg>
                    </i>
                </a>
            </div>
        </div>
        <?php include('../layout/admin/footer.php');?>
    </div>
    <?php include('../layout/admin/footer_links.php');?>
</body>
</html>