<h1 id="mainTitle">Список новостей:</h1>

<?php 
	require_once 'connection.php';

	$connectWorldNewsPage = mysqli_connect($hostname, $username, $password, $database) 
		or die('Error' . mysqli_error($connectWorldNewsPage));

	mysqli_set_charset($connectWorldNewsPage, 'utf-8');

	$currentUserID = $_SESSION['user-log-id'];

	$userInfoQuery = "SELECT * FROM user_list";
	$userInfoLoad = mysqli_query($connectWorldNewsPage, $userInfoQuery)
		or die("Error" . mysqli_error($connectWorldNewsPage));

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

	$queryWorldNewsLoad = "SELECT * FROM news";
	$loadWorldNews = mysqli_query($connectWorldNewsPage, $queryWorldNewsLoad) 
		or die('Error' . mysqli_error($connectWorldNewsPage));

	if($loadWorldNews) {
		while($worldNews = mysqli_fetch_array($loadWorldNews)) {
			if($worldNews['news_type'] == "world") {
				$cutNewsText = $worldNews['news_text'];
				$currentNewsID = $worldNews['news_id'];

				$cutNewsText = substr($cutNewsText, 0, 660);
				$cutNewsText = rtrim($cutNewsText, "!,.-");
				$cutNewsText = substr($cutNewsText, 0, strrpos($cutNewsText, ' '));
				$readyCurrentNewsText = $cutNewsText . "... " . "<a href='index.php?page=openedNewsPage&NID=$currentNewsID' class='newsMoreBtn'>далее</a>" . " ...";

				if($worldNews['news_image'] != NULL) {
					?>

					<div class="newsContainerWithPhoto">
						<div class="newsImage">
							<a href="index.php?page=openedNewsPage&NID=<?php echo $worldNews['news_id']; ?>" class="newsMoreBtn">
								<img src="../images/newsPhotos/<?php echo $worldNews['news_image']; ?>">
							</a>
						</div>

						<div class="newsTitle">
							<a href="index.php?page=openedNewsPage&NID=<?php echo $worldNews['news_id']; ?>" class="newsMoreBtn">
								<?php echo $worldNews['news_title']; ?>
							</a>
						</div>

						<div class="newsDate">
							<?php echo $worldNews['news_date']; ?>
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
							<a href="index.php?page=openedNewsPage&NID=<?php echo $worldNews['news_id']; ?>" class="newsMoreBtn">
								<?php echo $worldNews['news_title']; ?>
							</a>
							</div>

							<div class="newsDate">
									<?php echo $worldNews['news_date']; ?>
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
	mysqli_close($connectWorldNewsPage);
?>