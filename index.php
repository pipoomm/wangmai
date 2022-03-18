<?php
session_start();

if(isset($_SESSION['cmuitaccount_name']))
{
	header('Location: home.php');
}
else
{
	include 'signin.php';
}

?>

