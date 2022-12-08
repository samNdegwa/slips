<?php
// Current Date
date_default_timezone_set('Africa/Nairobi');
$now = new DateTime();
$stamp = $now->format('YmdHi');

$sentDate= '1/14/2021 12:48';
$dateLength = strlen($sentDate);
$actualLength = $dateLength-5;
$createDate = substr($sentDate,0,$actualLength);

// Increment by one year
$date=date_create($createDate);
date_add($date,date_interval_create_from_date_string("366 days"));
echo date_format($date,"m/d/Y");


?>