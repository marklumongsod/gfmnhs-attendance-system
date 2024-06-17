<?php include_once('layout/head.php'); ?>

<section class="content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">

                        <h2>
                            USER LOGTRAIL (<?php echo $type = $_GET['type']; ?>)
                        </h2>
                    </div>
                    <div class="body">
                        <div align="center">
                            <form action="" method="GET">
                                <input type="hidden" name="type" value="<?= $_GET['type']; ?>">
                                <input type="date" name="dtFrom" value="<?php if (isset($_GET['dtFrom'])) {
                                    echo $_GET['dtFrom'];
                                } ?>">
                                <input type="date" name="dtTo" value="<?php if (isset($_GET['dtTo'])) {
                                    echo $_GET['dtTo'];
                                } ?>">
                                <input type="submit" value="Search">
                             
                            </form>

                        </div>
                        <div class="table-responsive" id="printableArea">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                    <th>Date/Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $type = $_GET['type'];
                                
                                  if(isset($_GET['dtFrom'])){
                                 $dtfrom = $_GET['dtFrom'];
                                 $dtto = $_GET['dtTo'];
                                $date=" AND ul.created_at BETWEEN '$dtfrom' AND '$dtto'";
                             }else{
                                 $date=''; 
                             }

                                $result = my_query("SELECT *,CONCAT(fname,' ',lname)fullname,ul.id as id FROM tbl_ualt ul INNER JOIN tbl_users  u ON ul.user_id=u.id WHERE   type='$type'  $date  ORDER BY ul.id DESC");


                                for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                    <tr>
                                        <td><?php echo $row['fullname']; ?></td>
                                        <td><?php echo $row['action']; ?></td>
                                        <td><?php echo $row['created_at']; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
<div id="printableArea"></div>

<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

<?php include_once('layout/footer.php'); ?>


