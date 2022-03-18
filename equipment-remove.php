<?php
    include('include/session_check.php');
    $code = $_GET['e_id'];

    $delete = "DELETE FROM `equipment` WHERE `equipment`.`equipment_id` = '" . $code . "'";
    if(mysqli_query($connect, $delete)) {
            echo "<script>window.location = 'equipment-table.php'; </script>";
    }
    else {
        echo "<script>alert('Fail to delete. Please try again')</script>";
    }    
?>