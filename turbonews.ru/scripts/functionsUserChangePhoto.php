<?php 
	function canUploadUserPhoto($userPagePhoto) {
		if($userPagePhoto['name'] == '') {
			return "Вы не выбрали файл!";
		}

		if($userPagePhoto['size'] > 8388608) {
			return "Файл слишком большой!";
		}

		$getMimeType = explode('.', $userPagePhoto['name']);

		global $mimeTypePhoto;
		$mimeTypePhoto = strtolower(end($getMimeType));

		$allowedTypes = array('jpg', 'png', 'gif', 'jpeg');

		if(!in_array($mimeTypePhoto, $allowedTypes)) {
			return "Недопустимый тип файла!";
		}

		return true;
	}

	function makeUploadUserPhoto($userPagePhoto) {
		$prefixUserPhotoName = date('Ymd_');
		$newUserPhotoName = $prefixUserPhotoName.mt_rand(1, 100000).'.'.$GLOBALS['mimeTypePhoto'];
		copy($userPagePhoto['tmp_name'], '../images/userPhotos/' . $newUserPhotoName);
		return Array('photo-name' => $newUserPhotoName);
	}
?>