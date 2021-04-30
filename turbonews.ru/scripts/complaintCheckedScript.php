<?php 
	require_once '../connection.php';

	$checkCompConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($checkCompConnect));

	mysqli_set_charset($checkCompConnect, 'utf-8');

	$curComplaintID = (int)$_POST['curCompID'];
	$newCompValue = 'checked';

	$curCompCheckedQuery = "UPDATE complaints SET complaint_status = '$newCompValue' 
							WHERE complaint_id = '$curComplaintID'";

	$curCompCheckedLaunch = mysqli_query($checkCompConnect, $curCompCheckedQuery)
		or die("Error" . mysqli_error($checkCompConnect));

	if($curCompCheckedLaunch) {
		header("Refresh: 0; url=../index.php?page=complaintsList");
	} else {
		header("Refresh: 0; url=../index.php?page=complaintsList");
	}

	mysqli_close($checkCompConnect);
?>