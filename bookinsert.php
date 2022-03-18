<?php 

include_once ('connect.php');

$user =  $_POST['user'];
$id = $_POST['room_id'];
$date = $_POST['date'];
date_default_timezone_set('Asia/Bangkok');
$time = date('Y-m-d H:i:s');
$dateArray = explode(" ", $date);
$duration = $_POST['time'];
$cobooking = array();
if(isset($_POST['cobooking']))
{
	$cobooking = $_POST['cobooking'];
}
    
$durationArray = explode("-", $duration);
$identifycode = generateRandomString(5, $id);

function generateRandomString($length, $id) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
	$date = date('y-m-d');
	$dayArray = explode("-", $date);
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0,9)];
		if($i == 3)
		{
			$randomString .= $characters[rand(10, $charactersLength - 1)];
		}
    }
	$result = 'WM'.$dayArray[0].$dayArray[1].$id.$randomString;
    return $result;
}



//$query = "UPDATE `appo` SET `date` = '" . $_POST['date'] . "'  WHERE `id` = '" . $_POST['event'] . "'";
//$query = "INSERT INTO `reservation` (`reserve_id`, `cmuitaccount_name`, `room_id`, `date`, `start_time`, `end_time`, `notification_check`) VALUES ('$identifycode', '$user', '$id', '$dateArray[0]', '$durationArray[0]', '$durationArray[1]', '0')";


//Check duplicate in reservation table 
$select_query = "SELECT * FROM reservation WHERE reservation.room_id = '$id' AND reservation.date = '$dateArray[0]' AND reservation.start_time = '$durationArray[0]'";
$query = mysqli_query($connect, $select_query);

if(mysqli_num_rows($query) == 0)
{
	$find_dup_user = "SELECT * FROM `reservation` WHERE reservation.cmuitaccount_name = '$user' AND reservation.date = '$dateArray[0]'";
	$find_dup_user_query = mysqli_query($connect, $find_dup_user);
	$find_dup_user_amount = mysqli_num_rows($find_dup_user_query); 
	if($find_dup_user_amount <= 1)
	{
		$select_query1 = "SELECT * FROM `reservation` WHERE reservation.cmuitaccount_name = '$user' AND reservation.date = '$dateArray[0]' AND reservation.start_time = '$durationArray[0]'";
		$query1 = mysqli_query($connect, $select_query1);
		if(mysqli_num_rows($query1) == 0)
		{
			$select_query2 = "SELECT * FROM `timetable` WHERE timetable.day LIKE '%$dateArray[1]%' AND timetable.room_id = '$id' AND ('$durationArray[0]' BETWEEN timetable.start_time AND timetable.end_time)";
			$query2 = mysqli_query($connect, $select_query2);
			if(mysqli_num_rows($query2) == 0)
			{
				//INSERT INTO `reservation` (`reserve_id`, `cmuitaccount_name`, `room_id`, `date`, `start_time`, `end_time`, `reservation_time`, `notification_check`) VALUES ('efn345Ytre', 'poom_somwong', '412', '2021-04-25', '13:00:00', '14:30:00', '12:56:32', '0');
				if(isset($cobooking[0]))
				{
					//INSERT INTO `reservation` (`reserve_id`, `cmuitaccount_name`, `cmuitaccount_name2`, `room_id`, `date`, `start_time`, `end_time`, `reservation_time`, `notification_check`, `approvenoti_check`) VALUES ('WM000009X000000', 'poom_somwong', 'apisamai_m', 'apisamai_m', 'apisamai_m', '516', '2021-06-23', '08:49:16', '23:49:16', '2021-06-24 15:49:16.000000', '0', '0');
					$select_query3 = "INSERT INTO `reservation` (`reserve_id`, `cmuitaccount_name`, `cmuitaccount_name2`, `room_id`, `date`, `start_time`, `end_time`, `reservation_time`, `notification_check`, `approvenoti_check`) VALUES ('$identifycode', '$user', '$cobooking[0]', '$id', '$dateArray[0]', '$durationArray[0]', '$durationArray[1]', '$time', '0', '0')";
					
					if(isset($cobooking[1]))
					{
						$select_query3 = "INSERT INTO `reservation` (`reserve_id`, `cmuitaccount_name`, `cmuitaccount_name2`, `cmuitaccount_name3`, `room_id`, `date`, `start_time`, `end_time`, `reservation_time`, `notification_check`, `approvenoti_check`) VALUES ('$identifycode', '$user', '$cobooking[0]', '$cobooking[1]', '$id', '$dateArray[0]', '$durationArray[0]', '$durationArray[1]', '$time', '0', '0')";
					
						if(isset($cobooking[2]))
						{
							$select_query3 = "INSERT INTO `reservation` (`reserve_id`, `cmuitaccount_name`, `cmuitaccount_name2`, `cmuitaccount_name3`, `cmuitaccount_name4`, `room_id`, `date`, `start_time`, `end_time`, `reservation_time`, `notification_check`, `approvenoti_check`) VALUES ('$identifycode', '$user', '$cobooking[0]', '$cobooking[1]', '$cobooking[2]', '$id', '$dateArray[0]', '$durationArray[0]', '$durationArray[1]', '$time', '0', '0')";
						}
					}
				}
				else
				{
					$select_query3 = "INSERT INTO `reservation` (`reserve_id`, `cmuitaccount_name`, `room_id`, `date`, `start_time`, `end_time`, `reservation_time`, `notification_check`, `approvenoti_check`) VALUES ('$identifycode', '$user', '$id', '$dateArray[0]', '$durationArray[0]', '$durationArray[1]', '$time', '0', '0')";
				}
				
				if(mysqli_query($connect, $select_query3))
				{
					
					$select_query4 = "SELECT * FROM `users` WHERE cmuitaccount_name = '$user'";
					$query4 = mysqli_query($connect, $select_query4);
					$name = mysqli_fetch_assoc($query4);
					$name_EN = $name['firstname_EN'].' '.$name['lastname_EN'];
		
					$data = array(
						'book_id'=>$identifycode,
						'transactiontime'=>$time,
						'user'=>$user,
						'cobooking'=>$cobooking,
						'bool'=>'1',
					);
					echo json_encode($data);
		
				}
				else
				{
					$status = "Error to booking at selected time.";
					$data = array(
						'bool'=>'2',
						'status'=>$status,
					);
					echo json_encode($data);
				}
			}
			else
			{
				$timetable = mysqli_fetch_assoc($query2);
				$status = "This room using for <b>".$timetable['course_name']."</b> course at selected time.";
				$data = array(
					'bool'=>'3',
					'status'=>$status,
				);
				echo json_encode($data);
			}
		}
		else
		{
			$which_room = mysqli_fetch_assoc($query1);
			$status = "Your previous booking at <b>".$which_room['room_id']."</b> room has the same start time.";
			$data = array(
				'bool'=>'6',
				'status'=>$status,
			);
			echo json_encode($data);
		}
	}
	else
	{
		$status = "You have reached your booking quota limit per day.";
		$data = array(
			'bool'=>'5',
			'status'=>$status,
		);
		echo json_encode($data);
	}
}
else
{
	$status = "This room has been booked for the time you selected.";
	$data = array(
		'bool'=>'4',
		'status'=>$status,
	);
	echo json_encode($data);
}

?>