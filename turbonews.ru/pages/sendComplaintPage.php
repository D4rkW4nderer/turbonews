<?php
	require_once 'connection.php';

	$sendComplaintConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($sendComplaintConnect));

	mysqli_set_charset($sendComplaintConnect, 'utf-8');

	$currentNewsID = $_GET['ccid'];
	$currentUserID = $_SESSION['user-log-id'];

	$checkNewsTitleQuery = "SELECT * FROM news";
	$checkNewsTitleLaunch = mysqli_query($sendComplaintConnect, $checkNewsTitleQuery)
		or die("Error" . mysqli_error($sendComplaintConnect));

	$currentNewsTitle = '';

	while($checkNewsTitleLoad = mysqli_fetch_array($checkNewsTitleLaunch)) {
		if($currentNewsID == $checkNewsTitleLoad['news_id']) {
			$currentNewsTitle = $checkNewsTitleLoad['news_title'];
		}
	}

	?>
		<h1 class="curNewsTitle">Отправка жалобы на новость "<?php echo $currentNewsTitle; ?>"</h1>

		<div id="sendComplaintBar">
			<form action="../scripts/sendComplaintScript.php" method="POST">
				<input type="hidden" name="curCPNewsID" value="<?php echo $currentNewsID; ?>">
				<table id="sendComplaintTable">
					<tr>
						<td><div class="sendCompText">Причина:</div></td>
						<td>
							<select required name="sendCompSelect" id="selectCompReason">
								<option value="none" hidden="">Выберите причину:</option>
								<option value="опечатки">Опечатки</option>
								<option value="фейк">Недостоверная новость</option>
								<option value="запрещенное">Неприемлемое содержание</option>
								<option value="другое">Другое (указать в описании)</option>
							</select>
							<span class="requiredField">*</span>
						</td>
					</tr>
					<tr>
						<td><div class="sendCompText">Описание жалобы:</div></td>
						<td>
							<textarea id="complaintsTextArea" name="textCompDescription" rows="7" cols="100" placeholder="Введите описание жалобы"></textarea>
							<span class="requiredField">*</span>
						</td>
					</tr>
				</table>
				<input type="submit" name="sendCompBtn" id="sendCompButton" value="Отправить">
			</form>
		</div>
	<?

	mysqli_close($sendComplaintConnect);
 ?>