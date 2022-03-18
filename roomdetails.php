<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $_GET['room']; ?> | Details</title>
    <link rel="icon" href="003-w-2.png" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"
        integrity="sha256-RRb75FFB4bqHpBTVaEua+QNVpKSI5m4HBvQKgY1E8S4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <script src="plugins/toastr/toastr.min.js"></script>
</head>
<?php 
include('include/session_check.php'); 
//include('ml_status.php');
date_default_timezone_set('Asia/Bangkok');
?>
<?php
$sql = "SELECT light,temp,sound,uploadtime FROM sensors WHERE room_id='" .$_GET['room'] ."' ORDER BY uploadtime DESC LIMIT 10";
$query = mysqli_query($connect, $sql);
$i = 1;
$avg_sound = 0;
$avg_temp = 0;
$avg_light = 0;
while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $avg_sound += $result['sound'];
    $avg_temp += $result['temp'];
    $avg_light += $result['light'];
}
$avg_sound = $avg_sound / 10;
$avg_temp = $avg_temp / 10;
$avg_light = $avg_light / 10;

$flag_sound = TRUE;
$flag_temp = TRUE;
$flag_light = TRUE;

if ($avg_sound > 0 && $avg_sound <= 725 || $avg_sound == 0) {
    //silient
    $flag_sound = FALSE;
} elseif ($avg_sound >= 726 && $avg_sound <= 1024) {
    //noisy
    $flag_sound = TRUE;
}
if ($avg_temp >= 18 && $avg_temp <= 26) {
    //air cond on
    $flag_temp = TRUE;
} elseif ($avg_temp >= 27 && $avg_temp <= 40 || $avg_temp == 0) {
    //air cond off
    $flag_temp = FALSE;
}
if ($avg_light > 0 && $avg_light <= 649) {
    //light off
    $flag_light = TRUE;
} elseif ($avg_light >= 650 && $avg_light <= 1024 || $avg_light == 0) {
    //light on
    $flag_light = FALSE;
}
?>

