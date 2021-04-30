<?php 
	function canUploadNewsPhoto($newsChangePhoto) {
		if($newsChangePhoto['name'] == '') {
			return "Вы не выбрали файл!";
		}

		if($newsChangePhoto['size'] > 8388608) {
			return "Файл слишком большой!";
		}

		$newsGetMimeType = explode('.', $newsChangePhoto['name']);

		global $newsMimeTypePhoto;
		$newsMimeTypePhoto = strtolower(end($newsGetMimeType));

		$allowedPhotoTypes = array('jpg', 'png', 'gif', 'jpeg');

		if(!in_array($newsMimeTypePhoto, $allowedPhotoTypes)) {
			return "Недопустимый тип файла!";
		}

		return true;
	}

	function makeUploadNewsPhoto($newsChangePhoto) {
		$prefixNewsPhotoName = date('Ymd_');
		$newNewsPhotoName = $prefixNewsPhotoName.mt_rand(1, 100000).'.'.$GLOBALS['newsMimeTypePhoto'];
		copy($newsChangePhoto['tmp_name'], '../images/newsPhotos/' . $newNewsPhotoName);
		
		return Array('photo-news-name' => $newNewsPhotoName);
	}
?>