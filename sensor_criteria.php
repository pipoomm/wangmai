<?php
include ('connect.php');
date_default_timezone_set('Asia/Bangkok');
$date = date('D');
$time = date('H:i:s');
if(isset($_POST['room_id']))
{
    if($_POST['light'] == 0 && $_POST['temp'] == 0 && $_POST['sound'] == 0)
    {
        $room_id = $_POST['room_id'];
        $sql_reserv = "SELECT * FROM `reservation` WHERE reservation.date = CURDATE() AND reservation.notification_check = '1' AND reservation.approvenoti_check = '1' AND reservation.end_time >= (NOW()) AND reservation.room_id = '$room_id';";
        $runsql_reserv = mysqli_query($connect,$sql_reserv);
        if($runsql_reserv->num_rows == 0) {
                // row not found, do stuff...
                $room_id = $_POST['room_id'];
                $update = "UPDATE `room` SET `status` = '2' WHERE `room`.`room_id` = '" .$room_id."' ;";
                $run_update = mysqli_query($connect,$update);
                if($run_update){
                    $state = 'Sensor no installed due to 1st loop';
                }

        } else {
            // do other stuff...
                $room_id = $_POST['room_id'];
                $update = "UPDATE `room` SET `status` = '1' WHERE `room`.`room_id` = '" .$room_id."' ;";
                $run_update = mysqli_query($connect,$update);
                if($run_update){
                    $state = 'Unavailable';
                }
        }

        $sql_timetable = "SELECT * FROM `timetable` WHERE timetable.day LIKE '%$date%' AND timetable.room_id = '$room_id' AND ('$time' BETWEEN timetable.start_time AND timetable.end_time);";
        //$sql_timetable = "SELECT * FROM `reservation` WHERE reservation.date = CURDATE() AND reservation.notification_check = '1' AND reservation.approvenoti_check = '1' AND reservation.end_time >= (NOW());";
        $runsql_timetable = mysqli_query($connect,$sql_timetable);
            while ($result = mysqli_fetch_array($runsql_timetable, MYSQLI_ASSOC)) {
                $update = "UPDATE `room` SET `status` = '1' WHERE `room`.`room_id` = '" .$result['room_id']."' ;";
                $run_update = mysqli_query($connect,$update);
                if($run_update){
                    $state = '+Unavailable';
                }
            }
        
    }
    else 
    {
        $room_id = $_POST['room_id'];
        $update = "UPDATE `room` SET `status` = '".$_POST['status']."' WHERE `room`.`room_id` = '" .$room_id."' ;";
        $run_update = mysqli_query($connect,$update);
        if($run_update){
            //($_POST['status'] == 1 ? $state = 'Unavailable' : $state = 'Available');
            if($_POST['status'] == '1')
            {
                $state = '*Unavailable';
            }
            else if ($_POST['status'] == '0')
            {
                $state = 'Available';
            }
        }
    
        $sql_reserv = "SELECT * FROM `reservation` WHERE reservation.date = CURDATE() AND reservation.notification_check = '1' AND reservation.approvenoti_check = '1' AND reservation.end_time >= (NOW());";
        $runsql_reserv = mysqli_query($connect,$sql_reserv);
        while ($result = mysqli_fetch_array($runsql_reserv, MYSQLI_ASSOC)) {
            $update = "UPDATE `room` SET `status` = '1' WHERE `room`.`room_id` = '" .$result['room_id']."' ;";
            $run_update = mysqli_query($connect,$update);
            if($run_update){
                $state = '-Unavailable';
            }
        }

        
        $sql_timetable = "SELECT * FROM `timetable` WHERE timetable.day LIKE '%$date%' AND timetable.room_id = '$room_id' AND ('$time' BETWEEN timetable.start_time AND timetable.end_time);";
        //$sql_timetable = "SELECT * FROM `reservation` WHERE reservation.date = CURDATE() AND reservation.notification_check = '1' AND reservation.approvenoti_check = '1' AND reservation.end_time >= (NOW());";
        $runsql_timetable = mysqli_query($connect,$sql_timetable);
        while ($result = mysqli_fetch_array($runsql_timetable, MYSQLI_ASSOC)) {
            $update = "UPDATE `room` SET `status` = '1' WHERE `room`.`room_id` = '" .$result['room_id']."' ;";
            $run_update = mysqli_query($connect,$update);
            if($run_update){
                $state = '++Unavailable';
            }
        }
    }
}
else
{
    $state = 'ROOM ID NOT SET';
}


$data = array(
    'state'=>$state,
);
echo json_encode($data);

?>