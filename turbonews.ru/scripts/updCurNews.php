<?php 
	session_start();

	require_once '../connection.php';
	include_once '../functionNewsChangePhoto.php';

	$currentNewsID = $_GET['currentNewsID'];
	$curentNewsTitle = htmlspecialchars(mysqli_real_escape_string($connectUpdNews, $_POST['updCurNewsTextBox']));
	$currentNewsText = htmlspecialchars(mysqli_real_escape_string($connectUpdNews, $_POST['updCurNewsText']));
	$currentNewsType = $_POST['updNewsChooseTypeSelect'];

	$connectUpdNews = mysqli_connect($hostname, $username, $password, $database) 
		or die("Error" . mysqli_error($connectUpdNews));
	mysqli_set_charset($connectUpdNews, 'utf-8');

	if(isset($_FILE['updCurNewsPhoto'])) {
		$checkCurNewsPhotoQuery = "SELECT * FROM news";
		$checkCurNewsPhotoLoad = mysqli_query($connectUpdNews, $checkCurNewsPhotoQuery)
			or die("Error" . mysqli_error($connectUpdNews));

		$curDirPhoto = "../images/newsPhotos";
		$curDirPhotoOpen = opendir($curDirPhoto);

		if($checkCurNewsPhotoLoad) {
			while($chekCurNewsPhotoLaunch = mysqli_fetch_array($checkCurNewsPhotoLoad)) {
				if($chekCurNewsPhotoLaunch['news_id'] == $currentNewsID && $chekCurNewsPhotoLaunch['news_image'] != NULL) {
					while($curPhotoName = readdir($curDirPhotoOpen)) {
						if($chekCurNewsPhotoLaunch['news_image'] == $curPhotoName) {
							unlink($curDirPhoto."/".$curPhotoName);
						}
					}
				}
			}
		}

		closedir($curDirPhotoOpen);

		$chekAvailable

	} else {

	}

	mysqli_close($connectUpdNews);
?>