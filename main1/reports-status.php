<?php include_once('layout/head.php');

  $stat = $_GET['s'];
?>

<section class="content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">

                        <h2>
                            REPORT
                        </h2>
                    </div>
                    <div class="body">
                           <div align="center">
   <form method="GET">
  <input type="date" name="dtFrom" value="<?php if (isset($_GET['dtFrom'])) {
                                    echo $_GET['dtFrom'];
                                } ?>">
                                <input type="date" name="dtTo" value="<?php if (isset($_GET['dtTo'])) {
                                    echo $_GET['dtTo'];
                                } ?>">
                                <input type="submit" value="Search"> 
                                <input type="hidden" value="<?=$_GET['s'];?>" name="s"> 
                        <input type="submit" value="Print" onclick="printDiv('printableArea')">

                            </form>
                        </div>

                        <div class="table-responsive" id="printableArea">
                            <table class="table table-bordered table-striped table-hover  dataTable example">
                                <thead>
                                <tr>
                                    <th>Tenant</th>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>TIME IN</th>
                                    <th>TIME OUT</th>
                                    <?php if ($stat == 'tardiness') { ?>
                                        <th>Tardiness</th>
                                    <?php } elseif ($stat == 'undertime') { ?>
                                        <th>Undertime</th>
                                    <?php } elseif ($stat == 'absent') { ?>
                                        <th>Absent</th>
                                    <?php } elseif ($stat == 'present') { ?>
                                        <th>Present</th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php


                                if (isset($_GET['dtFrom'])){
                                     $dtFrom = $_GET['dtFrom'];
                                        $dtTo = $_GET['dtTo'];
                                        $dtasd=" AND attendance_date BETWEEN  '$dtFrom' AND '$dtTo'";
                                }else{
                                 $dtNow = date('Y-m-d');
                                 $dtasd="  AND  attendance_date='$dtNow'";
                                }


                                if ($stat == 'tardiness') {
                                    $str = '    tardiness > 0 ';
                                } elseif ($stat == 'undertime') {
                                    $str = '  undertime > 0';
                                } elseif ($stat == 'absent') {
                                    $str = '  time_in_work IS NULL AND time_out_work IS NULL';
                                } elseif ($stat == 'present') {
                                    $str = '  time_in_work IS NOT NULL AND time_out_work IS NOT NULL';
                                }

                                $result = my_query("SELECT *,a.id,CONCAT(e.fname,' ',e.lname)employee ,CONCAT(t.fname,' ',t.lname)tenant  FROM tbl_attendance a INNER JOIN tbl_employee e ON e.id=a.emp_id 
INNER JOIN tbl_users t ON t.id=a.tenant_id  WHERE   $str $dtasd  ORDER BY a.id DESC");


                                for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                    <tr>
                                        <td><?= $row['tenant']; ?></td>
                                        <td><?= $row['employee']; ?></td>
                                        <td><?= format_date($row['attendance_date']); ?></td>
                                        <td><?= format_time($row['time_in_work']); ?></td>
                                        <td><?= format_time($row['time_out_work']); ?></td>
                                        <?php if ($stat == 'tardiness') { ?>
                                            <td><?= timex_format($row['tardiness']); ?></td>
                                        <?php } elseif ($stat == 'undertime') { ?>
                                            <td><?= timex_format($row['undertime']); ?></td>
                                        <?php } elseif ($stat == 'absent') { ?>
                                            <td>0</td>
                                        <?php } elseif ($stat == 'present') { ?>
                                            <td><?= timex_format($row['hours_work']); ?></td>
                                        <?php } ?>
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


