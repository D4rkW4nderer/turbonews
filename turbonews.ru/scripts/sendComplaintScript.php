<?php
	session_start();

	require_once '../connection.php';

	$sendCompConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($sendCompConnect));

	mysqli_set_charset($sendCompConnect, 'utf-8');

	$curCompNewsID = (int)$_POST['curCPNewsID'];
	$curUserID = $_SESSION['user-log-id'];
	$curCompReason = $_POST['sendCompSelect'];
	$curCompDescription = htmlspecialchars(mysqli_real_escape_string($sendCompConnect, $_POST['textCompDescription']));

	$sendCompQuery = 
		"INSERT INTO complaints(complaint_reason, complaint_description, complaint_user_id, complaint_news_id)
		 VALUES ('$curCompReason', '$curCompDescription', '$curUserID', '$curCompNewsID')";

	$sendCompLaunch = mysqli_query($sendCompConnect, $sendCompQuery)
		or die("Error" . mysqli_error($sendCompConnect));

	if($sendCompLaunch) {
		header("Refresh: 0; url=../index.php?page=openedNewsPage&NID=$curCompNewsID");
	} else {
		header("Refresh: 0; url=../index.php?page=openedNewsPage&NID=$curCompNewsID");
	}

	mysqli_close($sendCompConnect);
?>
	
