<?php
include_once ('connect.php');
include 'include/function.php';

 $update_approve = "UPDATE `reservation` SET `approvenoti_check` = '3' WHERE reservation.start_time < DATE_SUB(NOW(), INTERVAL 5 MINUTE) AND reservation.approvenoti_check = '0'";
 mysqli_query($connect, $update_approve);

if(isset($_POST['option']))
{
    $user = $_POST['user'];
    if($_POST['option'] != '')
    {
        $update = "UPDATE `reservation` SET `notification_check` = '1' WHERE notification_check = '0' AND cmuitaccount_name = '$user'";
        mysqli_query($connect, $update);
    }

    $query = "SELECT * FROM `reservation` WHERE cmuitaccount_name = '$user' ORDER BY `reservation`.`reservation_time` DESC";
    $result = mysqli_query($connect, $query);
    $total_reserve = mysqli_num_rows($result);
    $output = '';
    $header = TRUE;
    $futuredateStr = '';
    $i = 0;


    if($total_reserve > 0)
    {
        while($row = mysqli_fetch_array($result)){
            $i += 1;

            if($header == TRUE)
            {
                $output.="
                <span class='dropdown-item dropdown-header'>".$total_reserve." Bookings</span>
                <div class='dropdown-divider'></div>
                <a href='bookverify.php?text=".$row['reserve_id']."' class='dropdown-item'>
                <i class='fas fa-map-marker-alt'></i> Room ".$row['room_id']."<span class='float-right text-muted text-sm'>".time_elapsed_string($row['reservation_time'])."&nbsp;</span>
                <p class='text-sm text-muted'><i class='far fa-calendar-alt'></i> ".date("l\, j F Y", strtotime($row['date']))."</p>
                <p class='text-sm text-muted'><i class='far fa-clock mr-1'></i> ".$row['start_time']." - ".$row['end_time']."</p>
                </a>";
                $header = FALSE ;
            }
            else
            {
                if($i == 5)
                {
                    $output.="
                <div class='dropdown-divider'></div>
                <a href='bookverify.php?text=".$row['reserve_id']."' class='dropdown-item'>
                <i class='fas fa-map-marker-alt'></i> Room ".$row['room_id']."<span class='float-right text-muted text-sm'>".time_elapsed_string($row['reservation_time'])."</span>
                <p class='text-sm text-muted'><i class='far fa-calendar-alt'></i> ".date("l\, j F Y", strtotime($row['date']))."</p>
                <p class='text-sm text-muted'><i class='far fa-clock mr-1'></i> ".$row['start_time']." - ".$row['end_time']."</p>
                </a>
                <div class='dropdown-divider'></div>
                <a href='bookhistory.php' class='dropdown-item dropdown-footer'>See All Bookings</a>";
                    break;
                }
                else
                {
                    $output.="
                <div class='dropdown-divider'></div>
                <a href='bookverify.php?text=".$row['reserve_id']."' class='dropdown-item'>
                <i class='fas fa-map-marker-alt'></i> Room ".$row['room_id']."<span class='float-right text-muted text-sm'>".time_elapsed_string($row['reservation_time'])."</span>
                <p class='text-sm text-muted'><i class='far fa-calendar-alt'></i> ".date("l\, j F Y", strtotime($row['date']))."</p>
                <p class='text-sm text-muted'><i class='far fa-clock mr-1'></i> ".$row['start_time']." - ".$row['end_time']."</p>
                </a>";
                }
                
            }
            }
    } 
    else 
    {
        $output.="<a href='#' class='dropdown-item dropdown-footer'>You have no bookings</a>";
    }
    $status_query = "SELECT * FROM reservation WHERE reservation.notification_check = '0' AND cmuitaccount_name = '$user' ";
    $result_query = mysqli_query($connect, $status_query);
    $count = mysqli_num_rows($result_query);
    $data = array(
        'notification'=>$output,
        'unreadNotification'=>$count,
        
    );
    echo json_encode($data);
}
?>