<?php

require_once "include/AES_7.php";
require_once "include/general_function.php";
require_once "include/cache.class.php";
require "include/config.php";
date_default_timezone_set("Asia/Bangkok");

if(isset($_POST['data']))
{
	$c = new Cache();
	$c->setCache($cache_name);


	
	$decrypted_data = decrypt_txt($_POST['data'], $this_decryption_key);
	$decrypted_data = json_decode($decrypted_data,true);
	
	$c->store('user_data_'.$decrypted_data['login_string'],json_encode($decrypted_data['data']),strtotime($token_time_to_destroy));
}
else
{
	//invalid request
}

exit();



?>