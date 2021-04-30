<?php 
	require_once 'connection.php';

	$addNewsConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($addNewsConnect));

	mysqli_set_charset($addNewsConnect, 'utf-8');

	$currentUserID = $_SESSION['user-log-id'];

	$checkUserQuery = "SELECT * FROM user_list";
	$checkUserLoad = mysqli_query($addNewsConnect, $checkUserQuery) 
		or die("Error" . mysqli_error($addNewsConnect));
	$checkUserAccessKey = 0;

	if($checkUserLoad) {
		while($checkUserLaunch = mysqli_fetch_array($checkUserLoad)) {
			if($checkUserLaunch['user_id'] == $currentUserID && ($checkUserLaunch['user_type'] == 'admin' || 
			$checkUserLaunch['user_type'] == 'moderator')) {
				$checkUserAccessKey = 1;
			}
		}
	}

	if($checkUserAccessKey == 0) {
		header("Refresh: 0; url=../index.php?page=error");
	} else {
		?>
		<h1 id="mainTitle">Добавление новой новости:</h1>

		<div id="addNewsBar">
			<form enctype="multipart/form-data" action="../scripts/addNewNewsScript.php" method="POST">
				<table id="addNewsTable">
					<tr>
						<td><div class="addNewsText">Заголовок:</div></td>
						<td>
							<input type="text" name="addNewsTextBox" class="addNewsTB" required placeholder="Введите заголовок новости">
							<span class="requiredField">*</span>
						</td>
					</tr>
					<tr>
						<td><div class="addNewsText">Фото:</div></td></td>
						<td>
							<input type="file" name="chooseNewsPhoto" id="newsPhotoButton">
						</td>
					</tr>
					<tr>
						<td><div class="addNewsText">Текст новости:</div></td>
						<td>
							<textarea id="newsTextArea" name="addNewsText" rows="7" cols="250" placeholder="Введите текст новости"></textarea>
							<span class="requiredField">*</span>
						</td>
					</tr>
					<tr>
						<td><div class="addNewsText">Выберите тип новости:</div></td>
						<td>
							<select required name="newsChooseTypeSelect" id="selectNewsType">
								<option value="none" hidden="">Выберите тип:</option>
								<option value="world">Мировые новости</option>
								<option value="entertainment">Новости развлечений</option>
								<option value="tech">Новости технологий</option>
							</select>
							<span class="requiredField">*</span>
						</td>						
					</tr>
				</table>
				<input type="submit" name="addNewNewsButton" id="addNewNewsBtn" value="Добавить">
			</form>
		</div>

		<?php
	}

	mysqli_close($addNewsConnect);
?>