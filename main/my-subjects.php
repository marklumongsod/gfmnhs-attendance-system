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
                                echo 'My Child\'s Subject';
                            } else {
                                echo 'My Subject';
                            }
                            ?>
                        </h4>

                     
                        <?php
                        $result = my_query("SELECT DISTINCT classyr FROM tbl_class");

                        $classYears = [];
                        if ($result) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $classYears[] = $row['classyr'];
                            }
                        } else {
                            echo "0 results";
                        }

                        $selectedClassyr = isset($_POST['classyr']) ? $_POST['classyr'] : '';

                        if ($_SESSION['role'] == 'Parent') {
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
                        }
                        ?>

                    </div>
                    <div class="body">
                        <form id="classyrForm" action="" method="post">
                            <label for="classyr">Select Class Year:</label>
                            <select name="classyr" id="classyr">
                                <option value="">Select</option>
                                <?php foreach ($classYears as $classyr) : ?>
                                    <option value="<?php echo htmlspecialchars($classyr); ?>" <?php if ($classyr == $selectedClassyr) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($classyr); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ($_SESSION['role'] == 'Parent' && !empty($children)) : ?>
                                <label for="child_id">Select Child:</label>
                                <select name="child_id" id="child_id">
                                    <option value="">Select</option>
                                    <?php foreach ($children as $child) : ?>
                                        <option value="<?php echo htmlspecialchars($child['id']); ?>" <?php if ($child['id'] == $selectedChildId) echo 'selected'; ?>>
                                            <?php echo htmlspecialchars($child['fullname']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                            <button type="submit">Submit</button>
                        </form>
                        <br>

                        <?php
                        if ($selectedClassyr) {
                            if ($_SESSION['role'] == 'Parent' && $selectedChildId) {
                                $result = my_query("SELECT * FROM tbl_classstudent ct 
                                                    INNER JOIN tbl_class c ON c.id=ct.classId 
                                                    INNER JOIN tbl_settings_constants sc ON sc.value=c.section AND sc.sub_value=c.grade 
                                                    WHERE ct.studId='$selectedChildId' AND c.classyr='$selectedClassyr'");
                            } else if ($_SESSION['role'] == 'Student') {
                                $user_id = $_SESSION['user_id'];
                                $result = my_query("SELECT * FROM tbl_classstudent ct 
                                                    INNER JOIN tbl_class c ON c.id=ct.classId 
                                                    INNER JOIN tbl_settings_constants sc ON sc.value=c.section AND sc.sub_value=c.grade 
                                                    WHERE ct.studId='$user_id' AND c.classyr='$selectedClassyr'");
                            } else {
                                echo "<div style='border: 1px solid red; padding: 10px;'>Reminder: Please complete the filter by selecting a class year and choosing a child to view the data.</div>";
                            }

                            if ($result) {
                        ?>
                                <div class="table-responsive"><br>
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Subject Name</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Teacher</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($row['subject']); ?></td>
                                                    <td><?= htmlspecialchars(format_time($row['start'])); ?></td>
                                                    <td><?= htmlspecialchars(format_time($row['end'])); ?></td>
                                                    <td><?= htmlspecialchars($row['adviser']); ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                        <?php
                            } else {
                                echo "No subjects found for the selected class year.";
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>


    </div>
</section>




<?php include_once('layout/footer.php'); ?>