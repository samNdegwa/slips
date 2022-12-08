<?php
require 'connection/database.php';
session_start();
	$json = $_POST['data'];
	$data = json_decode($json);

	$username = $data[0];
    $password = $data[1];
    
    $psd=md5($password);
	$sql = "select * from users_admin where email = '$username' and password='$psd'";

	$result = $con->query($sql);

	$rows = $result->num_rows;

	if($rows !== 0){
		echo "success";
		$_SESSION['mypassword'] = $password;
		$_SESSION['myEmail']= $username;
	}
	else {
		$name = '';
		$sql1 = "select * from users_admin where email = '$username'";

	    $result1 = $con->query($sql1);

	     $rows1 = $result1->num_rows;

		  for($a = 0 ; $a < $rows1; $a++){
			$result1->data_seek($a); 
			$name = $result1->fetch_assoc()['email'];
			
		}
        
		if (empty($name)===true) {
			echo "empty";
		}
		else
		{
            echo "wrong";
		
	    }
	}

?>