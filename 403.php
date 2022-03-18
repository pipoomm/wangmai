<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 Access Denied / WangMai</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<?php 
if(!isset($_SESSION))
{
session_start();
include('connect.php');
}
?>

<body class="hold-transition sidebar-mini">
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
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="error-page">
                    <h2 class="headline text-warning"> 403</h2>

                    <div class="error-content">
                        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Access Denied/Forbidden</h3>

                        <p>
                            You do not have permission to access this page. Try <a href="login.php?logout">signed
                                out</a> and sign in with CMU IT Account affiliated with the Faculty of Engineering.
                        </p>

                        <form class="search-form">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" name="submit" class="btn btn-warning"><i
                                            class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.input-group -->
                        </form>
                    </div>
                    <!-- /.error-content -->
                </div>
                <!-- /.error-page -->
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