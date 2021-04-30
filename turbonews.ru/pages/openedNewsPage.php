<?php 
	require_once 'connection.php';

	$connectOpenedNews = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($connectOpenedNews));

	mysqli_set_charset($connectOpenedNews, 'utf-8');

	$currentUserID = $_SESSION['user-log-id'];
	$currentNewsID = (int)$_GET['NID'];

	$userInfoQuery = "SELECT * FROM user_list";
	$userInfoLoad = mysqli_query($connectOpenedNews, $userInfoQuery) 
		or die("Error" . mysqli_error($connectOpenedNews));

	$checkSuperUserKey = 0;
	$chekCurrentUserTypeValue = '';

	if($userInfoLoad) {
		while($userInfoLaunch = mysqli_fetch_array($userInfoLoad)) {
			if($userInfoLaunch['user_id'] == $currentUserID && ($userInfoLaunch['user_type'] == 'admin' || 
			$userInfoLaunch['user_type'] == 'moderator')) {
				?>
					<a href="index.php?page=updCurrentNews&upd-NID=<?php echo $currentNewsID; ?>" id="updNewsButton">Редактировать новость</a>
					<form action="../scripts/deleteCurNews.php" method="POST">
						<input type="hidden" name="curDelNewsID" value="<?php echo $currentNewsID; ?>">
						<input type="submit" name="delCurNewsBut" class="delCurNewsButton" value="Удалить эту новость">
					</form>
				<?php

				$checkSuperUserKey = 1;
			}
		}
	}

	if($currentUserID != 0) {
		$checkCurrentUserTypeQuery = "SELECT user_type FROM user_list WHERE user_id = '$currentUserID'";
		$checkCurrenUserType = mysqli_query($connectOpenedNews, $checkCurrentUserTypeQuery)
			or die("Error" . mysqli_error($connectOpenedNews));
		$chekCurrentUserTypeValue = mysqli_fetch_assoc($checkCurrenUserType)['user_type'];
	}

	$currentNewsInfoQuery = "SELECT * FROM news";
	$currentNewsInfoLoad = mysqli_query($connectOpenedNews, $currentNewsInfoQuery)	
		or die("Error" . mysqli_error($connectOpenedNews));

	if($currentNewsInfoLoad) {
		while($curNewsInfoLaunch = mysqli_fetch_array($currentNewsInfoLoad)) {
			if($curNewsInfoLaunch['news_id'] == $currentNewsID) {
				if($curNewsInfoLaunch['news_image'] != NULL) {
					?>
					<div class="curNewsContainerWPh">
						<div class="curNewsWPhTitle">
							<?php echo $curNewsInfoLaunch['news_title']; ?>
						</div>

						<div class="curNewsWPhDate">
							<?php echo $curNewsInfoLaunch['news_date']; ?>
						</div>

						<div class="curNewsImage">
							<img src="../images/newsPhotos/<?php echo $curNewsInfoLaunch['news_image']; ?>">
						</div>

						<div class="curNewsWPhText">
							<?php echo $curNewsInfoLaunch['news_text']; ?>
						</div>
					</div>
					<?php
				} else {
					?>
						<div class="curNewsContainer">
							<div class="curNewsTitle">
								<?php echo $curNewsInfoLaunch['news_title']; ?>
							</div>

							<div class="curNewsDate">
								<?php echo $curNewsInfoLaunch['news_date']; ?>
							</div>

							<div class="curNewsText">
								<?php echo $curNewsInfoLaunch['news_text']; ?>
							</div>
						</div>
					<?php
				}
				if($currentUserID != 0 and $chekCurrentUserTypeValue != "banned") {
					?>
					<a href="index.php?page=sendComplaint&ccid=<?php echo $currentNewsID; ?>" class="sendCompButton">Оставить жалобу</a>

					<h1 class="commentTitle">Вы можете оставить комментарий:</h1>

					<div id="commentsBar">
						<form action="../scripts/addNewComment.php" method="POST">
							<input type="hidden" name="curNewsID" value="<?php echo $currentNewsID; ?>">
							<input type="hidden" name="curUserID" value="<?php echo $currentUserID; ?>">
							<table id="commentsBarTable">
								<tr>
									<td><div class="addNewCommentLabel">Введите текст комментария:</div></td>
									<td>
										<textarea rows="7" cols="70" required placeholder="Введите текст комментария" name="commentTextField" id="commentText"></textarea>
										<span class="requiredField">*</span>
									</td>
								</tr>
							</table>
							<input type="submit" name="addNewCommentBut" class="addCommentButton" value="Отправить">
						</form>
					</div>

				<?php
				} elseif($chekCurrentUserTypeValue == "banned") {
					?>
						<h1 class="commentTitleBanned">Вы не можете оставить комментарий!</h1>
					<?php
				} else {
					?>
						<h1 class="commentTitle">Зарегистрируйтесь или войдите для комментирования!</h1>
					<?php
				}
			}
		}
	}

	$checkCommentNewsQuery = "SELECT * FROM comments WHERE comment_news_id = '$currentNewsID'";
	$checkCommentNewsLoad = mysqli_query($connectOpenedNews, $checkCommentNewsQuery)
		or die("Error" . mysqli_error($connectOpenedNews));
	$checkCommentNews = mysqli_num_rows($checkCommentNewsLoad);

	$currentNewsCommentQuery = 
	"SELECT 
			user_list.user_id, user_list.user_name, user_list.user_image, user_list.user_type,
			comments.comment_id, comments.comment_date, comments.comment_text,
			comments.comment_news_id, comments.comment_user_id, comments.comment_type
	FROM 
			user_list, comments
	WHERE
			comments.comment_news_id = '$currentNewsID'";

	$currentNewsCommentLoad = mysqli_query($connectOpenedNews, $currentNewsCommentQuery) 
		or die("Error" . mysqli_error($connectOpenedNews));

	?>
	<h1 class="commentTitle">Комментарии:</h1>
	<?php

	if($currentNewsCommentLoad and $checkCommentNews != 0) {
		while($curNewsCommentLaunch = mysqli_fetch_array($currentNewsCommentLoad)) {
			if($curNewsCommentLaunch['user_id'] == $curNewsCommentLaunch['comment_user_id'] and $curNewsCommentLaunch['comment_type'] != "banned") {
				?>
				<div class="commentsContainer">
					<div class="commentsUserInfoContainer">
						<div class="commentsUserPhoto"><?php 
						if($curNewsCommentLaunch['user_image'] != NULL) {
							?>
							<a href="index.php?page=userPage&user_id=<?php echo $curNewsCommentLaunch['comment_user_id']; ?>">
								<img src="../images/userPhotos/<?php echo $curNewsCommentLaunch['user_image']; ?>">
							</a>
							<?php
						} else {
							?>
								<a href="index.php?page=userPage&user_id=<?php echo $curNewsCommentLaunch['comment_user_id']; ?>">
									<img src="../images/login.svg">
								</a>
							<?php
						} 
						?></div>
						<div class="commentsUserName"><?php echo $curNewsCommentLaunch['user_name']; ?></div>
						<div class="commentsUserType"><?php echo $curNewsCommentLaunch['user_type']; ?></div>
						<div class="curCommentDate"><?php echo $curNewsCommentLaunch['comment_date']; ?></div>
					</div>
					
					<div class="curCommentText"><?php echo $curNewsCommentLaunch['comment_text']; ?></div>
					<?php 
							if($checkSuperUserKey != 0) {
								?>
									<div class="comOptionButtons">
										<form action="../scripts/banCommentScript.php" method="POST">
											<input type="hidden" name="curCommentID" value="<?php echo $curNewsCommentLaunch['comment_id']; ?>">
											<input type="hidden" name="curCommentBanNewsID" value="<?php echo $currentNewsID; ?>">
											<input type="submit" name="banCommentBut" title="Забанить комментарий" class="banCommButton" value="[X]">
										</form>
										<form action="../scripts/banUserScript.php" method="POST">
											<input type="hidden" name="curUserComID" value="<?php echo $curNewsCommentLaunch['comment_user_id']; ?>">
											<input type="hidden" name="curUsrBanNewsID" value="<?php echo $currentNewsID; ?>">
											<input type="submit" name="banUserBut" title="Забанить пользователя" class="banUserButton" value="[X]">
										</form>
									</div>
								<?php
							}
						?>
				</div>

				<?php
			} elseif($curNewsCommentLaunch['comment_type'] == "banned" and $curNewsCommentLaunch['user_id'] == $curNewsCommentLaunch['comment_user_id']) {
				?>
					<div class="commentBanContainer">
						<div class="bannedCommentText">Комментарий был заблокирован</div>
					</div>
				<?php
			}
		}
	} else {
		?>
		<h1 class="commentTitle">Комментариев еще нет :(</h1>
		<?php
	}

	mysqli_close($connectOpenedNews);
?>