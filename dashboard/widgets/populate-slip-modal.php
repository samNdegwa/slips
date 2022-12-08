<?php
include '../core/init.php';
date_default_timezone_set('Africa/Nairobi');
    $now = new DateTime();
    $hrs = $now->format('H');
    $mt = $now->format('i');
    $date = $now->format('Y-m-d  H:i');
    $payMonth = $now->format('m');
    $payYear = $now->format('Y');
    $json = $_POST['data'];
    $data = json_decode($json);

    $empid = $data[0];
    $name = $data[1];

    if($payMonth == '01'){$mon='January';} if($payMonth == '02'){$mon='February';} if($payMonth == '03'){$mon='March';} if($payMonth == '04'){$mon='April';} if($payMonth == '05'){$mon='May';} if($payMonth == '06'){$mon='June';} if($payMonth == '07'){$mon='July';} if($payMonth == '08'){$mon='August';} if($payMonth == '09'){$mon='September';} if($payMonth == '10'){$mon='October';} if($payMonth == '11'){$mon='November';} if($payMonth == '12'){$mon='December';}

    echo '<h6>Salary for '.$mon.', '.$payYear.'</h6>';

    //..............................Get calculated deductions
    include '../functions/deduction-calculator.php';


?>
<div class="row">
<div class="col-md-12">
<hr>
</div>
</div>
<div class="row">
<div class="col-md-6">
<table class="table table-bordered">
    <?php
    $sql="SELECT * FROM  tb_emp_earnings INNER JOIN earning_type ON tb_emp_earnings.earning_type=earning_type.id WHERE emp_id='$empid'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    ?>
    <thead>
    <th>Earnings</th>
    <th>Amount</th>
    </thead>
    <tbody>
     <?php 
      $etotals=0;
      while($row=mysqli_fetch_array($result))
      { 
        $type=$row['earning_name'];
        $money=$row['amount'];
     
        ?>
         <tr>
           <td><?php echo $type;?></td>
           <td><?php echo number_format($money,2);?></td>
         </tr>
        <?php
        $etotals=$etotals+$money;
      }
      ?>
    </tbody>
      
    </table>
  
</div>
<div class="col-md-6">
  <table class="table table-bordered" id="">
    <?php
    $sql="SELECT * FROM  tb_emp_deductions INNER JOIN deduction_type ON tb_emp_deductions.deduct_type_id=deduction_type.id WHERE emp_id='$empid'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    ?>
    <thead>
    <th>Deductions</th>
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
      $dtotals=0;
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
        $dtotals=$dtotals+$money;
      }

      $all_deductions=$dtotals+200+$nhif+$paye_reliefed+$pension_scheme+300;
      ?>
     
    </tbody>
      
    </table>
</div>
  
</div>
<div class="row">
<div class="col-md-6">
<h6 style="text-align:right"><b>Total Earnings: <?php echo number_format($etotals,2); ?></b></h6>
</div>
<div class="col-md-6">
<h6 style="text-align:right"><b>Total Deductions: <?php echo number_format($all_deductions,2); ?></b></h6>
</div>
</div>

<div class="row">
<div class="col-md-12">
<hr>
<h6>Net Payable (Total earnings - Total Deductions): <b>Kshs <?php echo number_format($etotals-$all_deductions,2);?></b></h6>
<?php
 //.......................................rough work
 //echo "Pension:".$paye_reliefed;

?>
</div>
</div>
<div class="row">
<div class="col-md-12">
<hr>
</div>
</div>
<div class="row">
<div class="col-md-12">
<h6><b>NOTE: </b> Clicking this "Generate" button will generate payslip and send it to <?php echo $name;?> email</h6>
  <button class="btn btn-outline-info btn-sm" id="generate-pay-slip" onclick="generate_pay_slip(<?php echo $empid;?>)"><i class="fa fa-file-text-o" aria-hidden="true"></i> Generate</button>
</div>
</div>