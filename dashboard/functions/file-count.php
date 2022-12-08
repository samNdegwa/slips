<?php
  $sql="SELECT * FROM tb_employee WHERE status='1'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    $activeEmployee=0;
    while($row=mysqli_fetch_array($result))
      {   
          $name=$row['full_name'];
          $activeEmployee++;
      }

    $sql="SELECT * FROM tb_employee WHERE status='0'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    $inactiveEmployee=0;
    while($row=mysqli_fetch_array($result))
      {   
          $name=$row['full_name'];
          $inactiveEmployee++;
      }

    $sql="SELECT * FROM earning_type";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    $earnings=0;
    while($row=mysqli_fetch_array($result))
      {   
          $id=$row['id'];
          $earnings++;
      } 

    $sql="SELECT * FROM deduction_type";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    $deductions=0;
    while($row=mysqli_fetch_array($result))
      {   
          $id=$row['id'];
          $deductions++;
      }       
?>