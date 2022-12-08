<?php
//..............................Get earning for deductions calculation
    $nssf = 200;
    $sql="SELECT * FROM tb_emp_earnings WHERE emp_id='$empid' AND earning_type='1'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    $cnt=0;
    while($row=mysqli_fetch_array($result))
      {   
          $basic_earning_amount=$row['amount'];
      }

    $sql="SELECT * FROM  tb_emp_earnings WHERE emp_id='$empid'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    $gross_pay_amount=0;
      while($row=mysqli_fetch_array($result))
      {
        $gmoney=$row['amount'];
        $gross_pay_amount=$gross_pay_amount+$gmoney;
      } 

    //...............................................NHIF Calculation
    $nhif=150;
    if ($gross_pay_amount>5999 && $gross_pay_amount<8000) {
      $nhif=300;
    }
     if ($gross_pay_amount>7999 && $gross_pay_amount<12000) {
      $nhif=400;
    }
    if ($gross_pay_amount>11999 && $gross_pay_amount<15000) {
      $nhif=500;
    }
    if ($gross_pay_amount>14999 && $gross_pay_amount<20000) {
      $nhif=600;
    }
    if ($gross_pay_amount>19999 && $gross_pay_amount<25000) {
      $nhif=750;
    }
    if ($gross_pay_amount>24999 && $gross_pay_amount<30000) {
      $nhif=850;
    }
    if ($gross_pay_amount>29999 && $gross_pay_amount<35000) {
      $nhif=900;
    }
    if ($gross_pay_amount>34999 && $gross_pay_amount<40000) {
      $nhif=950;
    }
    if ($gross_pay_amount>39999 && $gross_pay_amount<45000) {
      $nhif=1000;
    }
    if ($gross_pay_amount>44999 && $gross_pay_amount<50000) {
      $nhif=1100;
    }
    if ($gross_pay_amount>49999 && $gross_pay_amount<60000) {
      $nhif=1200;
    }
    if ($gross_pay_amount>59999 && $gross_pay_amount<70000) {
      $nhif=1300;
    }
    if ($gross_pay_amount>69999 && $gross_pay_amount<80000) {
      $nhif=1400;
    }
    if ($gross_pay_amount>79999 && $gross_pay_amount<90000) {
      $nhif=1500;
    }
    if ($gross_pay_amount>89999 && $gross_pay_amount<100000) {
      $nhif=1600;
    }
    if ($gross_pay_amount> 100000) {
      $nhif=1700;
    }

    $nhif_relief = (15*$nhif)/100;

    //................................................Payeee calculation

     $pension_scheme= (5*$basic_earning_amount)/100;

    $allowable_deduction= $pension_scheme+$nssf;

    $taxable_pay = $gross_pay_amount-$allowable_deduction;

    $salary_group = "A";
    $paye = 0;
    if ($gross_pay_amount>24000 && $gross_pay_amount<32334) {
           $salary_group = "B";
         }     
    if ($gross_pay_amount>32333) {
         $salary_group = "C";
    }

    if ($salary_group === "B") {
      $paye = 2083.25;
    }

    if ($salary_group === "C")
    {
      $band=$taxable_pay-32333;
      $p1=(30*$band)/100;
      $paye = 2083.25+$p1;
    }

    $paye_reliefed=$paye-$nhif_relief;
?>