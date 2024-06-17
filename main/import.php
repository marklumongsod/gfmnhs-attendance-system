<?php include_once('layout/head.php'); ?>
<?php $title = 'Constant'; ?>
    <section class="content">
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="box-title">  <?php if (isset($_GET['r'])): ?>
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
                       
                            <a  class="btn right btn-success btn-sm" href="http://localhost/gfmnhs/main/format/importmoo.csv" download>Download Format</a>
                        
                            <h2>
                                <?=strtoupper('Imports');?>

                                                               

                            </h2>
                            <br/>
                          
                            <form class="" action="" method="post" enctype="multipart/form-data">
                           <input type="file" name="excel" accept=".csv" required>  
                           <button class="btn btn-success btn-sm" type="submit" name="import">Import</button>
 
 
   
</form> 
                        </div>
                        <div class="body"> 

 
<div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
    <tr>
        <td>#</td>
        <th>Picture</th>
        <th>Name</th>
        <th>LRN</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Status</th>
    </tr>
    <?php
    $i = 1;
    $rows = my_query("SELECT *,CONCAT(fname,' ',lname)name  FROM tbl_students ORDER BY id DESC");
    foreach ($rows as $row) :
        ?>
        <tr>
            <td> <?= $i; ?></td>
            <td><img src="../images/student/<?= $row['pic']; ?>" width="50px"></td>

            <td> <?= $row['name']; ?></td>
            <td> <?= $row['studNo']; ?></td>
            <td> <?= $row['email']; ?></td>
            <td> <?= $row['contact']; ?></td>
            <!--<td> <?= $row['username']; ?></td>-->
            <td> <?= $row['status']; ?></td>
        </tr>
    <?php $i+=1;  endforeach; ?>
</table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

    
<?php
function endecrypt($string, $action = 'e')
{
    // you may change these values to your own
    $_SESSION['key'] = 'imBlessed@o1';
    $secret_key = $_SESSION['key'];
    $secret_iv = $_SESSION['key'];

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

if (isset($_POST["import"])) {
    $fileName = $_FILES["excel"]["name"];
    $fileExtension = explode('.', $fileName);
    $fileExtension = strtolower(end($fileExtension));

    // Check if the file extension is CSV
    if ($fileExtension !== 'csv') {
        echo "<script>alert('Please upload a CSV file.'); window.history.back();</script>";
        exit; // Stop further execution
    }

    $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

    $targetDirectory = "uploads/" . $newFileName;
    if (!move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory)) {
        echo "<script>alert('Failed to upload file.'); window.history.back();</script>";
        exit;
    }

    require 'excelReader/excel_reader2.php';
    require 'excelReader/SpreadsheetReader.php';

    $reader = new SpreadsheetReader($targetDirectory);

    $isFirstRow = true;
    $isEmpty = true; // Flag to track if the file is empty
    $duplicateEntries = []; // Initialize the array to track duplicate entries

    foreach ($reader as $key => $row) {
        // Skip the first row (header)
        if ($isFirstRow) {
            $isFirstRow = false;
            continue;
        }

        // If we find at least one row, set the flag to false
        $isEmpty = false;

        // Extract student data
        $studNo = $row[0];
        $bday = $row[4];

        // Calculate age
        $bdayDateTime = new DateTime($bday);
        $currentDateTime = new DateTime();
        $age = $currentDateTime->diff($bdayDateTime)->y;

        // Check if the student already exists
        $existing_student_query = $db->prepare("SELECT * FROM tbl_students WHERE studNo = :studNo");
        $existing_student_query->execute(array(':studNo' => $studNo));

        if ($existing_student_query->rowCount() == 0) {
            // Student doesn't exist, so insert into the database
            $insert_query = $db->prepare("INSERT INTO tbl_students
                (`studNo`, `fname`, `lname`, `mname`, `bday`, `age`, `gender`, `address`, `email`, `contact`, `username`, `section`, `gr_yr`, `password`, `status`)
                VALUES
                (:studNo, :fname, :lname, :mname, :bday, :age, :gender, :address, :email, :contact, :username, :section, :gr_yr, :password, :status)");

            $result = $insert_query->execute(array(
                ':studNo' => $studNo,
                ':fname' => $row[1],
                ':lname' => $row[2],
                ':mname' => $row[3],
                ':bday' => $bday,
                ':age' => $age,
                ':gender' => $row[5],
                ':address' => $row[6],
                ':email' => $row[7],
                ':contact' => $row[8],
                ':username' => $row[9],
                ':section' => $row[10],
                ':gr_yr' => $row[11],
                ':password' => 'd3f@auLt2023', // Example default password
                ':status' => 'Active'
            ));

            if (!$result) {
                // If the insert fails, show error
                $errorInfo = $insert_query->errorInfo();
                echo "<script>alert('Error inserting data: " . htmlspecialchars($errorInfo[2]) . "'); window.history.back();</script>";
                exit; // Stop further execution
            }
        } else {
            // Student already exists, handle duplicate entry
            $duplicateEntries[] = $studNo;
        }
    }

    if ($isEmpty) {
        echo "<script>alert('The CSV file is empty.'); window.history.back();</script>";
        exit; // Stop further execution
    }

    if (!empty($duplicateEntries)) {
        $message = "Duplicate entries found for Student IDs: " . implode(', ', $duplicateEntries);
        echo "<script>alert('$message'); window.history.back();</script>";
        exit; // Stop further execution
    }

    echo "<script>alert('Import process completed'); document.location.href = '/gfmnhs/main/dashboards.php'; </script>";
}



?>

<?php include_once('layout/footer.php'); ?>