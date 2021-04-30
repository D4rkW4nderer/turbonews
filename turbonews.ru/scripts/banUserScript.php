<?php 
	require_once '../connection.php';

	$banCurUserConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($banCurUserConnect));

	mysqli_set_charset($banCurUserConnect, 'utf-8');

	$curBannedUserID = (int)$_POST['curUserComID'];
	$curBannedUserNewsID = (int)$_POST['curUsrBanNewsID'];
	$newUserType = 'banned';

	$banCurUserQuery = "UPDATE user_list SET user_type = '$newUserType' WHERE user_id = '$curBannedUserID'";

	$banCurUserLaunch = mysqli_query($banCurUserConnect, $banCurUserQuery)
		or die("Error" . mysqli_error($banCurUserConnect));

	if($banCurUserLaunch) {
		header("Refresh: 0; url=../index.php?page=openedNewsPage&NID=" . $curBannedUserNewsID);
	} else {
		header("Refresh: 0; url=../index.php?page=openedNewsPage&NID=" . $curBannedUserNewsID);
	}

	mysqli_close($banCurUserConnect);
?>