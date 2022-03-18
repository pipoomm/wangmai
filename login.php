<?php

session_start();

if(isset($_GET['logout']))

{

	session_destroy();

	//echo 'Logged out';

	header('Location: index.php');

	exit();



}

else

{

	if(isset($_SESSION['userdata']))

	{

		//change the page (?)

		var_dump($_SESSION['userdata']);

		//header('Location: index.php');

	}

	else

	{

		if(isset($_GET['login_string']))

		{

			require_once "include/AES_7.php";

			require_once "include/general_function.php";

			require_once "include/cache.class.php";

			require "include/config.php";

			//$file = get_file('user_data_' . $_GET['login_string']);



			

			$c = new Cache();

			$c->setCache($cache_name);

			$c->eraseExpired();

			if($c->isCached('user_data_'.$_GET['login_string']))

			{

				$file = $c->retrieve('user_data_'.$_GET['login_string']);

				$_SESSION['userdata'] = json_decode($file,true);





				$_SESSION['userdata'] = $_SESSION['userdata']['cmuitaccount.basicinfo'];

				unset($_SESSION['userdata']['cmuitaccount.basicinfo']);

				//$_SESSION['userdata']['firstname_EN'];





				$_SESSION['userdata']['fullname'] = $_SESSION['userdata']['firstname_EN'] . " " . $_SESSION['userdata']['lastname_EN'];



				//var_dump($_SESSION['userdata']);





				$c->erase('user_data_'.$_GET['login_string']);

				



				//access data like so =>  $_SESSION['userdata']['misstd.self.basicinfo']['first_name_EN']



				//                 or =>  $_SESSION['userdata']['cmuitaccount.basicinfo']['firstname_EN']



	 			

	 			//delete_file('user_data_' . $_GET['login_string']);



	 			if(array_key_exists('error', $_SESSION['userdata']))

	 			{

	 				header('Location: error.php');

	 			}

	 			else{

					include "connect.php";

					$uname = $_SESSION['userdata']['cmuitaccount_name'];

					$sql = "SELECT * FROM `users` WHERE `cmuitaccount_name` LIKE '$uname'";

					$query = mysqli_query($connect, $sql);

					//$data = mysqli_fetch_assoc($query);

					if(mysqli_num_rows($query) > 0)

					{

						$data = mysqli_fetch_assoc($query);

						$_SESSION['cmuitaccount_name'] = $data['cmuitaccount_name'];

						$_SESSION['cmuitaccount'] = $data['cmuitaccount'];

						$_SESSION['prename_id'] = $data['prename_id'];

						$_SESSION['firstname_EN'] = $data['firstname_EN'];

						$_SESSION['lastname_EN'] = $data['lastname_EN'];

						$_SESSION['organization_code'] = $data['organization_code'];

						$_SESSION['organization_name_EN'] = $data['organization_name_EN'];

						$_SESSION['itaccounttype_EN'] = $data['itaccounttype_EN'];

						$_SESSION['imageprofile'] = $data['imageprofile'];

						$_SESSION['logged_in'] = true; //set you've logged in

						$_SESSION['last_activity'] = time(); //your last activity was now, having logged in.

						$_SESSION['expire_time'] = 5*60; //expire time in seconds: three hours (you must change this)

						header('Location: home.php');

					}

					else

					{

						$avatar = 'avatar'.rand(1,9).'.png';

						$insert = "INSERT INTO `users` (`cmuitaccount_name`, `cmuitaccount`, `prename_id`, `firstname_EN`, `lastname_EN`, `organization_code`, `organization_name_EN`, `itaccounttype_EN` , `password`, `imageprofile`) VALUES ('" . $_SESSION['userdata']['cmuitaccount_name'] . "', '" . $_SESSION['userdata']['cmuitaccount'] . "', '" . $_SESSION['userdata']['prename_id'] . "', '" . $_SESSION['userdata']['firstname_EN'] . "', '" . $_SESSION['userdata']['lastname_EN'] . "', '" . $_SESSION['userdata']['organization_code'] . "', '" . $_SESSION['userdata']['organization_name_EN'] . "', '" . $_SESSION['userdata']['itaccounttype_EN'] . "', NULL, '$avatar')";

						$run_update = mysqli_query($connect,$insert);

						if($run_update)

						{

							$uname = $_SESSION['userdata']['cmuitaccount_name'];

							$sql = "SELECT * FROM `users` WHERE `cmuitaccount_name` LIKE '$uname'";

							$query = mysqli_query($connect, $sql);

							$data = mysqli_fetch_assoc($query);

							$_SESSION['cmuitaccount_name'] = $data['cmuitaccount_name'];

							$_SESSION['cmuitaccount'] = $data['cmuitaccount'];

							$_SESSION['prename_id'] = $data['prename_id'];

							$_SESSION['firstname_EN'] = $data['firstname_EN'];

							$_SESSION['lastname_EN'] = $data['lastname_EN'];

							$_SESSION['organization_code'] = $data['organization_code'];

							$_SESSION['organization_name_EN'] = $data['organization_name_EN'];

							$_SESSION['itaccounttype_EN'] = $data['itaccounttype_EN'];

							$_SESSION['imageprofile'] = $data['imageprofile'];

							$_SESSION['logged_in'] = true; //set you've logged in

							$_SESSION['last_activity'] = time(); //your last activity was now, having logged in.

							$_SESSION['expire_time'] = 5*60; //expire time in seconds: three hours (you must change this)

							header('Location: home.php');

						}

					}

				 }

			}

			else

			{

				//failed - cant find the user data  

				//Token not found

				echo 'Please login before continue1 <br> <a href="https://oauthcmu.hubhoo.com/callback?type=wangmai">Login</a>';

				exit();

			}

		}

		else

		{

			echo 'Please login before continue2 <br> <a href="https://oauthcmu.hubhoo.com/callback?type=wangmai">Login</a>';

			exit();

		}

	}

}















?>