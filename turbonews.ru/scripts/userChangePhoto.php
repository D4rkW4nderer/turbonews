<?php
	session_start();

	require_once '../connection.php';
	include_once 'functionsUserChangePhoto.php';

	$uploadPhotoKey = 0;

	$userChangePhotoConnect = mysqli_connect($hostname, $username, $password, $database) 
		or die("Error" . mysqli_error($userChangePhotoConnect));

	mysqli_set_charset($userChangePhotoConnect, 'utf-8');

	$userPhotoInfoQuery = "SELECT * FROM user_list";
	$userPhotoInfo = mysqli_query($userChangePhotoConnect, $userPhotoInfoQuery)
		or die("Error" . mysqli_error($userChangePhotoConnect));
	$currentSessionID = $_SESSION['user-log-id'];

	$dirPhoto = "../images/userPhotos";
	$dirPhotoOpen = opendir($dirPhoto);

	if($userPhotoInfo) {
		while($loadUserPhotoInfo = mysqli_fetch_array($userPhotoInfo)) {
			if ($loadUserPhotoInfo['user_id'] == $currentSessionID) {
				while($photoName = readdir($dirPhotoOpen)) {
					if($loadUserPhotoInfo['user_image'] == $photoName) {
						unlink($dirPhoto."/".$photoName);
					}
				}
			}
		}
	}

	closedir($dirPhotoOpen);

	if(isset($_FILES['chooseUserPhoto'])) {
		$checkAvailable = canUploadUserPhoto($_FILES['chooseUserPhoto']);

		if($checkAvailable === true) {
			$resultUploadPhoto = makeUploadUserPhoto($_FILES['chooseUserPhoto']);
			$uploadPhotoKey = 1;
			$newPhotoFileName = $resultUploadPhoto['photo-name'];
			header("Refresh: 0; url=../index.php?page=userPage&user_id=" . $_SESSION['user-log-id']);
		} else {
			header("Refresh: 0; url=../index.php?page=userPage&user_id=" . $_SESSION['user-log-id']);
		}
	}

	$uploadPhotoQuery = "UPDATE user_list SET user_image = '$newPhotoFileName' WHERE user_id = '$currentSessionID'";

	if($uploadPhotoKey == 1) {
		$uploadNewUserPhoto = mysqli_query($userChangePhotoConnect, $uploadPhotoQuery)
			or die("Error" . mysqli_error($userChangePhotoConnect));
	} else {
		header("Refresh: 0; url=../index.php?page=userPage&user_id=" . $_SESSION['user-log-id']);
	}

	mysqli_close($userChangePhotoConnect);
?>