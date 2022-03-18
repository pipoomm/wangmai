<script src="plugins/sitejs/notifetch.js" type="text/javascript"></script>
<nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <input type="hidden" id="userID" name="userID" value="<?php echo $_SESSION['cmuitaccount_name'];?>">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="home.php" class="nav-link">Home</a>
        </li>
    </ul>
    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Timeleft Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <span class="material-icons">upcoming</span>
                <span class="badge badge-danger navbar-badge timeleft-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right timeleft timeleft-menu">

            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" onclick='return checkBooking()'>
                <span class="material-icons">history</span>
                <span class="badge badge-primary navbar-badge noti-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right noti noti-menu">

            </div>
        </li>

        <!-- User Panel Dropdown Menu -->
        <li class="nav-item dropdown user user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="dist/img/<?php echo $_SESSION['imageprofile']; ?>"
                    class="user-image img-circle elevation-2 alt=" User Image">
                <span class="hidden-xs">
                    <?php echo $_SESSION['firstname_EN'].' '.$_SESSION['lastname_EN'];?></span>
            </a>
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['cmuitaccount_name']; ?>">
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-dark">
                    <img src="dist/img/<?php echo $_SESSION['imageprofile']; ?>" class="img-circle elevation-2"
                        alt="User Image">
                    <p>
                        <?php echo $_SESSION['cmuitaccount'];?>
                        <small>
                            <?php echo $_SESSION['itaccounttype_EN'].' - '.$_SESSION['organization_name_EN']; ?></small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="float-left">
                        <a href="bookhistory.php" class="btn btn-block btn-outline-dark">Booking History</a>
                    </div>
                    <div class="float-right">
                        <a href="login.php?logout" class="btn btn-block btn-danger">Sign out</a>
                    </div>
                </li>
            </ul>
        </li>

    </ul>
</nav>
