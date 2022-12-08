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

    //...............................................NHIF Calculation
     include 'deduction-calculator.php';

    
?>
 <h6>Deductions for <b><?php echo $name;?></b></h6>
<table class="table table-bordered" id="">
    <?php
    $sql="SELECT * FROM  tb_emp_deductions INNER JOIN deduction_type ON tb_emp_deductions.deduct_type_id=deduction_type.id WHERE emp_id='$empid' ORDER BY deduction_type.id ASC";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    ?>
    <thead>
      <th>Deduction</th>
      <th>Amount</th>
    </thead>
    <tbody>
    <tr>
        <td>N.S.S.F</td>
        <td>200.00</td>
      </tr>
      <tr>
        <td>N.H.I.F</td>
        <td><?php echo number_format($nhif,2);?></td>
      </tr>
      <tr>
        <td>P.A.Y.E</td>
        <td><?php echo number_format($paye_reliefed,2);?></td>
      </tr>
      <tr>
        <td>Pension Scheme</td>
        <td><?php echo number_format($pension_scheme,2);?></td>
      </tr>
      <tr>
        <td>Urigiti Welfare</td>
        <td>300.00</td>
      </tr>
     <?php 
      $totals=0;
      while($row=mysqli_fetch_array($result))
      { 
        $type=$row['deduction_name'];
        $money=$row['amount'];
     
        ?>
         <tr>
           <td><?php echo $type;?></td>
           <td><?php echo number_format($money,2);?></td>
           
         </tr>
        <?php
        $totals=$totals+$money;
      }

       $all_deductions=$totals+200+$nhif+$paye_reliefed+$pension_scheme+300;
      ?>
    </tbody>
    </table>
    <h6 style="text-align:right;"><b>Total Earnings: <?php echo number_format($all_deductions,2);?></b></h6>
  