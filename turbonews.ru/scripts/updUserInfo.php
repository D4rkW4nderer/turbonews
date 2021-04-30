<?php 
	session_start();

	require_once '../connection.php';
	$updUserInfoConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($updUserInfoConnect));

	mysqli_set_charset($updUserInfoConnect, 'utf-8');

	$newUserInfo = htmlspecialchars(mysqli_real_escape_string($updUserInfoConnect, $_POST['userInfoUpdText']));

	$currentUserSession = $_SESSION['user-log-id'];

	$updUserInfoQuery = "UPDATE user_list SET user_info = '$newUserInfo' WHERE user_id = '$currentUserSession'";

	$updUserInfoLoad = mysqli_query($updUserInfoConnect, $updUserInfoQuery)
		or die("Error" . mysqli_error($updUserInfoConnect));

	if($updUserInfoLoad) {
		header("Refresh: 0; url=../index.php?page=userPage&user_id=" . $currentUserSession);
	} else {
		header("Refresh: 0; url=../index.php?page=userPage&user_id=" . $currentUserSession);
	}

	mysqli_close($updUserInfoConnect);
?>