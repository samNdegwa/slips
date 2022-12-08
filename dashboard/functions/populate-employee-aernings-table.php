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

     $sql="SELECT * FROM tb_employee WHERE id='$empid'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    $cnt=0;
    while($row=mysqli_fetch_array($result))
      {   
          $name=$row['full_name'];
      }

    
?>
 <h6>Earnings for <b><?php echo $name;?></b><br><b>Amount</b> is editable. Commas(,) or any other characters are not allowed</h6>
<table class="table table-bordered" id="editing_earning">
    <?php
    $sql="SELECT earning_name,tb_emp_earnings.id,amount FROM  tb_emp_earnings INNER JOIN earning_type ON tb_emp_earnings.earning_type=earning_type.id WHERE emp_id='$empid' ORDER BY earning_type.id ASC";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    ?>
    <thead>
      <th style="display:none;">id</th>
      <th>#</th>
      <th>Earning Type</th>
      <th>Amount</th>
      <th>Action</th>
    </thead>
    <tbody>
     <?php 
      $no=1;
      $totals=0;
      while($row=mysqli_fetch_array($result))
      { 
        $en_id=$row['id'];
        $type=$row['earning_name'];
        $money=$row['amount'];
     
        ?>
         <tr>
           <td style="display:none;"><?php echo $en_id;?></td>
           <td><?php echo $no;?></td>
           <td><?php echo $type;?></td>
           <td contenteditable='true'><?php echo $money;?></td>
           <td><button class="btn btn-info btn-sm" id="button-edit-earning" onclick='edit_earning($(this))'>Save</button></td>
         </tr>
        <?php
        $totals=$totals+$money;
        $no++;
      }
      ?>
    </tbody>
      
    </table>
    <h6 style="text-align:right;"><b>Total Earnings: <?php echo number_format($totals,2);?></b></h6>