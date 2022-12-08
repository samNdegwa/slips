<?php
include '../core/init.php';
date_default_timezone_set('Africa/Nairobi');
    $now = new DateTime();
    $hrs = $now->format('H');
    $mt = $now->format('i');
    $date = $now->format('Y-m-d  H:i');
    $json = $_POST['data'];
    $data = json_decode($json);

    $empid = $data[0];
    $type = $data[1];
    $amount = $data[2];

    $sql="SELECT * FROM tb_emp_earnings WHERE earning_type='$type' AND emp_id='$empid'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    $cnt=0;
    while($row=mysqli_fetch_array($result))
      {   
          $dbtype=$row['earning_type'];
      }

      if($dbtype === $type)
      {
        echo "exist";
      } else {

     $sqlc = "INSERT INTO `tb_emp_earnings` (`emp_id`,`earning_type`,`amount`) VALUES ('$empid','$type','$amount')";  
         if (!mysqli_query($con,$sqlc)){
           echo "error";
        } else {
           echo "success";
        }
    }
?>