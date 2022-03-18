<?php
include_once ('connect.php');

$db=$connect;
function fetch_data()
{
    global $db;
    $floor = $_POST['floor'];
    $query = "SELECT * FROM `room` WHERE room.room_id LIKE '$floor%' ORDER BY `room`.`room_id` ASC";
    $exec = mysqli_query($db, $query);
    if (mysqli_num_rows($exec) > 0)
    {
        $row = mysqli_fetch_all($exec, MYSQLI_ASSOC);
        return $row;
    }
    else
    {
        return $row = [];
    }
}

$fetchData = fetch_data();
show_data($fetchData);

function show_data($fetchData)
{
    echo '<table class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th style="width: 50px">Number</th>
            <th style="width: 40%;">Label</th>
            <th>Status</th>
            <th style="width: 20%;">Action</th>
        </tr>
    </thead>
    <tbody>';

    if (count($fetchData) > 0)
    {
        foreach ($fetchData as $data)
        {
            if($data['status'] == 1)
            {
                $data['status'] = '<div class="progress-bar bg-danger" style="width: 100%">Unavailable</div>';
            }
            else if($data['status'] == 0)
            {
                $data['status'] = '<div class="progress-bar bg-success" style="width: 100%">Available</div>';
            }
            else if($data['status'] == 2)
            {
                $data['status'] = '<div class="progress-bar bg-secondary" style="width: 100%">Sensors not installed</div>';
            }
            echo "<tr>
          <td>" . $data['room_id'] . "</td>"; ?>
          <td style="cursor:pointer" onclick="location.href='roomdetails.php?room=<?php echo $data['room_id']; ?>'"> <?php echo $data['name_EN'] ; ?><br><?php echo $data['name_TH']; ?></td>
          <?php echo "<td>" . $data['status'] . "</td>
          <td>
         <button type='button' class='open-Dialog btn btn-primary btn-sm' data-toggle='modal' data-target='#modal-default' data-id='".$data['room_id']."~".$data['name_EN']."~".$data['name_TH']."'><i class='fas fa-calendar-check'></i> Book</button>
         <a class='btn btn-info btn-sm' href='roomdetails.php?room=".$data['room_id']."'><i class='fas fa-info-circle'></i> Details</a>
          </td>
   </tr>
   ";
        }
    }
    else
    {
        echo "<tr>
        <td colspan='7'>No Data Found</td>
       </tr>";
    }
    echo "</tbody></table>";
}

?>
