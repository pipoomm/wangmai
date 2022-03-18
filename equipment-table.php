<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Equipment / WangMai</title>
    <link rel="icon" href="003-w-2.png" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Google Font: Sarabun -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,300;0,400;0,700;1,400&display=fallback" rel="stylesheet">
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
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css"> 
    <script src="plugins/toastr/toastr.min.js"></script>
</head>
<?php include('include/session_check.php'); ?>
<body class="hold-transition sidebar-mini" style="height: auto;">
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
            <h1>List of equipment</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <?php if($_SESSION['organization_code'] == '00') { ?>
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Room</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th style="width: 12%;"></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $equip = "SELECT * FROM `equipment` JOIN `room` ON equipment.room_id = room.room_id ORDER BY room.room_id";
                  $query_equip = mysqli_query($connect, $equip);
                  while (
                      $result_equip = mysqli_fetch_array($query_equip, MYSQLI_ASSOC)
                  ) { ?>
                  <tr>
                    <td><?php echo $result_equip['room_id'].' '.$result_equip['name_EN'].' - '.$result_equip['name_TH']; ?></td>
                    <td><?php echo $result_equip['type']; ?></td>
                    <td><?php echo $result_equip['amount']; ?></td>
                    <td class="text-center py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="equipment-update.php?e_id=<?php echo $result_equip['equipment_id']; ?>" class="btn btn-info"><i class="lni lni-pencil"></i> Edit</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default" data-href="equipment-remove.php?e_id=<?php echo $result_equip['equipment_id']; ?>"><i class="fas fa-trash-alt"></i> Delete</button>
                      </div>
                    </td>
                  </tr>
                  <?php 
                    }
                  ?>
                   </tbody>
                </table>
              </div>
              
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a class="btn btn-info float-right" href="equipment-add.php"><i class="fas fa-plus"></i> Add equipment</a>
              </div>
            </div>
            <?php } else { ?>
              <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Room</th>
                    <th>Type</th>
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $equip = "SELECT * FROM `equipment` JOIN `room` ON equipment.room_id = room.room_id ORDER BY room.room_id";
                  $query_equip = mysqli_query($connect, $equip);
                  while (
                      $result_equip = mysqli_fetch_array($query_equip, MYSQLI_ASSOC)
                  ) { ?>
                  <tr>
                    <td><?php echo $result_equip['room_id'].' '.$result_equip['name_EN'].' - '.$result_equip['name_TH']; ?></td>
                    <td><?php echo $result_equip['type']; ?></td>
                    <td><?php echo $result_equip['amount']; ?></td>
                  </tr>
                 
                  <?php 
                    }
                  ?>
                   </tbody>
                  
                </table>
              </div>
            </div>
            <?php } ?>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal delete -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirm Delete</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <p>You are about to delete one track, this procedure is irreversible.</p>
            <p>Do you want to proceed?</p>
            <p class="delete-url"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input id="tag-delete" type="submit" class="btn btn-danger btn-ok" value="Delete">
            </div>
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

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<!-- Modal script -->
<script>
$('#modal-default').on('show.bs.modal', function(e) {
  $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  $('.delete-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
  let href = $(this).find('.btn-ok').attr('href');
    $(document).on("click", "#tag-delete", function () {
      window.location = href;
    });
});
</script>

</body>
</html>
