<?php 
	require_once '../connection.php';

	$userRegistrationConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($userRegistrationConnect));

	mysqli_set_charset($userRegistrationConnect, 'utf-8');

	$newUserLogin = htmlspecialchars(mysqli_real_escape_string($userRegistrationConnect, $_POST['userRegLoginTB']));
	$newUserPassword = htmlspecialchars(mysqli_real_escape_string($userRegistrationConnect, $_POST['userRegPassTB']));
	$newUserRepeatPassword = htmlspecialchars(mysqli_real_escape_string($userRegistrationConnect, $_POST['userRegRepeatPassTB']));

	if($newUserPassword == $newUserRepeatPassword) {
		$newUserGreatPassword = $newUserRepeatPassword;
	} else {
		header("Refresh: 0; url=../index.php?page=registrationPage");
		exit;
	}

	$checkUserNameQuery = mysqli_query($userRegistrationConnect, "SELECT * FROM user_list WHERE user_name='$newUserLogin'");
	$checkUserNameRows = mysqli_num_rows($checkUserNameQuery);

	$newUserDefaultType = "user";

	$regNewUserInsert = "INSERT INTO user_list(user_name, user_password, user_type, user_date) VALUES ('$newUserLogin', '$newUserGreatPassword', '$newUserDefaultType', CURRENT_DATE())";

	$checkRegistrationQuery = 0;

	if ($checkUserNameRows == 0) {
		$regNewUserInsertQuery = mysqli_query($userRegistrationConnect, $regNewUserInsert) 
 			or die("Error" . mysql_error($userRegistrationConnect));
 		$checkRegistrationQuery = 1;
	}

	if ($checkRegistrationQuery == 1) {
		header("Refresh: 0; url=../index.php?page=succesReg");
	} else {
		header("Refresh: 0; url=../index.php?page=registrationPage");
	}

	mysqli_close($userRegistrationConnect);
?>