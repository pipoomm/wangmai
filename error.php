<?php
session_start();

var_dump($_SESSION['userdata']);
session_destroy();

?>