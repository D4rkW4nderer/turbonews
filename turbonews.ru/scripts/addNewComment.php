<?php 
	require_once '../connection.php';

	$addNewCommentConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($addNewCommentConnect));

	mysqli_set_charset($addNewCommentConnect, 'utf-8');

	$currentUserID = (int)$_POST['curUserID'];
	$currentNewsID = (int)$_POST['curNewsID'];
	$newCommentText = $_POST['commentTextField'];

	$addNewCommentQuery = "INSERT INTO comments(comment_text, comment_news_id, comment_user_id) 
		VALUES ('$newCommentText', '$currentNewsID', '$currentUserID')";

	$addNewCommentLoad = mysqli_query($addNewCommentConnect, $addNewCommentQuery)
		or die("Error" . mysqli_error($addNewCommentConnect));

	if($addNewCommentLoad) {
		header("Refresh: 0; url=../index.php?openedNewsPage&NID='$currentNewsID'");
	}

	mysqli_close($addNewCommentConnect);
?>