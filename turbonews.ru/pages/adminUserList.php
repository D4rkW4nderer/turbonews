<?php
	require_once 'connection.php';

	$adminUserListConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($adminUserListConnect));

	mysqli_set_charset($adminUserListConnect, 'utf-8');
?>
	
	<h1 id="userListTitle">Список пользователей:</h1>

<?php
	$currentSessionUser = $_SESSION['user-log-id'];
	$chekIsAdminKey = 0;
	$userListTypeQuery = "SELECT * FROM user_list";
	$userListTypeLoad = mysqli_query($adminUserListConnect, $userListTypeQuery)
		or die("Error" . mysqli_error($adminUserListConnect));
	if($userListTypeLoad) {
		while($userListLoadType = mysqli_fetch_array($userListTypeLoad)) {
			if($currentSessionUser == $userListLoadType['user_id'] && $userListLoadType['user_type'] == 'admin') {
				$chekIsAdminKey = 1;
			}
		}
	}

	if($chekIsAdminKey !=1) {
		?>
			<h1 id="userListTitle">Страница предназначена только для администрации сайта!</h1>
			<a href="/" id="errorGoMain">Вернуться на главную</a>
		<?php
	} else {
		$userListInfoQuery = "SELECT * FROM user_list";
		$userListInfoLoad = mysqli_query($adminUserListConnect, $userListInfoQuery)
			or die("Error" . mysqli_error($adminUserListConnect));

		?>
		<div id="adminUserListTable">
			<table class="userListTable">
				<tr>
					<th>ID пользователя</th>
					<th>Никнейм пользователя</th>
					<th>Пароль</th>
					<th>Тип пользователя</th>
					<th>Дата создания</th>
					<th>Действие</th>
				</tr>
				<?php
				if($userListInfoLoad) {
					while($userListLoadInfo = mysqli_fetch_array($userListInfoLoad)) {
						?>
							<tr>
								<td><?php echo $userListLoadInfo['user_id']; ?></td>
								<td><?php echo $userListLoadInfo['user_name']; ?></td>
								<td><?php echo $userListLoadInfo['user_password']; ?></td>
								<td><?php echo $userListLoadInfo['user_type']; ?></td>
								<td><?php echo $userListLoadInfo['user_date']; ?></td>
								<td><a href="index.php?page=updateUserType&userID=<?php echo $userListLoadInfo['user_id']; ?>" class="userListActionButton"><img src="../images/upd-but.svg"></a></td>
							</tr>
					<?php
				}
			} ?>
			</table>
		</div>
	<?php
	}

	mysqli_close($adminUserListConnect);
?>