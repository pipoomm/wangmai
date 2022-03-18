<?php
function current_url()
{
    $url = strtok($_SERVER["REQUEST_URI"], '?');
    $validURL = str_replace("/", "", $url);
    return $validURL;
}
?>
<aside class="main-sidebar elevation-4 sidebar-dark-purple">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link <?php if($_SESSION['organization_code'] != '06' && $_SESSION['organization_code'] != '00') { echo 'disabled';}?>">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">WangMai:</span>
        <span class="brand-text text-md" style="font-family: 'Noto Sans Thai Light';"> ว่างไหม</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="home.php" class="nav-link <?php if(current_url() == 'home.php') { echo "active";} if($_SESSION['organization_code'] != '06' && $_SESSION['organization_code'] != '00') { echo 'disabled';}?>">
                        <i class="nav-icon material-icons">meeting_room</i>
                        <p>
                            List of room
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="equipment-table.php"
                        class="nav-link <?php if(current_url() == 'equipment-table.php' || current_url() == 'equipment-add.php') { echo "active";} if($_SESSION['organization_code'] != '06' && $_SESSION['organization_code'] != '00') { echo 'disabled';} ?>">
                        <i class="nav-icon lni lni-list"></i>
                        <p>
                            Equipment
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="bookverify.php"
                        class="nav-link <?php if(current_url() == 'bookverify.php') { echo "active";}?>">
                        <i class="nav-icon lni lni-ticket-alt"></i>
                        <p>
                            Booking Verify
                        </p>
                    </a>
                </li>
                <?php if($_SESSION['organization_code'] == '00') { ?>
                <li class="nav-header">ADMIN PANEL</li>
                <li class="nav-item">
                    <a href="admin_zone/phpmyadmin" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            phpMyAdmin
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="register.php" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Register
                        </p>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>