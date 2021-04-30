<?php 
	require_once 'connection.php';

	$connectUpdCurNews = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($connectUpdCurNews));

	mysqli_set_charset($connectUpdCurNews, 'utf-8');

	$currentUserID = $_SESSION['user-log-id'];
	$currentNewsID = (int)$_GET['upd-NID'];
	$checkAccessKey = 0;

	$chekUserQuery = "SELECT * FROM user_list";
	$checkUserLoad = mysqli_query($connectUpdCurNews, $chekUserQuery) 
		or die("Error" . mysqli_error($connectUpdCurNews));

	if($checkUserLoad) {
		while($chekUserLaunch = mysqli_fetch_array($checkUserLoad)) {
			if($chekUserLaunch['user_id'] == $currentUserID && ($chekUserLaunch['user_type'] == 'admin' || 
			$chekUserLaunch['user_type'] == 'moderator')) {
				$checkAccessKey = 1;
			}
		}
	}

	if($checkAccessKey == 0) {
		header("Refresh: 0; url=../index.php?page=error");
	} else {
		?>
		<h1 id="updCurNewsTitle">Изменение текущей новости:</h1>
		<?php
		$curNewsInfoQuery = "SELECT * FROM news";
		$curNewsInfoLoad = mysqli_query($connectUpdCurNews, $curNewsInfoQuery)
			or die("Error" . mysqli_error($connectUpdCurNews));
		
		if($curNewsInfoLoad) {
			while($curNewsInfoLaunch = mysqli_fetch_array($curNewsInfoLoad)) {
				if($curNewsInfoLaunch['news_id'] == $currentNewsID) {
					if($curNewsInfoLaunch['news_image'] != NULL) {
						?>
						<div id="updCurNewsInfo">
							<div id="updCurNewsTitle">
								<?php echo $curNewsInfoLaunch['news_title']; ?>
							</div>

							<div id="updCurNewsDate">
								<?php echo $curNewsInfoLaunch['news_date']; ?>
							</div>

							<div id="updCurNewsImage">
								<img src="../images/newsPhotos/<?php echo $curNewsInfoLaunch['news_image']; ?>">
							</div>

							<div id="updCurNewsText">
								<?php echo $curNewsInfoLaunch['news_text']; ?>
							</div>
						</div>
						<?php
					} else {
						?>
						<div id="updCurNewsInfo">
							<div id="updCurNewsTitle">
								<?php echo $curNewsInfoLaunch['news_title']; ?>
							</div>

							<div id="updCurNewsDate">
								<?php echo $curNewsInfoLaunch['news_date']; ?>
							</div>

							<div id="updCurNewsText">
								<?php echo $curNewsInfoLaunch['news_text']; ?>
							</div>
						</div>
						<?php
					}
				}
			}
		}
		?>
		<h1 id="updCurNewsTitle">Ввести изменения текущей новости:</h1>

		<div id="updCurNewsBar">
			<form enctype="multipart/form-data" action="../scripts/updCurNews.php" method="POST">
				<input type="hidden" name="changeNewsInfoID" value="<?php echo $currentNewsID; ?>">
				<table id="updCurNewsTable">
					<tr>
						<td><div class="updCurNewsLable">Заголовок:</div></td>
						<td>
							<input type="text" name="updCurNewsTextBox" class="updCurNewsTB" required placeholder="Введите заголовок новости">
							<span class="requiredField">*</span>
						</td>
					</tr>
					<tr>
						<td><div class="updCurNewsLable">Фото:</div></td>
						<td>
							<input type="file" name="updCurNewsPhoto" id="udpNewsPhotoButton">
						</td>
					</tr>
					<tr>
						<td><div class="updCurNewsLable">Текст новости:</div></td>
						<td>
							<textarea id="updCurNewsTextArea" name="updCurNewsText" rows="7" cols="250" placeholder="Введите текст новости"></textarea>
							<span class="requiredField">*</span>
						</td>
					</tr>
					<tr>
						<td><div class="updCurNewsLable">Тип новости:</div></td>
						<td>
							<select required name="updNewsChooseTypeSelect" id="selectUpdNewsType">
								<option value="none" hidden="">Выберите тип:</option>
								<option value="world">Мировые новости</option>
								<option value="entertainment">Новости развлечений</option>
								<option value="tech">Новости технологий</option>
							</select>
							<span class="requiredField">*</span>
						</td>
					</tr>
				</table>
				<input type="submit" name="updCurNewsButton" id="updCurNewsBtn" value="Изменить">
			</form>
		</div>

		<?php
	}

	mysqli_close($connectUpdCurNews);
?>