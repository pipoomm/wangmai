<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="WangMai - Eng CMU 30Years building room checker" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="002-w-1.png" />
    <meta property="og:url" content="https://wangmai.eng.cmu.ac.th" />
    <title>Home / WangMai</title>
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
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js" integrity="sha256-RRb75FFB4bqHpBTVaEua+QNVpKSI5m4HBvQKgY1E8S4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css"> 
    <script src="plugins/toastr/toastr.min.js"></script>
</head>
<?php 
include('include/session_check.php');
include('ml_status.php');
date_default_timezone_set('Asia/Bangkok');
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
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">List of Room</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Building Floor</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-right">
                                        <li class="page-item active" id="F4">
                                            <button class="page-link" name="btnF4" id="showDataF4" value="4">4</button>
                                        </li>
                                        <li class="page-item" id="F5">
                                            <button class="page-link" name="btnF5" id="showDataF5" value="5">5</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" id="table-container">

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <span class="description"><i>Last Updated on <?php echo date("j F Y, H:i:s"); ?></i></span>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>

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
            <input type="text" class="form-control" id="room_id_label" value="" disabled>
            <input type="hidden" id="room_id" name="room_id" value="">
            <input type="hidden" id="user" name="user" value="<?php echo $_SESSION['cmuitaccount_name']; ?>">
          </div>
          <div class="form-group">
            <label for="date" class="col-form-label">Date</label>
            <input type="text" class="form-control" value="<?php echo date("l\, j F Y"); ?>" disabled>
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

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>WangMai:</strong> Classroom Vacancy Checking and Booking System
            <div class="float-right d-none d-sm-inline-block">
                269492-ISNE Project | 2/64
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- Floor Table -->
    <script src="plugins/sitejs/floorTable.js"></script>
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
    
    <!-- Modal script -->
    
    <script>
        var room_label = '';

    $(document).on("click", ".open-Dialog", function () {
      var myRoomId = $(this).data('id');
      var myRoomIdArray = myRoomId.split('~');
      room_label = `${myRoomIdArray[0]} - ${myRoomIdArray[1]} | ${myRoomIdArray[2]}`;

      $(".modal-body #room_id").val(myRoomIdArray[0]);
      $(".modal-body #room_id_label").val(room_label);
    });

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
                    $(".modal-body #room_id_label").val(room_label);
                }
                
            },
            error: function(req, err) {
                console.log(err)
            }
        });
        $('#booking_form')[0].reset();
    });
    </script>
</body>

</html>