<?php 
$con = mysqli_connect('localhost','ekasuser','safcom2020');
if(!$con)
{
	echo 'Not connected to server. ';
}
if (!mysqli_select_db($con,'ekas_sms'))
{
	echo 'Database Failure';
}

?>