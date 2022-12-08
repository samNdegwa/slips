<?php 
include '../core/init.php';
$json = $_POST['data'];
    $data = json_decode($json);

    $empid = $data[0];
    $amount = $data[1];

    $sql = "UPDATE tb_emp_earnings SET amount='$amount' WHERE id='$empid'";

    if ($con->query($sql) === TRUE) {
        echo "Record updated successfully";
   } else {
      echo "Error updating record: " . $con->error;
    }

?>