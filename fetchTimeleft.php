<?php 
date_default_timezone_set('Asia/Bangkok'); 

include_once ('connect.php');
include 'include/function.php';

if(isset($_POST['option']))
{
    $user = $_POST['user'];

    if($_POST['option'] != '')
    {
        if(str_starts_with($_POST['option'] , 'WM'))
        {
            $reserveid = $_POST['option'];
            $update = "UPDATE `reservation` SET `approvenoti_check` = '1' WHERE `reservation`.`reserve_id` = '$reserveid' ";
            mysqli_query($connect, $update);
        }
    }

    $query = "SELECT * FROM `reservation` WHERE cmuitaccount_name = '$user' AND reservation.end_time >= (NOW()) ORDER BY `reservation`.`reservation_time` DESC LIMIT 1";
    $result = mysqli_query($connect, $query);
    $total_reserve = mysqli_num_rows($result);
    $output = '';

    if($total_reserve > 0)
    {
        while($row = mysqli_fetch_array($result)){
            $start_time = $row['date'].' '.$row['start_time'];
            
            $date_time_deadline = new DateTime($start_time);
            $date_time_now = new DateTime();
            $difference = $date_time_now->diff($date_time_deadline);
            
            $diff_min = (int) $difference->format('%i');
            $diff_hours = (int) $difference->format('%h');
            $diff_days = (int) $difference->format('%a');

            if($row['approvenoti_check'] == '0')
            {
                if($diff_days == 0 && $diff_hours == 0 && $diff_min <= 5)
                {
                    $output.="
                    <span class='dropdown-item dropdown-header'>Upcoming event</span>
                    <div class='dropdown-divider'></div>
                    
                    <a href='bookverify.php?text=".$row['reserve_id']."' class='dropdown-item' value='".$row['reserve_id']."' onclick='return checkUpcomming(this);'>
                    <span class='float-right text-sm text-danger'><i class='fas fa-circle'></i></span>
                    <i class='fas fa-map-marker-alt'></i> Room ".$row['room_id']."<span class='float-right text-muted text-sm'>".time_elapsed_string($row['reservation_time'])."&nbsp;</span>
                    <p class='text-sm text-muted'><i class='far fa-calendar-alt'></i> ".date("l\, j F Y", strtotime($row['date']))."</p>
                    <p class='text-sm text-muted'><i class='far fa-clock mr-1'></i> ".$row['start_time']." - ".$row['end_time']."</p>
                    </a>";
                    $toast = "found";
                }
                else
                {
                    $output.="<a href='#' class='dropdown-item dropdown-footer'>You have no upcoming event</a>";
                    $toast = "notfound";
                }
            }
            else
            {
                if($diff_days == 0 && $diff_hours == 0 && $diff_min <= 5)
                {
                    $output.="
                    <span class='dropdown-item dropdown-header'>Upcoming event</span>
                    <div class='dropdown-divider'></div>
                    
                    <a href='bookverify.php?text=".$row['reserve_id']."' class='dropdown-item' value='".$row['reserve_id']."' onclick='return checkUpcomming(this);'>
                    <i class='fas fa-map-marker-alt'></i> Room ".$row['room_id']."<span class='float-right text-muted text-sm'>".time_elapsed_string($row['reservation_time'])."&nbsp;</span>
                    <p class='text-sm text-muted'><i class='far fa-calendar-alt'></i> ".date("l\, j F Y", strtotime($row['date']))."</p>
                    <p class='text-sm text-muted'><i class='far fa-clock mr-1'></i> ".$row['start_time']." - ".$row['end_time']."</p>
                    </a>";
                    $toast = "notfound";
                }
                else
                {
                    $output.="<a href='#' class='dropdown-item dropdown-footer'>You have no upcoming event</a>";
                    $toast = "notfound";
                }
            }
        }

    }
    else
    {
        $start_time = new DateTime();
        $output.="<a href='#' class='dropdown-item dropdown-footer'>You have no upcoming event</a>";
        $toast = "notfound";
    }

    
    $status_query = "SELECT * FROM reservation WHERE reservation.approvenoti_check = '0' AND reservation.cmuitaccount_name = '$user' ";
    $result_query = mysqli_query($connect, $status_query);
    $count = mysqli_num_rows($result_query);
    $data = array(
        'notification'=>$output,
        'unreadNotification'=>$count,
        'toast'=>$toast,
        'futuredate'=>$start_time,
    );
    echo json_encode($data);
}
?>
