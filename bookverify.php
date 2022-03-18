<?php
namespace chillerlan\QRCodeExamples;

use chillerlan\QRCode\{QRCode, QROptions};

require_once 'qr2/vendor/autoload.php';

header('Content-Type: text/html; charset=utf-8');

include_once ('connect.php');

if(isset(($_GET['text'])))
{
  $text = $_GET['text'];
  $select_query = "SELECT * FROM `reservation` JOIN room ON reservation.room_id = room.room_id JOIN users ON users.cmuitaccount_name = reservation.cmuitaccount_name WHERE reservation.reserve_id ='$text'";
  $query = mysqli_query($connect, $select_query);

  if(mysqli_num_rows($query) != 0)
  {
    $match = TRUE;
    $cmuitaccount2 = FALSE;
    $cmuitaccount3 = FALSE;
    $cmuitaccount4 = FALSE;
    $cmuaccount2 = FALSE;
    $cmuaccount3 = FALSE;
    $cmuaccount4 = FALSE;

    $today = date("Y-m-d");
    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      $room_id = $result['room_id'];
      $reserve_id = $result['reserve_id'];
      $cmuitaccount = $result['cmuitaccount'];
      $cmuaccount = $result['firstname_EN'].' '.$result['lastname_EN'];

      if(!is_null($result['cmuitaccount_name2']))
      {
        $cmuitaccount2 = $result['cmuitaccount_name2'];
        $select_query = "SELECT cmuitaccount, firstname_EN, lastname_EN FROM `users` WHERE users.cmuitaccount_name = '$cmuitaccount2'";
        $query = mysqli_query($connect, $select_query);
        while ($result2 = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $cmuaccount2 = $result2['firstname_EN'].' '.$result2['lastname_EN'];
            $cmuitaccount2 = $result2['cmuitaccount'];
        }
        if(!is_null($result['cmuitaccount_name3']))
        {
            $cmuitaccount3 = $result['cmuitaccount_name3'];
            $select_query = "SELECT cmuitaccount, firstname_EN, lastname_EN FROM `users` WHERE users.cmuitaccount_name = '$cmuitaccount3'";
            $query = mysqli_query($connect, $select_query);
            while ($result3 = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $cmuaccount3 = ', '.$result3['firstname_EN'].' '.$result3['lastname_EN'];
                $cmuitaccount3 = ','.$result3['cmuitaccount'];
            }
            if(!is_null($result['cmuitaccount_name4']))
            {
                $cmuitaccount4 = $result['cmuitaccount_name4'];
                $select_query = "SELECT cmuitaccount, firstname_EN, lastname_EN FROM `users` WHERE users.cmuitaccount_name = '$cmuitaccount4'";
                $query = mysqli_query($connect, $select_query);
                while ($result4 = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    $cmuaccount4 = ', '.$result4['firstname_EN'].' '.$result4['lastname_EN'];
                    $cmuitaccount4 = ','.$result4['cmuitaccount'];
                }
            }
        }
      }
      $room_nameTH = $result['name_TH'];
      $room_nameEN = $result['name_EN'];
      $date = $result['date'];
      $newDate = date("l\, j F Y", strtotime($date));
      $Month = date("M", strtotime($date));
      $Day = date("j", strtotime($date));
      $start_time= $result['start_time'];
      $end_time= $result['end_time'];
      $approved = $result['approvenoti_check'];
    }
  }
  else
  {
    $match = FALSE;
    $text = 'null';
  }
}
else
{
  $text = '';
  $match = FALSE;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verification / WangMai</title>
    <link rel="icon" href="003-w-2.png" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Google Font: Sarabun -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,300;0,400;0,700;1,400&display=fallback"
        rel="stylesheet">
    <!-- Google Font: Jet Brians Mono -->
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
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
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"
        integrity="sha256-RRb75FFB4bqHpBTVaEua+QNVpKSI5m4HBvQKgY1E8S4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <script src="plugins/toastr/toastr.min.js"></script>
    <!-- Add Event -->
    <link rel="stylesheet" href="dist/css/theme4.css" type="text/css" media="screen" />
    <script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>

</head>
<?php 
session_start();
if(isset($_SESSION['cmuitaccount_name']))
{
    
  include 'include/nav.php';
  include 'include/sidebar.php';
  echo '<body class="hold-transition sidebar-mini layout-fixed">';
}
else
{
  echo '<body class="sidebar-collapse">
    <nav class="main-header navbar navbar-expand navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a href="home.php" class="nav-link">Home</a>
                    </li>
                </ul>
    </nav>';
}
?>

<!-- Site wrapper -->
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><b>WangMai</b>: ว่างไหม</h1>
                        <h6 class="text-nowrap">Classroom Vacancy Checking and Booking System</h6>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="bookhistory.php">Booking</a></li>
                            <li class="breadcrumb-item active">Verification</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <?php if($match == TRUE) { ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="bookverify.php" method="GET">
                            <div class="input-group">
                                <input type="search" class="form-control form-control-lg" name="text"
                                    placeholder="Type your booking code here" value="<?php echo $text; ?>">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Default box -->
            <div class="card-body">
                <div class="row justify-content-center align-items-stretch">
                    <div class="col-12 col-sm-6 align-items-stretch">
                        <div class="card bg-light">
                        <?php 
                            if($approved == 1) {
                                echo 
                                '<div class="ribbon-wrapper ribbon-lg">
                                    <div class="ribbon bg-success">
                                        Approved
                                    </div>
                                </div>';
                            }
                            else if($approved == 0) {
                                echo 
                                '<div class="ribbon-wrapper ribbon-lg">
                                    <div class="ribbon bg-primary">
                                        Pending
                                    </div>
                                </div>';
                            }
                            else {
                                echo 
                                '<div class="ribbon-wrapper ribbon-lg">
                                    <div class="ribbon bg-danger">
                                        Cancelled
                                    </div>
                                </div>';
                            }
                        ?>
                            <div class="card-header text-muted border-bottom-0">
                                <h6><img src="002-w-1-BK.png" width="24" height="24" alt="AdminLTE Logo"
                                        class="brand-image" style="opacity: .8"> Confirmation code</h6>
                            </div>
                            <div class="card-body pt-0">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-7">
                                            <!-- <h4 class="font-weight-bold text-white" style="padding:10px;background: linear-gradient(to left, #bdc3c7, #2c3e50);border-radius: 5px;" ><strong><?php //echo $text; ?></strong></h4> -->
                                            <h3 style="font-family: 'JetBrains Mono';">
                                                <strong><?php echo $reserve_id;?></strong>
                                            </h3>
                                            <p class="text-muted"><b>CMU IT Account: </b> <?php echo $cmuaccount; ?></p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                
                                                <li class="text-nowrap"><span class="fa-li"><i class="lni lni-calendar"></i></span>
                                                    <b>Date:</b>
                                                    <?php echo $newDate; ?>
                                                </li>
                                                <li class="text-nowrap"><span class="fa-li"><i
                                                            class="lni lni-play"></i></span> <b>Start Time:</b>
                                                    <?php echo $start_time; ?></li>
                                                <li class="text-nowrap"><span class="fa-li"><i
                                                            class="lni lni-stop"></i></span> <b>End Time:</b>
                                                    <?php echo $end_time; ?></li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                                <?php echo '<img src="'.(new QRCode)->render("https://wangmai.eng.cmu.ac.th/bookverify.php?text=$text").'" alt="QR" class="text-right img-fluid" />'; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li><span class="fa-li"><i class="lni lni-map-marker"></i></span>
                                                    <b>Room:</b>
                                                    <?php echo $room_id.' - '.$room_nameEN.' | '.$room_nameTH; ?>
                                                </li>
                                                <?php if($cmuaccount2) { ?>
                                                    <li class="text-break"><span class="fa-li"><i class="lni lni-users"></i></span>
                                                            <b>Invite to:</b>
                                                            <?php echo $cmuaccount2.''.$cmuaccount3.''.$cmuaccount4?>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        
                                    </div>
                                </div>
                            </div>
                            <?php if($today == $date) { ?>
                            <div class="card-footer">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <div class="addeventatc" data-styling="none">
                                                <div class="date">
                                                    <span class="mon"><?php echo $Month; ?></span>
                                                    <span class="day"><?php echo $Day; ?></span>
                                                    <div class="bdr1"></div>
                                                    <div class="bdr2"></div>
                                                </div>
                                                <div class="desc">
                                                    <p>
                                                        <strong class="hed">Add to calendar</strong>
                                                        <span class="des">Location: <?php echo $room_id ?><br />When:
                                                            <?php echo date("g:i A", strtotime($start_time)).' - '.date("g:i A", strtotime($end_time));?></span>
                                                    </p>
                                                </div>
                                                <span
                                                    class="start"><?php echo $date.' '.date("g:i a", strtotime($start_time));?></span>
                                                <span
                                                    class="end"><?php echo $date.' '.date("g:i a", strtotime($end_time));?></span>
                                                <span class="timezone">Asia/Bangkok</span>
                                                <span class="title">WangMai Booking</span>
                                                <span class="description">
                                                    Confirmation code: <?php echo $reserve_id; ?>
                                                    <br>URL: https://wangmai.eng.cmu.ac.th/bookverify.php?text=<?php echo $reserve_id; ?></span>
                                                <span
                                                    class="location"><?php echo $room_id.' - '.$room_nameEN.' | '.$room_nameTH; ?></span>
                                                <span class="organizer"><?php echo $cmuaccount; ?></span>
                                                <span class="organizer_email"><?php echo $cmuitaccount; ?></span>
                                                <span class="attendees"><?php echo $cmuitaccount2.''.$cmuitaccount3.''.$cmuitaccount4?></span>
                                                <span class="alarm_reminder">5</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
                <?php } 
      elseif($match == FALSE && $text == 'null') { ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <form action="bookverify.php" method="GET">
                                <div class="input-group">
                                    <input type="search" class="form-control form-control-lg" name="text"
                                        placeholder="Type your booking code here" value="<?php echo $_GET['text']; ?>">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-lg btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center align-items-stretch">
                        <div class="col-12 col-sm-6 align-items-stretch">
                            <center>
                                <h2>Booking code not found!</h2>
                            </center>
                        </div>
                    </div>
                </div>
                <?php } 
      if($text == '') { ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <form action="bookverify.php" method="GET">
                                <div class="input-group">
                                    <input type="search" class="form-control form-control-lg" name="text"
                                        placeholder="Type your booking code here">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-lg btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>ว่างไหม:</strong> ระบบตรวจสอบและจองห้องเรียน
        <div class="float-right d-none d-sm-inline-block">
            269492-ISNE Project | 2/64
        </div>
    </footer>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AddEvent Settings -->
<script type="text/javascript">
window.addeventasync = function() {
    addeventatc.settings({
        appleical: {
            show: true,
            text: "Apple Calendar"
        },
        google: {
            show: true,
            text: "Google"
        },
        office365: {
            show: true,
            text: "Office 365"
        },
        outlook: {
            show: true,
            text: "Outlook"
        },
        outlookcom: {
            show: true,
            text: "Outlook.com <em>(online)</em>"
        },
        yahoo: {
            show: false,
            text: "Yahoo <em>(online)</em>"
        },
    });
};
</script>
</body>

</html>