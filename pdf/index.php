<?php
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
$pdf->SetProtection(array('print'), '1234');

$pdf->AliasNbPages('{pages}');

$pdf->AddPage();

$pdf->Ln(45);

$pdf->SetFont('Arial', 'B',13);
$pdf->Cell(0,5,'PAYSLIP FOR THE MONTH OF ',0,1,'C');
$pdf->SetFont('Arial', 'B',10);
$pdf->Cell(196,5,'__________________________________________________________________________________________________',0,1);
$pdf->SetFont('Arial', 'B',13);

$pdf->Cell(0,5,'Ndegwa',0,1,'C');

$pdf->SetFillColor(180,180,255);
$pdf->SetDrawColor(50,50,100);

$pdf->SetFont('Arial', 'B',11);


$pdf->Ln(5);

$pdf->Ln(5);
$pdf->SetFillColor(180,180,255);
$pdf->SetDrawColor(50,50,100);

$pdf->SetFont('Arial', 'B',11);
$pdf->Cell(75,8,'Earnings',1,0,'',true);
$pdf->Cell(23,8,'Amount',1,0,'',true);
$pdf->Cell(75,8,'Deductions',1,0,'',true);
$pdf->Cell(23,8,'Amount',1,1,'',true);

$pdf->SetFont('Arial', 'B',10);
$pdf->Cell(196,5,'__________________________________________________________________________________________________',0,1);


$pdf->Ln(70);
date_default_timezone_set('Africa/Nairobi');

$pdf->Output('protected.pdf','F');
?>