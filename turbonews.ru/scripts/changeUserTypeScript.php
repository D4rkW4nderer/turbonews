<?php
	session_start();

	require_once '../connection.php';
	$changeUsrTypeConnect = mysqli_connect($hostname, $username, $password, $database) 
		or die("Error" . mysqli_error($changeUsrTypeConnect));

	mysqli_set_charset($changeUsrTypeConnect, 'utf-8');

	$newUserType = $_POST['userChangeTypeSelect'];
	$updatedUserID = (int)$_POST['changeUserTypeID'];

	$changeUserTypeQuery = "UPDATE user_list SET user_type = '$newUserType' WHERE user_id = '$updatedUserID'";
	$changeUserTypeLaunch = mysqli_query($changeUsrTypeConnect, $changeUserTypeQuery)
		or die("Error" . mysqli_error($changeUsrTypeConnect));

	if($changeUserTypeLaunch) {
		header("Refresh: 0; url=../index.php?page=updateUserType&userID=" . $updatedUserID);
	} else {
		header("Refresh: 0; url=../index.php?page=updateUserType&userID=" . $updatedUserID);
	}

	mysqli_close($changeUsrTypeConnect);
?>