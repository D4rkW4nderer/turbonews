<h1 id="userPageTitle">Изменение типа пользователя:</h1>

<?php
	require_once 'connection.php';
	$connectUsrUpdType = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($connectUsrUpdType));

	mysqli_set_charset($connectUsrUpdType, 'utf-8');
	$currentSessionID = $_SESSION['user-log-id'];
	$chekIsAdminKey = 0;
	$userTypeQuery = "SELECT * FROM user_list";
	$userTypeLoad = mysqli_query($connectUsrUpdType, $userTypeQuery) 
		or die("Error" . mysqli_error($connectUsrUpdType));
	if($userTypeLoad) {
		while($loadUserType = mysqli_fetch_array($userTypeLoad)) {
			if($currentSessionID == $loadUserType['user_id'] && $loadUserType['user_type'] == 'admin') {
				$chekIsAdminKey = 1;
			}
		}
	}

	if($chekIsAdminKey == 0) {
		?>
		<h1 id="userListTitle">Страница предназначена только для администрации сайта!</h1>
		<a href="/" id="errorGoMain">Вернуться на главную</a>
		<?php
	} else {
		?>
		<div id="changeUserTypeBar">
		<?php
			$userUpdateID = (int)$_GET['userID'];
			$userInfoQuery = "SELECT * FROM user_list";
			$userInfoLoad = mysqli_query($connectUsrUpdType, $userInfoQuery)
				or die("Error" . mysqli_error($connectUsrUpdType));
			if($userInfoLoad) {
				while($loadUserInfo = mysqli_fetch_array($userInfoLoad)) {
					if($loadUserInfo['user_id'] == $userUpdateID) {
						?>
						<table id="changeUserTypeTable">
							<tr>
								<td><div class="userUpdTypeText">ID пользователя:<div></td>
								<td>
									<div class="userUpdTypeInfo"><?php  echo $loadUserInfo['user_id']; ?></div>
								</td>
							</tr>
							<tr>
								<td><div class="userUpdTypeText">Имя пользователя:</div></td>
								<td>
									<div class="userUpdTypeInfo"><?php  echo $loadUserInfo['user_name']; ?></div>
								</td>
							</tr>
							<tr>
								<td><div class="userUpdTypeText">Дата создания аккаунта:</div></td>
								<td>
									<div class="userUpdTypeInfo"><?php  echo $loadUserInfo['user_date']; ?></div>
								</td>
							</tr>
							<tr>
								<td><div class="userUpdTypeText">Тип пользователя:</div></td>
								<td>
									<div class="userUpdTypeInfo"><?php  echo $loadUserInfo['user_type']; ?></div>
								</td>
							</tr>
						</table>

						<form action="../scripts/changeUserTypeScript.php" method="POST">
							<input type="hidden" name="changeUserTypeID" value="<?php echo $userUpdateID; ?>">
							<select required name="userChangeTypeSelect" id="selectUsrChangeType">
								<option value="none" hidden="">Выберите тип:</option>
								<option value="admin">admin</option>
								<option value="user">user</option>
								<option value="moderator">moderator</option>
								<option value="banned">banned</option>
							</select>
							<span class="requiredField">*</span>

							<input type="submit" name="userChangeTypeButton" id="userChangeTypeBtn" value="Изменить">
						</form>
						<?php
					}
				}
			}
		?>	
		</div>
	<?php
	}

	mysqli_close($connectUsrUpdType);
?>