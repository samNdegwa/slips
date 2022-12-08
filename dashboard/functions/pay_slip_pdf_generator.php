<?php
include '../core/init.php';
date_default_timezone_set('Africa/Nairobi');
    $now = new DateTime();
    $hrs = $now->format('H');
    $mt = $now->format('i');
    $date = $now->format('Y-m-d');
    $payMonth = $now->format('m');
    $payYear = $now->format('Y');
    $json = $_POST['data'];
    $data = json_decode($json);

    if($payMonth == '01'){$mon='January';} if($payMonth == '02'){$mon='February';} if($payMonth == '03'){$mon='March';} if($payMonth == '04'){$mon='April';} if($payMonth == '05'){$mon='May';} if($payMonth == '06'){$mon='June';} if($payMonth == '07'){$mon='July';} if($payMonth == '08'){$mon='August';} if($payMonth == '09'){$mon='September';} if($payMonth == '10'){$mon='October';} if($payMonth == '11'){$mon='November';} if($payMonth == '12'){$mon='December';}

    $empid = $data[0];

     //...........................................get calculation
     include 'deduction-calculator.php';
    //..............................................get employee data
    $sql="SELECT * FROM tb_employee WHERE id='$empid'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    $cnt=0;
    while($row=mysqli_fetch_array($result))
      {   
          $national_id=$row['national_id'];
          $name=$row['full_name'];
          $phone=$row['phone_number'];
          $email=$row['email'];
          $job=$row['job_title'];
          $department=$row['department'];
          $kra_pin=$row['kra_pin'];
          $pay_grade=$row['pay_grade'];
          $bank=$row['bank'];
          $pfno=$row['pf_no'];
      }
       $file_name = md5($payYear.$payMonth.$empid).'.pdf';
      //Get earning
        $sqle="SELECT * FROM tb_emp_earnings INNER JOIN earning_type ON tb_emp_earnings.earning_type=earning_type.id WHERE emp_id='$empid'";
        $resulte=mysqli_query($con,$sqle) or die(mysql_error());
        $earn_array_type=[];
        $earn_array_amount=[];
        $eno=0;
        $total_e=0;
         while($row=mysqli_fetch_array($resulte))
         { 
        $type=$row['earning_name'];
        $money=$row['amount'];

        $earn_array_type[$eno] = $type;
        $earn_array_amount[$eno] = $money;
        $eno++;
        $total_e=$total_e+$money;
        }  

         //Get deductions
        $sqld="SELECT * FROM tb_emp_deductions INNER JOIN deduction_type ON tb_emp_deductions.deduct_type_id=deduction_type.id WHERE emp_id='$empid'";
        $resultd=mysqli_query($con,$sqld) or die(mysql_error());
        $deduct_array_type=[];
        $deduct_array_amount=[];
        //..........................................set aoutogenerated deduction into array
        $deduct_array_type[0] = "N.S.S.F";
        $deduct_array_amount[0] = "200";
        
        $deduct_array_type[1] = "N.H.I.F";
        $deduct_array_amount[1] = $nhif;

        $deduct_array_type[2] = "P.A.Y.E";
        $deduct_array_amount[2] = $paye_reliefed;

        $deduct_array_type[3] = "Pension Scheme";
        $deduct_array_amount[3] = $pension_scheme;

        $deduct_array_type[4] = "Urigiti Welfare";
        $deduct_array_amount[4] = "300";

        $dno=5;
        $total_d=0;
         while($row=mysqli_fetch_array($resultd))
         { 
        $type=$row['deduction_name'];
        $money=$row['amount'];

        $deduct_array_type[$dno] = $type;
        $deduct_array_amount[$dno] = $money;
        $dno++;
        $total_d=$total_d+$money;
        }  
       
       $all_deductions=$total_d+200+$nhif+$paye_reliefed+$pension_scheme+300;
        $array_size = $eno;
        if($dno > $eno){
          $array_size = $dno;
        }


  
require('FPDF_Protection/fpdf_protection.php');

class PDF extends FPDF {
    function Header(){}
    function Footer()
    {
        date_default_timezone_set('Africa/Nairobi');
        $now = new DateTime();
        $dt=$now->format('d-m-Y  H:i:s');
        $this->SetY(-15);

        $this->SetFont('Arial','',7);

        $this->Cell(0,10,'Page'.$this->PageNo()."/{pages}",0,1,'C');
        $this->Cell(0,5,'This is a system generated document.  Generated on '.$dt,0,0,'R');
    }

}
$pdf = new PDF('P','mm','A4');
$pdf = new FPDF_Protection();
$pdf->SetProtection(array('print'), $national_id);

$pdf->AliasNbPages('{pages}');

$pdf->AddPage();
$pdf->SetFont('Arial', '',12);
$pdf->Image('logo.png',10,12,180);


$pdf->Ln(45);

$pdf->SetFont('Arial', 'B',13);
$pdf->Cell(0,5,'Payslip for '.$mon.' '.$payYear,0,1,'C');
$pdf->SetFont('Arial', 'B',10);
$pdf->Cell(196,5,'__________________________________________________________________________________________________',0,1);
$pdf->SetFont('Arial', 'B',13);

$pdf->Cell(0,5,$name.' ('.$pfno.')',0,1,'C');

$pdf->SetFillColor(180,180,255);
$pdf->SetDrawColor(50,50,100);

$pdf->SetFont('Arial', 'B',11);


$pdf->Ln(5);

