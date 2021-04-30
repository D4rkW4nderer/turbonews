<?php 
	session_start();

	require_once '../connection.php';
	include_once 'functionNewsChangePhoto.php';

	$uploadNewsPhotoKey = 0;

	$newsUploadInfoConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($newsUploadInfoConnect));

	mysqli_set_charset($newsUploadInfoConnect, 'utf-8');

	if(isset($_FILES['chooseNewsPhoto'])) {
		$newNewsTitleWP = htmlspecialchars(mysqli_real_escape_string($newsUploadInfoConnect, $_POST['addNewsTextBox']));
		$newNewsTextWP = htmlspecialchars(mysqli_real_escape_string($newsUploadInfoConnect, $_POST['addNewsText']));
		$newNewsTypeWP = $_POST['newsChooseTypeSelect'];

		$chekAvailable = canUploadNewsPhoto($_FILES['chooseNewsPhoto']);

		if($chekAvailable === true) {
			$resultUploadNewsPhoto = makeUploadNewsPhoto($_FILES['chooseNewsPhoto']);
			$newPhotoNewsName = $resultUploadNewsPhoto['photo-news-name'];

			$newNewsQueryWP = "INSERT INTO news(news_title, news_text, news_image, news_date, news_type) 
				VALUES ('$newNewsTitleWP', '$newNewsTextWP', '$newPhotoNewsName', CURRENT_DATE(), '$newNewsTypeWP')";
			$newNewsLoadWP = mysqli_query($newsUploadInfoConnect, $newNewsQueryWP) 
				or die("Error" . mysqli_error($newsUploadInfoConnect));

			$uploadNewsPhotoKey = 1;
		} else {
			goto next_step;
		}
	} else {
		next_step:

		$newNewsTitle = htmlspecialchars(mysqli_real_escape_string($newsUploadInfoConnect, $_POST['addNewsTextBox']));
		$newNewsText = htmlspecialchars(mysqli_real_escape_string($newsUploadInfoConnect, $_POST['addNewsText']));
		$newNewsType = $_POST['newsChooseTypeSelect'];

		$newNewsQuery = "INSERT INTO news(news_title, news_text, news_date, news_type) 
			VALUES ('$newNewsTitle', '$newNewsText', CURRENT_DATE(), '$newNewsType')";

		$newNewsLoad = mysqli_query($newsUploadInfoConnect, $newNewsQuery) 
			or die("Error" . mysqli_error($newsUploadInfoConnect));

		$uploadNewsPhotoKey = 1;
	}

	if($uploadNewsPhotoKey == 1) {
		header("Refresh: 0; url=../index.php?page=allNews");
	} else {
		header("Refresh: 0; url=../index.php?page=allNews");
	}

	mysqli_close($newsUploadInfoConnect);
?>