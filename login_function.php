<?php
	include "connect.php";
	if (isset($_POST['login'])) {
		$uname = htmlentities(mysqli_real_escape_string($connect, $_POST['uname']));
		$pass = htmlentities(mysqli_real_escape_string($connect, $_POST['password']));
		$sql = "SELECT * FROM `users` WHERE `cmuitaccount_name` LIKE '$uname'";
		$query = mysqli_query($connect, $sql);
		$data = mysqli_fetch_assoc($query);
		
		if (isset($data['password']) && password_verify($pass, $data['password'])) 
		{
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
			//echo "<script> window.location = 'home.php'; </script>";
		header('Location: home.php');
		}
		else {
			//echo "<script>alert('Employee ID or password is incorrect')</script>";
			echo "<script>
            $(document).ready(function() {
                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Sign In Error',
                        text: 'Sorry, your username or password is incorrect. Please try again.',
                        allowOutsideClick: false
                      }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php';
                        }
                      });
                }, 1);
            });
            </script>";
		}
	}
?>