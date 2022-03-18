<?php 
 
// Load the database configuration file 
include('connect.php');
 
// Fetch records from database 
$query = $connect->query("SELECT * FROM `sensors` ORDER BY `sensors`.`uploadtime` DESC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "sensor-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('data_id', 'room_id', 'board_id', 'light', 'temp', 'sound', 'uploadtime', 'status'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){
        $lineData = array($row['data_id'], $row['room_id'], $row['board_id'], $row['light'], $row['temp'], $row['sound'], $row['uploadtime'], $row['status']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
    
    // Set headers to download file rather than displayed 
   // header('Content-Type: text/csv'); 
   // header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 

    // $row = 1;
    // if (($handle = fopen("csv/SensorDataset.csv", "r")) !== FALSE) {
    //     while (($data = fgetcsv($handle)) !== FALSE) {
    //         $num = count($data);
    //         $row++;
    //         for ($c=0; $c < $num; $c++) {
    //             echo $data[$c];
    //         }
    //     }
    //     fclose($handle);
    // }

    
} 
exit; 
 
?>