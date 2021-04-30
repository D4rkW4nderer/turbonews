<?php 
	session_start();

	require_once '../connection.php';

	$connectChangePass = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($connectChangePass));

	mysqli_set_charset($connectChangePass, 'utf-8');

	$currentUserPass = htmlspecialchars(mysqli_real_escape_string($connectChangePass, $_POST['changeUsrPassCurPS']));
	$newUserPass = htmlspecialchars(mysqli_real_escape_string($connectChangePass, $_POST['changeUsrPassNewPS']));
	$repeatNewUserPass = htmlspecialchars(mysqli_real_escape_string($connectChangePass, $_POST['changeUsrPassRepPS']));

	$currentUserPassQuery = "SELECT * FROM user_list";
	$loadCurrentUserPass = mysqli_query($connectChangePass, $currentUserPassQuery);
	$checkPassKey = 0;

	if($loadCurrentUserPass) {
		while($loadCurUserInfo = mysqli_fetch_array($loadCurrentUserPass)) {
			if($_SESSION['user-log-id'] == $loadCurUserInfo['user_id']) {
				if($currentUserPass == $loadCurUserInfo['user_password'] && $newUserPass == $repeatNewUserPass) {
					$newConfirmedUserPass = $repeatNewUserPass;

					$checkPassKey = 1;
				} else {
					header("Refresh: 0; url=../index.php?page=userPage&user_id=" . $_SESSION['user-log-id']);
				}
			}
		}
	}

	$currentUserCPSession = $_SESSION['user-log-id'];
	$changeUserPassword = "UPDATE user_list SET user_password = '$newConfirmedUserPass' WHERE user_id = '$currentUserCPSession'";

	if($checkPassKey == 1) {
		mysqli_query($connectChangePass, $changeUserPassword) or die("Error" . mysqli_error($connectChangePass));
		header("Refresh: 0; url=../index.php?page=userPage&user_id=" . $_SESSION['user-log-id']);
	} else {
		header("Refresh: 0; url=../index.php?page=userPage&user_id=" . $_SESSION['user-log-id']);
	}

	mysqli_close($connectChangePass);
?>