<?php
    include 'dashboard/core/init.php';
     require_once ('dashboard/functions/AfricasTalkingGateway.php');
     date_default_timezone_set('Africa/Nairobi');
    $now = new DateTime();
    $today = $now->format('Ymd');
    // $json = $_POST['data'];
    // $data = json_decode($json);
    // $txt=$_SESSION['messages'];
    $entries=50;
    $stamp='202111010853';
    $vehicles=[];
    $phones=[];
    $txts=[];
    $violation=[];
    $specialDate=[];
    $sql="SELECT * FROM ekas_vehicle_contacts WHERE stamp='$stamp' AND status='Not Sent'";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    $cnt=0;
    while($row=mysqli_fetch_array($result))
      {   
          $vehicle=$row['vehicle'];
          $mes=$row['message'];
          $phone=$row['phone'];
          $date=$row['violation_date'];
          $vd=$date[0].$date[1].$date[2].$date[3].$date[4].$date[5].$date[6].$date[7].$date[8].$date[9]; 

          $vehicles[$cnt]=$vehicle;
          $txts[$cnt]=$mes;
          $phones[$cnt]=$phone;
          $specialDate[$cnt]=$date;
          $violation[$cnt]=$vd;
          $cnt=$cnt+1; 

      }
      
      $in=0;
      while($in<$entries)
      {
        $myCar=$vehicles[$in];
        $myPhone=$phones[$in];
        $vdate=$violation[$in];
        $vtime=$specialDate[$in];
        $going_message = $txts[$in];
      
$username  = "Ekas1";
$apikey    = "13b44c5b52cbd78c4fd19d7a2aa1329ccee7f01bec94cac107dd2c8c937d1905";

$recipients  = $myPhone;
$message="";
$message  =$going_message;

$gateway  = new AfricasTalkingGateway($username, $apikey);

try{
  
  $results = $gateway->sendMessage($recipients,$message,'EKASTECH');

  foreach ($results as $result) {
    date_default_timezone_set('Africa/Nairobi');
     $now = new DateTime();
     $time=$now->format('H:i');
     $date=$now->format('d-m-Y');
     $status=$result->status;
     $cost=$result->cost;
     if ($status === 'Success') {
     $sql = "UPDATE ekas_vehicle_contacts SET date_sent='$date', time_sent='$time', status='$status', cost='$cost'  WHERE vehicle='$myCar' AND stamp='$stamp' AND status='Not Sent'";
     if ($con->query($sql) === TRUE) {
  
       } else {
  
        }

     } else {
      $sql = "UPDATE ekas_vehicle_contacts SET message='$going_message' WHERE vehicle='$myCar' AND stamp='$stamp' AND status='Not Sent'";
     if ($con->query($sql) === TRUE) {
  
       } else {
  
        }

     }
    } 
}
catch ( AfricasTalkingGatewayException $e)
{
  
}
        $in++;
        
       }
     echo 'success';
  
?>