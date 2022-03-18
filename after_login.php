<?php

echo '<h1> Hi, ';
if(array_key_exists('misstd.self.basicinfo', $_SESSION['userdata']))
{
	echo $_SESSION['userdata']['misstd.self.basicinfo']['first_name_EN'];
}
else if(array_key_exists('cmuitaccount.basicinfo', $_SESSION['userdata']))
{
	echo $_SESSION['userdata']['cmuitaccount.basicinfo']['firstname_EN'];


	$_SESSION['userdata'] = $_SESSION['userdata']['cmuitaccount.basicinfo'];
	unset($_SESSION['userdata']['cmuitaccount.basicinfo']);
	//$_SESSION['userdata']['firstname_EN'];

	$_SESSION['userdata']['fullname'] = $_SESSION['userdata']['firstname_EN'] . " " . $_SESSION['userdata']['lastname_EN'];


	//$name =  $_SESSION['userdata']['cmuitaccount.basicinfo']['firstname_EN'];
}
else
{
	echo '????';
}

echo '</h1><br><br>';

echo '<a href="login.php?logout">Logout</a>';


?>