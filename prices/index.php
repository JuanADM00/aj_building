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
                <h2>Prices List</h2>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Set prices</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <script>
                            $(document).ready(function() {
                                $('#table_id').DataTable( {
                                    "pageLength": 5,
                                    "language": {
                                        "emptyTable": "No info",
                                        "info": "Showing _START_ to _END_ of _TOTAL_ Prices",
                                        "infoEmpty": "Showing 0 to 0 of 0 Prices",
                                        "infoFiltered": "(_MAX_ Total Prices Filtering)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Show _MENU_ Prices",
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
                            <div class="card-body">
                                <table id="table_id" class="table table-bordered table-sn table-striped">
                                    <thead>
                                        <th><center>Number</center></th>
                                        <th><center>Amount</center></th>
                                        <th><center>Detail</center></th>
                                        <th><center>Price</center></th>
                                        <th><center>Currency</center></th>
                                        <th><center>Actions</center></th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 0;
                                        $query_prices = $pdo->prepare("SELECT * FROM tb_prices");
                                        $query_prices->execute();
                                        $prices = $query_prices->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($prices as $price) {
                                            $id_price = $price['ID_PRICE'];
                                            $amount = $price['AMOUNT'];
                                            $detail = $price['DETAIL'];
                                            $p_value = $price['P_VALUE'];
                                            $currency = $price['CURRENCY'];
                                            $counter = $counter + 1;
                                            ?>
                                            <tr>
                                                <td><center><?php echo $counter;?></center></td>
                                                <td><center><?php echo $amount;?></center></td>
                                                <td><center><?php echo $detail;?></center></td>
                                                <td><center><?php echo $p_value;?></center></td>
                                                <td><center><?php echo $currency;?></center></td>
                                                <td>
                                                    <center>
                                                        <a href="update.php?id=<?php echo $id_price;?>" class="btn btn-success">Update</a>
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