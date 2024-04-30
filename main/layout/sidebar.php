<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="../images/<?= $user_role . '/' . $_SESSION['pic']; ?>" width="48" height="48" alt="User"/>
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['name'] . '<br/>' . $user_role; ?></div>
                <!--   <div class="email">john.doe@example.com</div> -->
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a data-toggle="modal" data-target="#changePassword">
                                <i class="material-icons">autorenew</i>ChangePassword
                            </a>
                        </li>

                        <li>
                            <a data-toggle="modal" data-target="#changeProfile">
                                <i class="material-icons">person</i>Update Profile
                            </a>
                        </li>
                        <li role="seperator" class="divider"></li>
                        <li>
                            <a href="logout.php" onclick="return  confirm('Are you sure ?')">
                                <i class="material-icons">input</i>Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <div class="menu">
            <ul class="list">

                <li class="header">MAIN NAVIGATION
                </li>

                <?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Teacher' ) { ?>
    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'dashboard.php') !== false) {
                        echo "active";
                    } ?>">
                        <a  target="_BLANK" href="enroll/exe.php?enroll">
                            <img src="../images/icon/faceenroll.png" width="30px" height="30px">
                            <span>Face Enroll</span>
                        </a>
                    </li>
                        <li  class="<?php if (strpos($_SERVER['REQUEST_URI'], 'dashboard.php') !== false) {
                        echo "active";
                    } ?>">
                        <a target="_BLANK" href="inout/exe.php?attendance">
                            <img src="../images/icon/attendance.png" width="30px" height="30px">
                            <span>Attendance</span>
                        </a>
                    </li>
                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'attendances.php') !== false || strpos($_SERVER['REQUEST_URI'], 'add-edit.php') !== false || strpos($_SERVER['REQUEST_URI'], 'inout.php') !== false ) {
                        echo "active";
                    } ?>">
                        <a href="attendances.php">
                            <img src="../images/icon/Lesson Icon.png" width="30px" height="30px">
                            <span>Attendance List</span>
                        </a>
                    </li>
                    <?php }?>


                <?php if ($_SESSION['role'] == 'Admin') { ?>
                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'dashboard.php') !== false) {
                        echo "active";
                    } ?>">
                        <a href="dashboards.php">
                            <img src="../images/icon/Dashboard Icon.png" width="30px" height="30px">
                            <span>Dashboards</span>
                        </a>
                    </li>
                  

                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'students.php') !== false) {
                        echo "active";
                    } ?>">
                        <a href="students.php">
                            <img src="../images/icon/Student Icon.png" width="30px" height="30px">
                            <span>Students</span>
                        </a>
                    </li>
                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'users.php') !== false) {
                        echo "active";
                    } ?>">
                        <a href="users.php">
                            <img src="../images/icon/User Icon.png" width="30px" height="30px">
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'class.php') !== false || strpos($_SERVER['REQUEST_URI'], 'studclassattendance.php') !== false  ) {
                        echo "active"; 
                    } ?>">
                        <a href="class.php">
                            <img src="../images/icon/Class Icon.png" width="30px" height="30px">
                            <span>Class</span>
                        </a>
                    </li>

                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'settings.php') !== false || strpos($_SERVER['REQUEST_URI'], 'constants.php') !== false || strpos($_SERVER['REQUEST_URI'], 'faqs.php') !== false) {
                        echo "active";
                    } ?>">
                        <a class="menu-toggle">
                            <img src="../images/icon/Settings Icon.png" width="30px" height="30px">
                            <span>Settings</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="constants.php">
                                    <span>Constants</span>
                                </a>
                            </li>
                            <li>
                                <a href="import.php">
                                    <span>Import Record</span>
                                </a>
                            </li>
                            <!--                            <li>-->
                            <!--                                <a href="faqs.php">-->
                            <!--                                    <span>Faqs</span>-->
                            <!--                                </a>-->
                            <!--                            </li>-->
                        </ul>
                    </li>

                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'ualt.php?type') !== false) {
                        echo "active";
                    } ?>">
                        <a class="menu-toggle">
                            <img src="../images/icon/Record Logs Icon.png" width="30px" height="30px">
                            <span>User Logs</span>
                        </a>
                        <ul class="ml-menu">
                            <?php
                            $result = db_select_where('tbl_settings_constants', ["category" => 'User Type']);
                            for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                <li>
                                    <a href="ualt.php?type=<?= $row['value']; ?>">
                                        <span><?= $row['value']; ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Teacher' || $_SESSION['role'] == 'Student') { ?>
                    <!-- <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'announcements.php') !== false) {
                        echo "active";
                    } ?>">
                        <a href="announcements.php">
                            <img src="../images/icon/Announcement Icon.png" width="30px" height="30px">
                            <span>Announcements</span>
                        </a>
                    </li> -->
                <?php } ?>


                <?php if ($_SESSION['role'] == 'Teacher') { ?>
                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'class.php') !== false || strpos($_SERVER['REQUEST_URI'], 'studclassattendance.php') !== false  ) {
                        echo "active";
                    } ?>">
                        <a href="class.php">
                            <img src="../images/icon/Class Icon.png" width="30px" height="30px">
                            <span>Class</span>
                        </a>
                    </li>


                <?php } ?>


                <?php if ($_SESSION['role'] == 'Student') { ?>

                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'my-attendances.php') !== false  ) {
                        echo "active";
                    } ?>">
                        <a href="my-attendances.php">
                            <img src="../images/icon/Lesson Icon.png" width="30px" height="30px">
                            <span>My Attendances</span>
                        </a>
                    </li>


                <?php } ?>


                <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'dashboards.php') !== false || strpos($_SERVER['REQUEST_URI'], 'import.php') !== false )   {
                    echo "active";
                } ?>">
                    <a href="logout.php">
                        <img src="../images/icon/Sign Out Icon.png" width="30px" height="30px">
                        <span>Sign Out</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                <a href="javascript:void(0);"> <?= $system_title; ?></a> &copy; <?= date('Y'); ?>
            </div>
            <div class="version">
               
                
                Created by, Name of researcher <br/>