<body class="hold-transition sidebar-mini layout-fixed" style="height: auto;">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/nav.php'; ?>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <?php include 'include/sidebar.php'; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php
            $room = $_GET['room'];
            $sql = "SELECT * FROM `room` WHERE `room_id` = '$room'";
            $query = mysqli_query($connect, $sql);
            while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) { 
            $room_name = $result['room_id'] .' - ' .$result['name_EN'] ." | " .$result['name_TH'];
            ?>
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" class="float-right btn btn-app" data-toggle="modal"
                                data-target="#modal-default"><i class="fas fa-calendar-check"></i> Book</button>
                            <h1 class="m-0"><?php echo $room_name; ?></h1>
                            <a href="#" class="" onClick="javascript:imgModal('<?php echo $_GET[
                                'room'
                            ]; ?>')"><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;&nbsp;Location</a>
                            <input type="hidden" value="<?php echo $_GET['room']; ?>" id="roomid">
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                    <h5 class="mb-2 mt-4">Status</h5>
                    <?php if ($result['status'] == 1) {
                        echo '<div class="callout callout-danger">
                            <h5>Unavailable</h5>
                        </div>';
                    } else if($result['status'] == 0) {
                        echo '<div class="callout callout-success">
                            <h5>Available</h5>
                        </div>';
                    } else if($result['status'] == 2) {
                        echo '<div class="callout callout-secondary">
                            <h5>Sensors not installed</h5>
                        </div>';
                    } ?>

                    <div class="row row justify-content-center">

                        <?php
                        if($avg_light != 0 && $avg_sound != 0 && $avg_temp != 0)
                        {
                            if($flag_temp == TRUE)
                            {
                                echo '<div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box shadow">
                                <span class="info-box-icon bg-success"><i class="fas fa-fan"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Temperature sensor</span>
                                    <span class="info-box-number">'.$avg_temp.'</span>
                                </div>
                                </div>
                                </div>';
                            }
                            elseif($flag_temp == FALSE)
                            {
                                echo '<div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box shadow">
                                <div class="overlay dark"></div>
                                <span class="info-box-icon bg-danger"><i class="fas fa-wind"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Temperature sensor</span>
                                    <span class="info-box-number">'.$avg_temp.'</span>
                                </div>
                                </div>
                                </div>';
                            }

                            if($flag_sound == TRUE)
                            {
                                echo '<div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box shadow">
                                <span class="info-box-icon bg-success"><i class="fas fa-volume-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Sound sensor</span>
                                    <span class="info-box-number">'.$avg_sound.'</span>
                                </div>
                                </div>
                            </div>';
                            }
                            elseif($flag_sound == FALSE)
                            {
                                echo '<div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box shadow">
                                <div class="overlay dark"></div>
                                <span class="info-box-icon bg-danger"><i class="fas fa-volume-mute"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Sound sensor</span>
                                    <span class="info-box-number">'.$avg_sound.'</span>
                                </div>
                                </div>
                            </div>';
                            }
                            if($flag_light == TRUE)
                            {
                                echo '<div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box shadow">
                                <span class="info-box-icon bg-success"><i class="fas fa-lightbulb"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Light sensor</span>
                                    <span class="info-box-number">'.$avg_light.'</span>
                                </div>
                                </div>
                            </div>';
                            }
                            elseif($flag_light == FALSE)
                            {
                                echo '<div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box shadow">
                                <div class="overlay dark"></div>
                                <span class="info-box-icon bg-danger"><i class="far fa-lightbulb"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Light sensor</span>
                                    <span class="info-box-number">'.$avg_light.'</span>
                                </div>
                                </div>
                            </div>';
                            }
                            
                        ?>
                        <div class="col-12">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Sensor values</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="barChart" style="height: 400px;"></canvas>
                                    </div>
                                    <?php
                  $sql = "SELECT light,temp,sound,uploadtime FROM sensors WHERE room_id=$room ORDER BY uploadtime DESC LIMIT 10";
                  $query = mysqli_query($connect, $sql);
                  $i = 1;
                  while (
                      $result = mysqli_fetch_array($query, MYSQLI_ASSOC)
                  ) { ?>
                                    <input type="hidden" name="sound<?php echo $i; ?>" id="sound<?php echo $i; ?>"
                                        value="<?php echo $result['sound']; ?>">
                                    <input type="hidden" name="temp<?php echo $i; ?>" id="temp<?php echo $i; ?>"
                                        value="<?php echo $result['temp']; ?>">
                                    <input type="hidden" name="light<?php echo $i; ?>" id="light<?php echo $i; ?>"
                                        value="<?php echo $result['light']; ?>">
                                    <input type="hidden" name="time<?php echo $i; ?>" id="time<?php echo $i; ?>"
                                        value="<?php $time = explode(" ", $result['uploadtime']); echo $time[1]; ?>">
                                    <?php $i += 1;} ?>
                                    <input type="hidden" id="avg_sound" value="<?php echo $avg_sound; ?>">
                                    <input type="hidden" id="avg_temp" value="<?php echo $avg_temp; ?>">
                                    <input type="hidden" id="avg_light" value="<?php echo $avg_light; ?>">
                                </div>
                            </div>
                        </div>

                        <?php 
                }
            } 
                         ?>
                        <div class="col-12">
                            <h5 class="mb-2 mt-4">Equipment</h5>
                        </div>

                        <!-- small card -->
                        <?php
                                $eq = "SELECT COALESCE(sum(amount),0) AS Amount FROM `equipment` WHERE room_id=$room AND type='Projector'";
                                $query_eq = mysqli_query($connect, $eq);
                                if(mysqli_num_rows ($query_eq) == 0) {
                                    echo "";
                                }
                                else
                                {
                                    while (
                                        $result_eq = mysqli_fetch_array($query_eq, MYSQLI_ASSOC)
                                    ) { 
                                
                                ?>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $result_eq['Amount']; ?></h3>
                                    <p>Projector</p>
                                </div>
                                <div class="icon">
                                    <i class="lni lni-blackboard"></i>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>

                        <!-- ./col -->

                        <?php
                                $eq = "SELECT COALESCE(sum(amount),0) AS Amount  FROM `equipment` WHERE room_id=$room AND type='Microphone'";
                                $query_eq = mysqli_query($connect, $eq);
                                if(mysqli_num_rows ($query_eq) == 0 ) {

                                }
                                else
                                {
                                    while (
                                        $result_eq = mysqli_fetch_array($query_eq, MYSQLI_ASSOC)
                                    ) { 
                                
                                ?>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $result_eq['Amount']; ?></h3>
                                    <p>Microphone</p>
                                </div>
                                <div class="icon">
                                    <i class="lni lni-microphone"></i>
                                </div>
                            </div>
                        </div>
                        <?php }}?>

                        <!-- ./col -->
                        <?php
                                $eq = "SELECT COALESCE(sum(amount),0) AS Amount  FROM `equipment` WHERE room_id=$room AND type='Television'";
                                $query_eq = mysqli_query($connect, $eq);
                                if(mysqli_num_rows ($query_eq) == 0) {
                                    echo "";
                                }
                                else
                                {
                                    while (
                                        $result_eq = mysqli_fetch_array($query_eq, MYSQLI_ASSOC)
                                    ) { 
                                
                                ?>
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php echo $result_eq['Amount']; ?></h3>
                                    <p>Televison</p>
                                </div>
                                <div class="icon">
                                    <i class="lni lni-display"></i>
                                </div>
                            </div>
                        </div>
                        <?php }}?>
                        <!-- ./col -->

                        <?php
                                $eq = "SELECT COALESCE(sum(amount),0) AS Amount  FROM `equipment` WHERE room_id=$room AND type='Power outlet'";
                                $query_eq = mysqli_query($connect, $eq);
                                if(mysqli_num_rows ($query_eq) == 0) {
                                    echo "";
                                }
                                else
                                {
                                    while (
                                        $result_eq = mysqli_fetch_array($query_eq, MYSQLI_ASSOC)
                                    ) { 
                                
                                ?>
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?php echo $result_eq['Amount']; ?></h3>
                                    <p>Power Outlet</p>
                                </div>
                                <div class="icon">
                                    <i class="lni lni-plug"></i>
                                </div>
                            </div>
                        </div>
                        <?php }}?>
                        <!-- ./col -->

                    </div>
                    <!-- Table -->
                    <?php 
                    $timetable = "SELECT * FROM `timetable` WHERE room_id=$room";
                    $query_timetable = mysqli_query($connect, $timetable);
                    if(mysqli_num_rows($query_timetable) > 0) //hava table 
                    {
                    ?>
                    <h5 class="mb-2 mt-4">Timetable</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">Course Code</th>
                                                <th style="width: 20%;">Course Name</th>
                                                <th style="width: 7%;">Instructor</th>
                                                <th style="width: 5%;">Day</th>
                                                <th style="width: 5%;">Start TIme</th>
                                                <th style="width: 5%;">End TIme</th>
                                            </tr>
                                        </thead>
                                        <?php
                  
                  while (
                      $result_timetable = mysqli_fetch_array($query_timetable, MYSQLI_ASSOC)
                  ) { ?>

                                        <tbody>
                                            <tr>
                                                <td><?php echo $result_timetable["course_code"] ?></td>
                                                <td><?php echo $result_timetable["course_name"] ?></td>
                                                <td><?php echo $result_timetable["lecturer_name"] ?></td>
                                                <td><?php echo $result_timetable["day"] ?></td>
                                                <td><?php echo $result_timetable["start_time"] ?></td>
                                                <td><?php echo $result_timetable["end_time"] ?></td>
                                            </tr>
                                        </tbody>
                                        <?php 
                    }
                    ?>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <?php 
                    }
                    ?>

                    <!-- Reservation Table -->
                    <?php 
                    $reservetable = "SELECT * FROM `reservation` JOIN users ON users.cmuitaccount_name = reservation.cmuitaccount_name WHERE reservation.room_id = '$room' AND DATE(NOW()) = DATE(reservation.date)";
                    $query_reservetable = mysqli_query($connect, $reservetable);
                    if(mysqli_num_rows($query_reservetable) > 0) //hava table 
                    {
                    ?>
                    <h5 class="mb-2 mt-4">Booking Schedule</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%;">Date</th>
                                                <th style="width: 10%">Start Time</th>
                                                <th style="width: 10%">End Time</th>
                                                <th style="width: 40%;">CMU IT Account</th>
                                            </tr>
                                        </thead>
                                        <?php
                  
                  while (
                      $result_reservetable = mysqli_fetch_array($query_reservetable, MYSQLI_ASSOC)
                  ) { ?>

                                        <tbody>
                                            <tr>
                                                <td><?php echo date("l\, j F Y", strtotime($result_reservetable["date"])) ?>
                                                </td>
                                                <td><?php echo $result_reservetable["start_time"] ?></td>
                                                <td><?php echo $result_reservetable["end_time"] ?></td>
                                                <td><?php echo $result_reservetable['firstname_EN'].' '.$result_reservetable['lastname_EN'] ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php 
                    }
                    ?>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <?php 
                    }
                    ?>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Modal form -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Booking Form</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="booking_form">
                            <div class="form-group">
                                <label for="room_id" class="col-form-label">Room</label>
                                <input type="text" class="form-control" value="<?php echo $room_name; ?>" disabled>
                                <input type="hidden" id="room_id" name="room_id" value="<?php echo $_GET['room']; ?>">
                                <input type="hidden" id="user" name="user"
                                    value="<?php echo $_SESSION['cmuitaccount_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="date" class="col-form-label">Date</label>
                                <input type="text" class="form-control" value="<?php echo date("l\, j F Y"); ?>"
                                    disabled>
                                <input type="hidden" id="date" name="date" value="<?php echo date("Y-m-d D"); ?>">
                            </div>
                            <div class="form-group">
                                <label for="time">Time Duration</label>
                                <select class="form-control" name="time" id="time">
                                    <option value="08:00:01-09:30:00">08:00:00-09:30:00</option>
                                    <option value="09:30:01-11:00:00">09:30:00-11:00:00</option>
                                    <option value="11:00:01-12:30:00">11:00:00-12:30:00</option>
                                    <option value="12:30:01-13:00:00">12:30:00-13:00:00</option>
                                    <option value="13:00:01-14:30:00">13:00:00-14:30:00</option>
                                    <option value="14:30:01-16:00:00">14:30:00-16:00:00</option>
                                    <option value="16:00:01-17:30:00">16:00:00-17:30:00</option>
                                </select>
                                <div class="invalid-feedback" id="feedback"></div>
                            </div>
                            <div class="form-group">
                                <label>Invite to</label>
                                <div class="select2-purple">
                                    <select class="select2" multiple="multiple" name="cobooking[]" id="cobooking" data-placeholder="Select a user" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <?php
                                        $sql = "SELECT cmuitaccount_name,firstname_EN,lastname_EN FROM users WHERE cmuitaccount_name != '" .$_SESSION['cmuitaccount_name']."'";
                                        $query = mysqli_query($connect, $sql);
                                        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                            echo "<option value='".$result['cmuitaccount_name']."'>".$result['firstname_EN']." ".$result['lastname_EN']."</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input id="tag-form-submit" type="submit" class="btn btn-primary" value="Book">
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


        <footer class="main-footer">
            <strong>WangMai:</strong> Classroom Vacancy Checking and Booking System
            <div class="float-right d-none d-sm-inline-block">
                269492-ISNE Project | 2/64
            </div>
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    

    <!-- Modal function -->
    <script> 
    var room = document.getElementById("roomid").value;
    

    document.getElementById("roomid").addEventListener("click", imgModal);

    function imgModal() {
        Swal.fire({
            text: 'Location of ' + room,
            imageUrl: 'https://wangmai.eng.cmu.ac.th/mapping/' + room + '.png',
            imageWidth: 400,
            imageAlt: 'Floor plan',
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonColor: '#3085d6',
            showConfirmButton: false,
            confirmButtonText: 'OK',
            cancelButtonText: 'Open image in new tab <i class="fas fa-external-link-alt"></i>',
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.cancel) {
                window.open('https://wangmai.eng.cmu.ac.th/mapping/' + room + '.png', '_blank');
            }
        })
    }
    </script>
    <script>
    $(function() {

        var sound1 = document.getElementById("sound1").value
        var sound2 = document.getElementById("sound2").value
        var sound3 = document.getElementById("sound3").value
        var sound4 = document.getElementById("sound4").value
        var sound5 = document.getElementById("sound5").value
        var sound6 = document.getElementById("sound6").value
        var sound7 = document.getElementById("sound7").value
        var sound8 = document.getElementById("sound8").value
        var sound9 = document.getElementById("sound9").value
        var sound10 = document.getElementById("sound10").value

        var temp1 = document.getElementById("temp1").value
        var temp2 = document.getElementById("temp2").value
        var temp3 = document.getElementById("temp3").value
        var temp4 = document.getElementById("temp4").value
        var temp5 = document.getElementById("temp5").value
        var temp6 = document.getElementById("temp6").value
        var temp7 = document.getElementById("temp7").value
        var temp8 = document.getElementById("temp8").value
        var temp9 = document.getElementById("temp9").value
        var temp10 = document.getElementById("temp10").value

        var light1 = document.getElementById("light1").value
        var light2 = document.getElementById("light2").value
        var light3 = document.getElementById("light3").value
        var light4 = document.getElementById("light4").value
        var light5 = document.getElementById("light5").value
        var light6 = document.getElementById("light6").value
        var light7 = document.getElementById("light7").value
        var light8 = document.getElementById("light8").value
        var light9 = document.getElementById("light9").value
        var light10 = document.getElementById("light10").value

        var time1 = document.getElementById("time1").value
        var time2 = document.getElementById("time2").value
        var time3 = document.getElementById("time3").value
        var time4 = document.getElementById("time4").value
        var time5 = document.getElementById("time5").value
        var time6 = document.getElementById("time6").value
        var time7 = document.getElementById("time7").value
        var time8 = document.getElementById("time8").value
        var time9 = document.getElementById("time9").value
        var time10 = document.getElementById("time10").value

        var areaChartData = {
            labels: [time10, time9, time8, time7, time6, time5, time4, time3, time2, time1],
            datasets: [{
                    label: 'Decibel levels',
                    backgroundColor: '#19AADE',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#19AADE',
                    pointStrokeColor: 'rgba(0, 63, 92, 1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [sound10, sound9, sound8, sound7, sound6, sound5, sound4, sound3, sound2, sound1]
                },
                {
                    label: 'Light intensity',
                    backgroundColor: '#1DE4BD',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: '#1DE4BD',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [light10, light9, light8, light7, light6 ,light5, light4, light3, light2, light1]
                },
                {
                    label: 'Temperature',
                    backgroundColor: '#142459',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: '#142459',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [temp10, temp9, temp8, temp7, temp6, temp5, temp4, temp3, temp2, temp1]
                },
            ]
        }

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        barChartData.datasets[0] = areaChartData.datasets[2]
        barChartData.datasets[1] = areaChartData.datasets[0]
        barChartData.datasets[2] = areaChartData.datasets[1]

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: true
        }

        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })
    })

    $(document).ready(function() {
        $('#booking_form').submit(function(e) {

e.preventDefault();

$.ajax({
    type: 'POST',
    url: 'bookinsert.php',
    data: $('form').serialize(),
    dataType: 'json',
    success: function(data) {
        if (data.bool == '1') {

            var valid = document.getElementById("time");
            const audio = new Audio('https://wangmai.eng.cmu.ac.th/dist/audio/accomplished-579.mp3');
            audio.play();
            valid.className = "form-control";

            $('#modal-default').modal('hide');
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: 'Booked successful'
            });
            showUnreadNotifications();
            showTimeleftNotifications();

            let book_id = data.book_id;
            let ts = data.transactiontime;
            let user = data.user;
            let cobooking = data.cobooking;

            $.ajax({
                url: 'mail.php',
                type: "POST",
                data: {
                    book_id: book_id,
                    ts: ts,
                    user: user,
                    cobooking: cobooking,
                },
                success: function(data) {
                    if (data) {
                        toastr["info"]("Your confirmation booking e-mail has been sent successfully to <b>"+user+"@cmu.ac.th</b>")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-full-width",
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                }
            });
        } else {
            var invalid = document.getElementById("time");
            invalid.className += " is-invalid";
            document.getElementById("feedback").innerHTML = data.status;
        }
    },
    error: function(req, err) {
        console.log(err)
    }
});
return false;
});
    });
    </script>

    
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- Select2 Option -->
    <script>
    $(function () {
        $('.select2').select2({
            maximumSelectionLength: 3,
            language: {
                maximumSelected: function (e) {
                    var t = "You can only select " + e.maximum + " user";
                    e.maximum != 1 && (t += "s");
                    return t;
                }
            }
        });
        $('select').on('select2:select', function(e) {
            var data = e.params.data;
            //console.log(data.id);
        });
    });
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>