<?php 
	require_once 'connection.php';

	$compListConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($compListConnect));

	mysqli_set_charset($compListConnect, 'utf-8');

?>
	<h1 id="userListTitle">Список жалоб:</h1>
<?php
	$currentUserID = $_SESSION['user-log-id'];
	$checkIsAdminKey = 0;
	$checkUserTypeQuery = "SELECT * FROM user_list";
	$checkUserTypeLoad = mysqli_query($compListConnect, $checkUserTypeQuery)
		or die("Error" . mysqli_error($compListConnect));

	while($checkUserTypeLaunch = mysqli_fetch_array($checkUserTypeLoad)) {
		if($currentUserID == $checkUserTypeLaunch['user_id'] and $checkUserTypeLaunch['user_type'] == 'admin') {
			$checkIsAdminKey = 1;
		}
	}

	if ($checkIsAdminKey != 1) {
		?>
			<h1 id="userListTitle">Страница предназначена только для администрации сайта!</h1>
			<a href="/" id="errorGoMain">Вернуться на главную</a>
		<?php
	} else {
		$complaintListQuery = "SELECT * FROM complaints";
		$complaintListLaunch = mysqli_query($compListConnect, $complaintListQuery)
			or die("Error" . mysqli_error($compListConnect));
		?>
		<div id="complaintListTable">
			<table id="compListTable">
				<tr>
					<th>ID жалобы</th>
					<th>Причина жалобы</th>
					<th>Описание жалобы</th>
					<th>ID пользователя</th>
					<th>ID новости</th>
					<th>Дата</th>
					<th>Статус</th>
					<th>Действие</th>
				</tr>
				<?php 
				if($complaintListLaunch) {
					while($complaintListLoad = mysqli_fetch_array($complaintListLaunch)) {
						if($complaintListLoad['complaint_status'] == 'unchecked') {
							$currentCompID = $complaintListLoad['complaint_id'];
							?>
								<tr>
									<td><?php echo $complaintListLoad['complaint_id']; ?></td>
									<td><?php echo $complaintListLoad['complaint_reason']; ?></td>
									<td><?php echo $complaintListLoad['complaint_description']; ?></td>
									<td><?php echo $complaintListLoad['complaint_user_id']; ?></td>
									<td><?php echo $complaintListLoad['complaint_news_id']; ?></td>
									<td><?php echo $complaintListLoad['complaint_date']; ?></td>
									<td><?php echo $complaintListLoad['complaint_status']; ?></td>
									<td>
										<form method="POST" action="../scripts/complaintCheckedScript.php">
											<input type="hidden" name="curCompID" 
												value="<?php echo $currentCompID; ?>">
											<input type="submit" name="checkCompBtn" class="checkCompButton" value="✓">
										</form>
									</td>
								</tr>
							<?php
						} else {
							?>
								<tr class="compChecked">
									<td><?php echo $complaintListLoad['complaint_id']; ?></td>
									<td><?php echo $complaintListLoad['complaint_reason']; ?></td>
									<td><?php echo $complaintListLoad['complaint_description']; ?></td>
									<td><?php echo $complaintListLoad['complaint_user_id']; ?></td>
									<td><?php echo $complaintListLoad['complaint_news_id']; ?></td>
									<td><?php echo $complaintListLoad['complaint_date']; ?></td>
									<td><?php echo $complaintListLoad['complaint_status']; ?></td>
									<td>Проверено</td>
								</tr>
							<?php
						}
					}
				}
				?>
			</table>
		</div>
		<?php
	}

	mysqli_close($compListConnect);
?>