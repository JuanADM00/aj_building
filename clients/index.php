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
                <h2>Clients List</h2>
                <br>
                <script>
                    $(document).ready(function() {
                    $('#table_id').DataTable( {
                        "pageLength": 5,
                        "language": {
                            "emptyTable": "No info",
                            "info": "Showing _START_ to _END_ of _TOTAL_ Clients",
                            "infoEmpty": "Showing 0 to 0 of 0 Clients",
                            "infoFiltered": "(_MAX_ Total Clients Filtering)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Show _MENU_ Clients",
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
                <div class="row">
                    <div class="col-md-10">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Registered Clients</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="table_id" class="table table-bordered table-sn table-striped">
                                    <thead>
                                       <th><center>Number</center></th>
                                        <th><center>Client Full Name</center></th>
                                        <th><center>Client TIN</center></th>
                                        <th><center>Car Plate</center></th>
                                        <th><center>Actions</center></th> 
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 0;
                                        $query_clients = $pdo->prepare("SELECT * FROM tb_clients");
                                        $query_clients->execute();
                                        $clients = $query_clients->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($clients as $client) {
                                            $id_client = $client['ID_CLIENT'];
                                            $c_fullname = $client['FULLNAME_CLIENT'];
                                            $c_tin = $client['TIN_CLIENT'];
                                            $car_plate = $client['CAR_PLATE'];
                                            $counter = $counter + 1;
                                            ?>
                                            <tr>
                                                <td><center><?php echo $counter;?></center></td>
                                                <td><?php echo $c_fullname;?></td>
                                                <td><?php echo $c_tin;?></td>
                                                <td><?php echo $car_plate;?></td>
                                                <td>
                                                    <center>
                                                        <a href="update.php?id=<?php echo $id_client;?>" class="btn btn-success">Update</a>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
            </div>
        </div>
        <?php include('../layout/admin/footer.php');?>
    </div>
<?php include('../layout/admin/footer_links.php');?>
</body>
</html>