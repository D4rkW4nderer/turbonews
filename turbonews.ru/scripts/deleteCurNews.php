<?php
	require_once '../connection.php';

	$deleteCurNewsConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($deleteCurNewsConnect));

	mysqli_set_charset($deleteCurNewsConnect, 'utf-8');

	$deletedNewsID = (int)$_POST['curDelNewsID'];

	$deleteCurNewsQuery = "DELETE FROM news WHERE news_id = '$deletedNewsID'";

	$deleteCurNewsLaunch = mysqli_query($deleteCurNewsConnect, $deleteCurNewsQuery)
		or die("Error" . mysqli_error($deleteCurNewsConnect));

	if($deleteCurNewsLaunch) {
		header("Refresh: 0; url=../index.php?page=allNews");
	} else {
		header("Refresh: 0; url=../index.php?page=openedNewsPage&NID=6" . $deletedNewsID);
	}

	mysqli_close($deleteCurNewsConnect);
?>