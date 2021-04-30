<?php 
	require_once '../connection.php';

	$banCurCommentConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($banCurCommentConnect));

	mysqli_set_charset($banCurCommentConnect, 'utf-8');

	$curBannedCommentID = (int)$_POST['curCommentID'];
	$curBannedCommentNewsID = (int)$_POST['curCommentBanNewsID'];
	$newCommentType = 'banned';

	$curBanCommentQuery = "UPDATE comments SET comment_type = '$newCommentType' 
						   WHERE comment_id = '$curBannedCommentID'";

	$curBanCommentLaunch = mysqli_query($banCurCommentConnect, $curBanCommentQuery)
		or die("Error" . mysqli_error($banCurCommentConnect));

	if($curBanCommentLaunch) {
		header("Refresh: 0; url=../index.php?page=openedNewsPage&NID=" . $curBannedCommentNewsID);
	} else {
		header("Refresh: 0; url=../index.php?page=openedNewsPage&NID=" . $curBannedCommentNewsID);
	}

	mysqli_close($banCurCommentConnect);
?>