<?php
include '../core/init.php';
date_default_timezone_set('Africa/Nairobi');
    $now = new DateTime();
    $hrs = $now->format('H');
    $mt = $now->format('i');
    $date = $now->format('Y-m-d  H:i');
    $json = $_POST['data'];
    $data = json_decode($json);

    $name = $data[0];
    $empid = $data[1];
    $email = $data[2];
    $phone = $data[3];
    $kra = $data[4];
    $job = $data[5];
    $depart = $data[6];
    $pfno = $data[7];
    $grade = $data[8];
    $bank = $data[9];

    $sql="SELECT * FROM tb_employee WHERE national_id='$empid'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    $cnt=0;
    while($row=mysqli_fetch_array($result))
      {   
          $dbid=$row['national_id'];
      }

      if($empid === $dbid)
      {
        echo "exist";
      } else {

     $sqlc = "INSERT INTO `tb_employee` (`full_name`,`national_id`,`email`,`phone_number`,`kra_pin`,`department`,`bank`,`job_title`,`pf_no`,`date_registered`,`pay_grade`) VALUES ('$name','$empid','$email','$phone','$kra','$depart','$bank','$job','$pfno','$date','$grade')";  
         if (!mysqli_query($con,$sqlc)){
           echo "error";
        } else {
           echo "success";
        }
    }
?>