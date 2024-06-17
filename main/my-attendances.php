<?php include_once('layout/head.php'); ?>
<?php $title = 'Login'; ?>
<section class="content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="box-title"> <?php if (isset($_GET['r'])) : ?>
                                <?php
                                                    $r = $_GET['r'];
                                                    if ($r == 'added') {
                                                        $classs = 'success';
                                                    } else if ($r == 'updated') {
                                                        $classs = 'warning';
                                                    } else if ($r == 'deleted') {
                                                        $classs = 'danger';
                                                    } else {
                                                        $classs = 'hide';
                                                    }
                                ?>
                                <div class="alert alert-dismissible alert-<?php echo $classs ?> <?php echo $classs; ?>">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong> <?= (isset($_GET['msg']) ? $_GET['msg'] : 'Successfully ' . $r); ?>
                                        !</strong>
                                </div>
                            <?php endif; ?>
                        </div>

                        <h4>
                            <?php
                            if ($_SESSION['role'] == 'Parent') {
                                echo 'My Child\'s Attendance Record';
                            } else {
                                echo 'My Attendance Record';
                            }
                            ?>
                        </h4>


                    </div>
                    <div class="body">
                        <?php if ($_SESSION['role'] == 'Parent') : ?>
                            <?php
                            $parent_user_id = $_SESSION['user_id']; 
                            
                            $user_query = "SELECT username FROM tbl_users WHERE id = '$parent_user_id'";
                            $user_result = my_query($user_query);
                            
                            if ($user_result && $user_row = $user_result->fetch()) {
                                $parent_username = $user_row['username'];
                                
                                $children_query = "SELECT id, CONCAT(fname, ' ', lname) AS fullname FROM tbl_students WHERE parent_email = '$parent_username'";
                                $children_result = my_query($children_query);
                                
                                $children = [];
                                if ($children_result) {
                                    while ($child_row = $children_result->fetch(PDO::FETCH_ASSOC)) {
                                        $children[] = $child_row;
                                    }
                                } else {
                                    echo "No children found for the logged-in parent.";
                                }
                                
                                $selectedChildId = isset($_POST['child_id']) ? $_POST['child_id'] : '';
                            }
                            ?>
                            
                            <form id="childForm" action="" method="post">
                                <label for="child_id">Select Child:</label>
                                <select name="child_id" id="child_id">
                                    <option value="">Select</option>
                                    <?php foreach ($children as $child) : ?>
                                        <option value="<?php echo htmlspecialchars($child['id']); ?>" <?php if ($child['id'] == $selectedChildId) echo 'selected'; ?>>
                                            <?php echo htmlspecialchars($child['fullname']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">Submit</button>
                            </form>
                            <br>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($_SESSION['role'] == 'Parent' && $selectedChildId) {
                                        $attendance_query = "SELECT i.id, CONCAT(r.fname, ' ', r.lname) AS fullname, xdate, xtime, subject, i.status  
                                                             FROM tbl_inout i 
                                                             INNER JOIN tbl_class c ON c.id = i.classId 
                                                             INNER JOIN tbl_students r ON r.id = i.stud_id 
                                                             WHERE i.stud_id = '$selectedChildId'  
                                                             ORDER BY i.id DESC";

                                        $attendance_result = my_query($attendance_query);
                                        if ($attendance_result) {
                                            while ($row = $attendance_result->fetch()) {
                                                $id = $row['id'];
                                    ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($row['fullname']); ?></td>
                                                    <td><?= htmlspecialchars($row['subject']); ?></td>
                                                    <td><?= htmlspecialchars(format_date($row['xdate'])); ?></td>
                                                    <td><?= htmlspecialchars(format_time($row['xtime'])); ?></td>
                                                    <td><?= htmlspecialchars($row['status']); ?></td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            echo "Error executing attendance query.";
                                        }
                                    } else if ($_SESSION['role'] == 'Student') {

                                        $user_id = $_SESSION['user_id'];
                                        $result = my_query("SELECT i.id, CONCAT(fname, ' ', lname) AS fullname, xdate, xtime, subject, i.status 
                                                            FROM tbl_inout i 
                                                            INNER JOIN tbl_class c ON c.id = i.classId 
                                                            INNER JOIN tbl_students r ON r.id = i.stud_id 
                                                            WHERE stud_id = '$user_id'  
                                                            ORDER BY id DESC");
                                        while ($row = $result->fetch()) {
                                            $id = $row['id'];
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['fullname']); ?></td>
                                                <td><?= htmlspecialchars($row['subject']); ?></td>
                                                <td><?= htmlspecialchars(format_date($row['xdate'])); ?></td>
                                                <td><?= htmlspecialchars(format_time($row['xtime'])); ?></td>
                                                <td><?= htmlspecialchars($row['status']); ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<div style='border: 1px solid red; padding: 10px;'>Reminder: Please complete the filter by selecting your child to view the data.</div><br>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>



<?php include_once('layout/footer.php'); ?>