<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register / WangMai</title>
    <link rel="icon" href="003-w-2.png" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Google Font: Sarabun -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,300;0,400;0,700;1,400&display=fallback" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js" integrity="sha256-RRb75FFB4bqHpBTVaEua+QNVpKSI5m4HBvQKgY1E8S4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
</head>
<body class="hold-transition register-page" style="background-color: #8EC5FC; background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);">
<div class="register-box">
  <div class="register-logo">
  <p href="index2.html"><span class="font-weight-normal"><b>WangMai:</b> ว่างไหม</span></p>
  </div>

  <div class="card" id="logincard">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="POST">
      <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Last Name" id="lname" name="lname">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" id="email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <div class="col-4">
            <input type="submit" class="btn btn-primary btn-block" name="btnSubmit" value="Register" />
          </div>
        </div>
      </form>

      

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

<?php
    /*
    This command below need to execute on your console log in phpmyadmin naja
    */
    //ALTER TABLE `employees` ADD `empPass` VARCHAR(255) NOT NULL AFTER `employeeNumber`;
    
    include('connect.php');
    if (isset($_POST['btnSubmit']))
    {
        
        $email = htmlentities(mysqli_real_escape_string($connect, $_POST['email']));
        $pass = htmlentities(mysqli_real_escape_string($connect, $_POST['password']));
        
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $a = $_POST['fname'];
        $b = $a .'.'.$_POST['lname'];

        $b = strtolower($b);
        
        $avatar = 'avatar'.rand(1,9).'.png';
        $insert = "INSERT INTO `users` (`cmuitaccount_name`, `cmuitaccount`, `prename_id`, `firstname_EN`, `lastname_EN`, `organization_code`, `organization_name_EN`, `itaccounttype_EN` , `password`, `imageprofile`) VALUES ('$b', '" . $_POST['email'] . "', '', '" . $_POST['fname'] . "', '" . $_POST['lname'] . "', '00', 'Administrator', 'Administrator', '$pass', '$avatar')";
        $run_update = mysqli_query($connect,$insert);
        if($run_update) {
            echo "<script>
								Swal.fire({
   								text: 'Account created!',
                  icon: 'success'
								}).then(function() {
   				 				window.location = 'index.php';
								});
				</script>";
        }
    }
    ?> 
