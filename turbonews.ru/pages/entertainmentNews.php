<h1 id="mainTitle">Список новостей:</h1>

<?php 
	require_once 'connection.php';

	$connectEntNewsPage = mysqli_connect($hostname, $username, $password, $database) 
		or die('Error' . mysqli_error($connectEntNewsPage));

	mysqli_set_charset($connectEntNewsPage, 'utf-8');

	$currentUserID = $_SESSION['user-log-id'];

	$userInfoQuery = "SELECT * FROM user_list";
	$userInfoLoad = mysqli_query($connectEntNewsPage, $userInfoQuery)
		or die("Error" . mysqli_error($connectEntNewsPage));

	if($userInfoLoad) {
		while($userInfoLaunch = mysqli_fetch_array($userInfoLoad)) {
			if ($userInfoLaunch['user_id'] == $currentUserID && ($userInfoLaunch['user_type'] == 'admin' || 
			$userInfoLaunch['user_type'] == 'moderator')) {
				?>
					<a href="index.php?page=addNewNews" id="addNewsButton">Добавить новость</a>
				<?php
			}
		}
	}

	$queryEntNewsLoad = "SELECT * FROM news";
	$loadEntNews = mysqli_query($connectEntNewsPage, $queryEntNewsLoad) 
		or die('Error' . mysqli_error($connectEntNewsPage));

	if($loadEntNews) {
		while($entNews = mysqli_fetch_array($loadEntNews)) {
			if($entNews['news_type'] == "entertainment") {
				$cutNewsText = $entNews['news_text'];
				$currentNewsID = $entNews['news_id'];

				$cutNewsText = substr($cutNewsText, 0, 660);
				$cutNewsText = rtrim($cutNewsText, "!,.-");
				$cutNewsText = substr($cutNewsText, 0, strrpos($cutNewsText, ' '));
				$readyCurrentNewsText = $cutNewsText . "... " . "<a href='index.php?page=openedNewsPage&NID=$currentNewsID' class='newsMoreBtn'>далее</a>" . " ...";

				if($entNews['news_image'] != NULL) {
					?>

					<div class="newsContainerWithPhoto">
						<div class="newsImage">
							<a href="index.php?page=openedNewsPage&NID=<?php echo $entNews['news_id']; ?>" class="newsMoreBtn">
								<img src="../images/newsPhotos/<?php echo $entNews['news_image']; ?>">
							</a>
						</div>

						<div class="newsTitle">
							<a href="index.php?page=openedNewsPage&NID=<?php echo $entNews['news_id']; ?>" class="newsMoreBtn">
								<?php echo $entNews['news_title']; ?>
							</a>
						</div>

						<div class="newsDate">
							<?php echo $entNews['news_date']; ?>
						</div>

						<div class="newsText">
							<?php echo $readyCurrentNewsText; ?>
						</div>
					</div>
					<?php
				} else {
					?>
						<div class="newsContainer">
							<div class="newsTitle">
							<a href="index.php?page=openedNewsPage&NID=<?php echo $entNews['news_id']; ?>" class="newsMoreBtn">
								<?php echo $entNews['news_title']; ?>
							</a>
							</div>

							<div class="newsDate">
									<?php echo $entNews['news_date']; ?>
							</div>

							<div class="newsText">
								<?php echo $readyCurrentNewsText; ?>
							</div>
						</div>
					<?php
				}
			}
		}
	}
	mysqli_close($connectEntNewsPage);
?>