$pdf->SetFont('Arial', 'B',11);
$pdf->Cell(30,5,'National ID:',0,0);
$pdf->SetFont('Arial', '',11);
$pdf->Cell(50,5,$national_id,0,0);
$pdf->SetFont('Arial', 'B',11);
$pdf->Cell(25,5,'KRA PIN:',0,0);
$pdf->SetFont('Arial', '',11);
$pdf->Cell(50,5,$kra_pin,0,0);
$pdf->SetFont('Arial', 'B',11);
$pdf->Cell(10,5,'Date:',0,0);
$pdf->SetFont('Arial', '',11);
$pdf->Cell(25,5,$date,0,1);

$pdf->SetFont('Arial', 'B',11);
$pdf->Cell(30,5,'Department :',0,0);
$pdf->SetFont('Arial', '',11);
$pdf->Cell(50,5,$department,0,0);
$pdf->SetFont('Arial', 'B',11);
$pdf->Cell(25,5,'Pay Grade',0,0);
$pdf->SetFont('Arial', '',11);
$pdf->Cell(50,5,$pay_grade,0,1);

$pdf->SetFont('Arial', 'B',11);
$pdf->Cell(30,5,'Bank :',0,0);
$pdf->SetFont('Arial', '',11);
$pdf->Cell(50,5,$bank,0,1);

$pdf->SetFont('Arial', 'B',11);
$pdf->Cell(30,5,'Job Title:',0,0);
$pdf->SetFont('Arial', '',11);
$pdf->Cell(70,5,$job,0,0);
$pdf->Cell(25,5,'',0,0);
$pdf->Cell(25,5,'',0,1);

$pdf->Ln(5);
$pdf->SetFillColor(180,180,255);
$pdf->SetDrawColor(50,50,100);

$pdf->SetFont('Arial', 'B',11);
$pdf->Cell(75,8,'Earnings',1,0,'',true);
$pdf->Cell(23,8,'Amount',1,0,'',true);
$pdf->Cell(75,8,'Deductions',1,0,'',true);
$pdf->Cell(23,8,'Amount',1,1,'',true);

for ($i=0; $i < $array_size; $i++) { 
  $en = number_format($earn_array_amount[$i],2);
  $ded = number_format($deduct_array_amount[$i],2);

  if($en === "0.00")
  {
    $en="";
  }

  if($ded === "0.00"){
    $ded ="";
  }

  $pdf->SetFont('Arial', '',10);
  $pdf->Cell(75,8,$earn_array_type[$i],0,0);
  $pdf->Cell(23,8,$en,0,0);
  $pdf->Cell(75,8,$deduct_array_type[$i],0,0);
  $pdf->Cell(23,8,$ded,0,1);
}
$pdf->SetFont('Arial', 'B',10);
$pdf->Cell(196,5,'__________________________________________________________________________________________________',0,1);

  $pdf->Cell(40,8,'',0,0);
  $pdf->Cell(35,8,'Total Earnings:',0,0);
  $pdf->Cell(23,8,number_format($total_e,2),0,0);
  $pdf->Cell(40,8,'',0,0);
  $pdf->Cell(35,8,'Total Deductions:',0,0);
  $pdf->Cell(23,8,number_format($all_deductions,2),0,1);
$pdf->Cell(196,5,'__________________________________________________________________________________________________',0,1);
  $pdf->Cell(196,8,'Net Payable (Total Earnings - Total Deductions): '.number_format($total_e-$all_deductions,2),0,1);

   $pdf->Cell(196,5,'__________________________________________________________________________________________________',0,1);

$pdf->Ln(50);
date_default_timezone_set('Africa/Nairobi');
        $now = new DateTime();
        $dt=$now->format('d-m-Y  H:i:s');
        $pdf->SetFont('Arial', '',5);
$pdf->Cell(0,5,'This is a system generated document.  Generated on '.$dt,0,0,'R');
$pdf->Output('doc/'.$file_name,'F');

//Saving file to the database
$mn=$payYear.$payMonth;
$sql="SELECT * FROM tb_payement_slips WHERE emp_id='$empid' AND pay_month='$mn'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    $cnt=0;
    while($row=mysqli_fetch_array($result))
      {   
          $file_n=$row['file_name'];
      }
 if(empty($file_n) === true)
 {
   $sqlc = "INSERT INTO `tb_payement_slips` (`emp_id`,`pay_month`,`file_name`) VALUES ('$empid','$mn','$file_name')";  
         if (!mysqli_query($con,$sqlc)){
          // echo "error";
        } else {
           //echo "success";
        }

 } 


 //..........................................Send Email
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = 1;                     //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'no_reply@consolatamedcollege.ac.ke';                     //SMTP username
    $mail->Password   = 'cmrmtonalnvatzbs'; //Phpcode@20222                              //SMTP password
    $mail->SMTPSecure = 'ssl';        //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('no_reply@consolatamedcollege.ac.ke', 'Sr. Leonella Consolata Medical College');
    $mail->addAddress($email);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('no_reply@consolatamedcollege.ac.ke');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Payslip for '.$mon;
    $mail->Body    = 'Dear '.$name.', find your payslip for '.$mon.$payYear.' attached. Password is your national ID number<br> <br>
        Thanks for your services.<br>
        ---<br>
      Sister Leonella Consolata Medical College<br>
      P.O Box 25 - 10100 Nyeri<br>
      Cell:  +254724303431<br>
      Physical Address:  Along Nyeri-Mathari-Ihururu Road<br>
      Website:  www.consolatamedcollege.ac.ke';
      $mail->addAttachment('doc/'.$file_name);

    $mail->send();
    //echo json_encode(array("message" => "Message has been sent"));
    echo "success";
} catch (Exception $e) {
    //echo json_encode(array("message" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
   echo "error";

}
        
    
?>