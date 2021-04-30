<?php 
	session_start();

	require_once "../connection.php";

	$userSelfDistrConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($userSelfDistrConnect));

	mysqli_set_charset($userSelfDistrConnect, 'utf-8');

	$checkUserQuery = "SELECT * FROM user_list";
	$checkUserLaunch = mysqli_query($userSelfDistrConnect, $checkUserQuery) 
		or die("Error" . mysqli_error($userSelfDistrConnect));

	$userCurrentSessionID = $_SESSION['user-log-id'];

	$userSelfDistrQuery = "DELETE FROM user_list WHERE user_id = '$userCurrentSessionID'";

	if($checkUserLaunch) {
		while($checkUserLoad = mysqli_fetch_array($checkUserLaunch)) {
			if($_SESSION['user-log-id'] == $checkUserLoad['user_id']) {
				$userLaunchSelfDistr = mysqli_query($userSelfDistrConnect, $userSelfDistrQuery)
					or die("Error" . mysqli_error($userSelfDistrConnect));
			}
		}
	}

	if($userLaunchSelfDistr) {
		$_SESSION = array();
		session_destroy();
		header("Refresh: 0; url=../index.php");
	} else {
		header("Refresh: 0; url=../index.php?page=userPage&user_id=" . $_SESSION['user-log-id']);
	}

	mysqli_close($userSelfDistrConnect);
?>