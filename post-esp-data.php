<?php
include_once('connect.php');

$sensor = $location = $temp = $light = $sound = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $api_key = $_GET["api_key"];
    if($api_key == $api_key_value) {
        $sensor = $_GET["sensor"];
        $room = $_GET["room"];
        $temp = $_GET["temp"];
        $light = $_GET["light"];
        $sound = $_GET["sound"];

        //$sql = "INSERT INTO SensorData (sensor, temp, light, sound)
        //VALUES ('" . $sensor . "', '" . $temp . "', '" . $light . "', '" . $sound . "')";
        // '1' = Unavailable
        // '0' = Available
        if($temp >= '20' && $temp <= '30' && $light >= '100' && $light <= '1100' && $sound >= '300' && $sound <= '800')
        {
            $sql = "INSERT INTO `sensors` (`data_id`, `room_id`, `board_id`, `light`, `temp`, `sound`, `uploadtime`, `status`) 
        VALUES (NULL, '" . $room . "', '" . $sensor . "', '" . $light . "', '" . $temp . "', '" . $sound . "', CURRENT_TIMESTAMP, 'ก')";
        }
        // else if($room == '516' && $temp >= '20' && $temp <= '30' && $light >= '100' && $light <= '1100')
        // {
        //     $sql = "INSERT INTO `sensors2` (`data_id`, `room_id`, `board_id`, `light`, `temp`, `sound`, `uploadtime`, `status`) 
        //     VALUES (NULL, '" . $room . "', '" . $sensor . "', '" . $light . "', '" . $temp . "', '" . $sound . "', CURRENT_TIMESTAMP, 'ก')";
            
        // }
        if (mysqli_query($connect, $sql)) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_connect_error();
        }
    
        mysqli_close($connect);
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}