<?php 
// Load the database configuration file 
include_once 'dbConfig.php'; 
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "ekas_vehicle_data_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('id', 'phone', 'violation_date', 'group_name', 'message', 'date_sent', 'time_sent','stamp','status','cost'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $db->query("SELECT * FROM ekas_vehicle_contacts"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
        
        $lineData = array($row['id'], $row['phone'], $row['violation_date'], $row['group_name'], $row['message'], $row['date_sent'], $row['time_sent'], $row['stamp'], $row['status'], $row['cost']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;