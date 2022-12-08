<?php
include '../core/init.php';
date_default_timezone_set('Africa/Nairobi');
    $now = new DateTime();
    $hrs = $now->format('H');
    $mt = $now->format('i');
    $date = $now->format('Y-m-d  H:i');
    $json = $_POST['data'];
    $data = json_decode($json);

    $type = $data[0];
  
    $sql="SELECT * FROM earning_type WHERE earning_name='$type'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    while($row=mysqli_fetch_array($result))
      {   
          $dbtype=$row['earning_name'];
      }

      if($dbtype === $type)
      {
        echo "exist";
      } else {

     $sqlc = "INSERT INTO `earning_type` (`earning_name`) VALUES ('$type')";  
         if (!mysqli_query($con,$sqlc)){
           echo "error";
        } else {
           echo "success";
        }
    }
?>