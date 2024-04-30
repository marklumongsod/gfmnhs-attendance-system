<?php 

for ($i=0; $i <5 ; $i++) {  
		if ($_FILES["file"]["name"][$i]==""){
		$pic[$i]=$_POST['file'][$i];
	}else{
		$temp[$i] = $_FILES["file"]["tmp_name"][$i]; 
		echo$file[$i] = $_FILES["file"]["name"][$i]; 
		move_uploaded_file($temp[$i],"../../files/Activity/".$file[$i]);
	}  
}


?>