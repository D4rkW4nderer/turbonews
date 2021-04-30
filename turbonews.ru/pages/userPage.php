<?php 
	// session_start();
?>
	<h1 id="userPageTitle">Добро пожаловать в личный кабинет!</h1>
	<?php

	require_once 'connection.php';
	$connectUserPage = mysqli_connect($hostname, $username, $password, $database) 
		or die("Errror" . mysqli_error($connectUserPage));

	mysqli_set_charset($connectUserPage, 'utf-8');

	$queryUserInfo = "SELECT * FROM user_list";
	$loadUserPageInfo = mysqli_query($connectUserPage, $queryUserInfo)
		or die("Errror" . mysqli_error($connectUserPage));

	$chekingUserID = (int)$_GET['user_id'];

	if($loadUserPageInfo) {
		while($userPageData = mysqli_fetch_array($loadUserPageInfo)) {
			if($userPageData['user_id'] == $chekingUserID) {
				if($userPageData['user_image'] == '') {
					?>
						<div class="userPagePhoto">
							<img src="../images/login.svg">
						</div>
					<?php
				} else {
					?>
						<div class="userPagePhoto">
							<img src="../images/userPhotos/<?php echo $userPageData['user_image']; ?>">
						</div>
					<?php
				}

				$checkUserID = $userPageData['user_id'];

				?>

				<div id="userPageInfo">
					<h1 id="userPageLogin">
						<?php echo $userPageData['user_name']; ?>
					</h1>

					<div id="userPageType">
						Тип пользователя:
						<?php echo $userPageData['user_type']; ?>
					</div>

					<div id="userPageCreateDate">
						Дата создания аккаунта:
						<?php echo $userPageData['user_date']; ?>
					</div>

					<?php 
					if($_SESSION['user-log-id'] == $userPageData['user_id']) {
						?>
						<form enctype="multipart/form-data" action="../scripts/userChangePhoto.php" method="POST">
							<input type="file" name="chooseUserPhoto" class="userNewPhotoButton">
							<input type="submit" value="Изменить изображение" name="userChangePagePhoto" class="userNewPhotoButton">
						</form>
						<?php
					}
					?>

					<h2 class="userPageSpecTitle">О себе: </h2>
					<div id="userPageAboutUser">
						<?php echo $userPageData['user_info']; ?>
					</div>
				</div>
				
				<?php

				if($_SESSION['user-log-id'] == $userPageData['user_id']) {
					?>
						<h2 id="changeUsrInfo">Введите информацию о себе:</h2>
						<form action="../scripts/updUserInfo.php" method="POST">
							<textarea id="userUpdInfoText" name="userInfoUpdText" rows="3" cols="50" placeholder="Введите вашу информацию"></textarea><br>
							<input type="submit" name="userUpdInfo" id="userUpdInfoButton" value="Изменить">
						</form>
						<form action="../scripts/userLogOutScript.php" method="POST">
							<input type="submit" value="Выйти" name="userLogOutButton" id="userLogOutBut">
						</form>
						<a href="index.php?page=changePass&<?php echo "user_id=" . $_SESSION['user-log-id']; ?>" id="userChangePassword">Изменить пароль</a>
						<form action="../scripts/userSelfDistruction.php" method="POST">
							<input type="submit" name="userSelfDistr" id="userSelfDistrButt" value="Удалить аккаунт">
						</form>
						<?php 
							if($userPageData['user_type'] == 'admin') {
								?>
									<a href="index.php?page=userList" id="userListAdminButton">Список пользователей</a>
									<a href="index.php?page=complaintsList" id="complaintsListAdminButton">Список жалоб</a>
								<?php
							}
						?>
					<?php
				}
			}
		}
	}

	mysqli_close($connectUserPage);
?>