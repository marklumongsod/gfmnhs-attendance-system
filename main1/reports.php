<?php include_once('layout/head.php'); ?>

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
                                <select name="emp_id" class="select" style="width: 50px">
                                    <option></option>
                                    <?php
                                    $res = my_query("SELECT * FROM tbl_employee ");
                                    for ($x = 1; $r = $res->fetch(); $x++) { ?>
                                        <option value="<?= $r['id']; ?>"
                                            <?php if (isset($_GET['emp_id'])) {
                                                if ($_GET['emp_id'] == $r['id']) {
                                                    echo "selected";
                                                }
                                            } ?>
                                        ><?= $r['fname'] . ' ' . $r['lname']; ?></option>
                                    <?php } ?>
                                </select>
                                <br/><br/>
                                From:
                                <input type="date" name="dtFrom" value="<?php if (isset($_GET['dtFrom'])) {
                                    echo $_GET['dtFrom'];
                                } ?>">
                                 To:
                                <input type="date" name="dtTo" value="<?php if (isset($_GET['dtTo'])) {
                                    echo $_GET['dtTo'];
                                } ?>">
                                <input type="submit" value="Search">
                                <input type="submit" value="Print" onclick="printDiv('printableArea')">
                            </form>

                        </div>

                        <?php if (isset($_GET['dtFrom'])) { ?>
                            <div class="table-responsive" id="printableArea">
                                <h3>REPORT</h3>
                                <label>
                                    <?php
                                    echo 'FOR: ' . format_date($_GET['dtFrom']) . ' - ' . format_date($_GET['dtTo']);
                                    ?>
                                </label>
                                <table class="table table-bordered table-striped table-hover  dataTable example">
                                    <thead>
                                    <tr>
                                        <th>Tenant</th>
                                        <th>Employee</th>
                                        <th>Date</th>
                                        <th>TIME IN</th>
                                        <th>TIME OUT</th>
                                        <th>Tardiness</th>
                                        <th>Undertime</th>
                                        <th>Hours</th>
                                        <th>Rate</th>  
                                        <th>Cash Advance</th>
                                        
                                        <!--                <th>Status</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $c=0;
                                    $tt = 0;
                                    $tard = 0;
                                    $under = 0;
                                    $ca=0;
                                    if (($_GET['emp_id'] <> '')) {
                                        $emp_id = $_GET['emp_id'];
                                        $dtFrom = $_GET['dtFrom'];
                                        $dtTo = $_GET['dtTo'];
                                        $result = my_query("SELECT *,a.id,CONCAT(e.fname,' ',e.lname)employee ,CONCAT(t.fname,' ',t.lname)tenant  FROM tbl_attendance a INNER JOIN tbl_employee e ON e.id=a.emp_id 
INNER JOIN tbl_users t ON t.id=a.tenant_id 
 WHERE e.id='$emp_id' AND a.attendance_date BETWEEN  '$dtFrom' AND '$dtTo' $strA  ORDER BY a.id DESC");
                                    } else {
                                        $result = my_query("SELECT *,a.id,CONCAT(e.fname,' ',e.lname)employee ,CONCAT(t.fname,' ',t.lname)tenant  FROM tbl_attendance a INNER JOIN tbl_employee e ON e.id=a.emp_id 
INNER JOIN tbl_users t ON t.id=a.tenant_id  $strA  ORDER BY a.id DESC");
                                    }

                                    for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                        <tr>
                                            <td><?= $row['tenant']; ?></td>
                                            <td><?= $row['employee']; ?></td>
                                            <td><?= format_date($row['attendance_date']); ?></td>
                                            <td><?= format_time($row['time_in_work']); ?></td>
                                            <td><?= format_time($row['time_out_work']); ?></td>
                                            <td><?= timex_format($row['tardiness']); ?></td>
                                            <td><?= timex_format($row['undertime']); ?></td>
                                            <td><?= timex_format($row['hours_work']); ?></td>
                                            <td><?= $rate=$row['rate']; ?></td>  
                                             
<!--                                            <td>--><?//= number_format($row['rate'] * $row['hours_work'], 2); ?><!--</td>-->
                                            <!--                    <td>--><? //= $row['stat'];
                                            ?><!--</td>-->
                                        </tr>
                                        <?php
                                        $under += $row['undertime'];
                                        $tard += $row['tardiness'];
                                        $tt += $row['hours_work'];
                                        

                                        

                                    } ?>
                                    <tr>
                                         <?php $res= my_query("SELECT SUM(cash_advance)cash_advance FROM tbl_cash_advance WHERE advance_date BETWEEN '$dtFrom' AND '$dtTo' AND emp_id ='$emp_id' ");
                                            if($r=$res->fetch()) {
                                                  $ca=$r['cash_advance'];
                                            }?>
                                        
                                        <td>Total</td>
                                        <td colspan="4"></td>
                                        <td></td>
                                        <td><?= timex_format($under); ?></td>
                                        <td><?= timex_format($tt); ?></td>
                                        <td><?=((timex_format($tt))*$rate)-$ca; ?></td> 
                                        <td>
        <?=$ca;?>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>

                        <?php } ?>

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


