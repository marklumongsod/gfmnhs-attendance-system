<?php
require_once "../config.php";  
$function = $_POST['func_param'];    

switch($function){   
	case "adminLogin" : 
	$username = $_POST['username'];
	$password = ($_POST['password']); 


	$result = $db->prepare("SELECT *,CONCAT(fname,' ',lname)fullname FROM tbl_users  WHERE  username='$username'");
	$result->execute();
	if($row = $result->fetch()) {  
		$_SESSION['user_id']=$row['id'];   
		$_SESSION['username']=$row['username']; 
		$_SESSION['password']=$row['password'];  
		$_SESSION['name']=$row['fullname']; $fullname=$row['fullname']; 
		$_SESSION['role']=$row['role'];  $role=$row['role'];
		$_SESSION['pic']=strtolower($row['role']).'/'.$row['pic'];

		if ($row['password']==$password) {  
			$message = "Date / Time : $dt \\n Successfully login as $role. \\n Welcome $fullname."; ualt("Login");
			if ($_SESSION['role']=="Admin"){   
				header('Location: '.'../main/dashboard.php');
				exit(); 
			}else{
				header('Location: '.'../main/dashboard.php'); 
				exit(); 
			} 

		} else {	
			echo "<script type='text/javascript'>window.location.href='../admin.php?r=not';</script>";
			exit();  
		}
	} else {
		$message = "Invalid user not existed."; 
			echo "<script type='text/javascript'>window.location.href='../student.php?r=invalid';</script>";
	}  
	break;
	
	case "userLogout" :  
	ualt("Logout");
	$message = "Date / Time : $dt \\n Successfully logout as  ."; 
	header('Location: '.'../index.php'); 
	break;

	case 'studentLogin':
	$studNo = $_POST['studNo'];
	$password = ($_POST['password']); 


	$result = $db->prepare("SELECT *,CONCAT(fname,' ',lname)fullname FROM tbl_students  WHERE  studNo='$studNo'");
	$result->execute();
	if($row = $result->fetch()) {  
		$_SESSION['user_id']=$row['id'];   
		$_SESSION['username']=$row['username']; 
		$_SESSION['password']=$row['password'];  
		$_SESSION['name']=$row['fullname']; $fullname=$row['fullname']; 
		$_SESSION['role']='Student';  $role=$_SESSION['role'];
		$_SESSION['pic']='student/'.$row['pic'];
		$_SESSION['g_section']=$row['g_section'];

		if ($row['status']=='Inactive') {  
			echo "<script type='text/javascript'>window.location.href='../index.php?r=inactive';</script>";
			exit();
		}

		if ($row['password']==$password) {  
			$message = "Date / Time : $dateTimeNow \\n Successfully login as $role. \\n Welcome $fullname."; ualt("Login");
			if ($_SESSION['role']=="Student"){
                //echo "<script type='text/javascript'>window.location.href='../main/dashboard.php';</script>";
				header('Location: '.'../main/dashboard.php');
                //$message="Successfully login";
                //echo "<script type='text/javascript'>alert('$message');window.location.href='../main/dashboard.php';</script>";

                exit();
			}
		} else {	 
			echo "<script type='text/javascript'>window.location.href='../index.php?r=not';</script>";
			exit();  
		}
	} else { 
			echo "<script type='text/javascript'>window.location.href='../index.php?r=invalid';</script>";
	}  
	break;	

	case 'studentSignup':
 
	  

	if ($_POST['password']<>$_POST['confirm']){
		 echo "<script type='text/javascript'>window.location.href='../sign-up.php?r=deleted';</script>";
	}else{
		$result = $db->prepare("SELECT *,CONCAT(fname,' ',lname)fullname FROM tbl_students  WHERE  studNo='$studNo' ");
		$result->execute();
		if($row = $result->fetch()) {  
		 echo "<script type='text/javascript'>window.location.href='../sign-up.php?r=invalid';</script>";
exit();
		}else{
		  	$data = array("section"=> $_POST['section'], "studNo"=>$_POST['studNo'],"password"=>$_POST['password'],"lname"=>$_POST['lname'],"fname"=>$_POST['fname'],"mname"=>$_POST['mname'],"username"=>$_POST['username']
			,"email"=>$_POST['email'] );
			$query = db_insert('tbl_students', $data);
			 echo "<script type='text/javascript'>alert('Successfully Added');window.location.href='../sign-up.php?r=addeds';</script>";
			 
		}
	}


	break;

}




?>