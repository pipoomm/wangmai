<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Equipment - Add / WangMai</title>
    <link rel="icon" href="003-w-2.png" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Google Font: Sarabun -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,300;0,400;0,700;1,400&display=fallback"
        rel="stylesheet">
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
</head>
<?php include('include/session_check.php'); ?>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/nav.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include 'include/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Equipment Add Form</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="equipment-table.php">Equipment</a></li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <!-- form start -->
                                <form action="" method="POST">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Room</label>
                                            <select class="form-control" name="room_id">
                                                <?php
                        $option_sql = "SELECT * FROM `room`";
                        $option_query = mysqli_query($connect, $option_sql);
                        while ($option_result = mysqli_fetch_array($option_query, MYSQLI_ASSOC)) { ?>
                                                <option value="<?php echo $option_result['room_id']; ?>">
                                                    <?php echo $option_result['room_id'].' '.$option_result['name_EN'].' - '.$option_result['name_TH']; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="e_type">Type of equipment</label>
                                            <select class="form-control" name="e_type">
                                                <option value="Projector">Projector</option>
                                                <option value="Microphone">Microphone</option>
                                                <option value="Television">Television</option>
                                                <option value="Power outlet">Power outlet</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="e_amount">Amount of equipment</label>
                                            <input type="number" class="form-control" id="e_amount" name="e_amount"
                                                placeholder="Amount">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success" name="btnSubmit"><i
                                                class="lni lni-save"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->

                            <!-- general form elements -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

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

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
</body>

</html>

<?php
if (isset($_POST['btnSubmit']))
{
  $select_query = "SELECT * FROM equipment WHERE equipment.room_id = '" . $_POST['room_id'] . "' AND equipment.type = '" . $_POST['e_type'] . "'";
  $query = mysqli_query($connect, $select_query);

  if(mysqli_num_rows($query) == 0)
  {
    $insert = "INSERT INTO `equipment` (`equipment_id`, `room_id`, `type`, `amount`) VALUES (NULL, '" . $_POST['room_id'] . "', '" . $_POST['e_type'] . "', '" . $_POST['e_amount'] . "')";
    $run_update = mysqli_query($connect,$insert);
        if($run_update) {
            echo "<script>
								Swal.fire({
   								text: 'Inserted to database successful',
                  icon: 'success'
								}).then(function() {
   				 				window.location = 'equipment-add.php';
								});
				</script>";
        }
  }
  else
  {
    echo "<script>
    Swal.fire({
       text: 'This equipment type is already have in database.',
      icon: 'warning'
    }).then(function() {
        window.location = 'equipment-table.php';
    });
  </script>";
  }
}
?>