Javier, Josh Carl Anthony <br/>
Lanuza, Richard <br/>
Magdaraog, Mary Rose <br/> 
Salera, Rachel <br/>

            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->

</section>


<div class="modal fade" id="changePassword" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-smd" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel"> CHANGE PASSWORD
                    <small>Change your password</small>
                </h4>
            </div>
            <form action="models/user.php" method="POST">
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control" placeholder="Old Password" name="oldpassword" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control" placeholder="New Password" name="newpassword" required/>
                            </div>
                            <!-- pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$" -->
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control" placeholder="Re-type Password" name="retypepassword" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="func_param" value="changePassword" class="btn  btn-info waves-effect">
                        CHANGE
                    </button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if ($mainUser == $user_role) {
    $tblChangeProfile = $tbl;
} else {
    $tblChangeProfile = 'tbl_users';
}
$result = my_query("SELECT *  FROM $tblChangeProfile WHERE id='$user_id'");
for ($i = 1; $row = $result->fetch(); $i++) { ?>
    <div class="modal fade" id="changeProfile" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Update Profile <?= $_SESSION['pic']; ?></h4>
                </div>
                <form action="models/user.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <img src="../images/<?= $user_role . '/' . $_SESSION['pic']; ?>" width="100px" height="100px" alt="User"/>
                                    <input name="pic" type="file" class="form-control" accept="images*">
                                    <input name="pic1" type="hidden" value="<?= $row['pic']; ?>" required>
                                    <input name="role" type="hidden" value="<?= $user_role; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="lname" type="text" class="form-control" value="<?= $row['lname']; ?>" required>
                                    <label class="form-label">Lastname</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="fname" type="text" class="form-control" value="<?= $row['fname']; ?>" required>
                                    <label class="form-label">Firstname</label>
                                </div>
                            </div>
                        </div>
                        <?php if ($mainUser == $user_role) { ?>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="mname" type="text" class="form-control" value="<?= $row['mname']; ?>" required>
                                        <label class="form-label">
                                            <Middlename>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="email" type="email" class="form-control" value="<?= $row['email']; ?>" required>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="contact" type="number" class="form-control" value="<?= $row['contact']; ?>" required>
                                        <label class="form-label">Contact</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="address" type="text" class="form-control" value="<?= $row['address']; ?>" required>
                                        <label class="form-label">Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="gender" class="form-control" required>
                                            <option><?= $row['gender']; ?></option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                        <label class="form-label">Gender</label>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" value="updateProfile" name="func_param" class="btn btn-warning waves-effect">
                            UPDATE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php } ?>


