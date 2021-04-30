<h1 id="mainTitle">Список новостей:</h1>


<?php 
	require_once 'connection.php';

	$connectMainPage = mysqli_connect($hostname, $username, $password, $database) 
		or die('Error' . mysqli_error($connectMainPage));

	mysqli_set_charset($connectMainPage, 'utf-8');

	$currentUserID = $_SESSION['user-log-id'];

	$userInfoQuery = "SELECT * FROM user_list";
	$userInfoLoad = mysqli_query($connectMainPage, $userInfoQuery)
		or die("Error" . mysqli_error($connectMainPage));

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

	$queryMainLoad = "SELECT * FROM news ORDER BY news_date DESC";
	$loadMainPageNews = mysqli_query($connectMainPage, $queryMainLoad) 
		or die('Error' . mysqli_error($connectMainPage));

	if($loadMainPageNews) {
		while($mainPageNews = mysqli_fetch_array($loadMainPageNews)) {
			$cutNewsText = $mainPageNews['news_text'];
			$currentNewsID = $mainPageNews['news_id'];

			$cutNewsText = substr($cutNewsText, 0, 660);
			$cutNewsText = rtrim($cutNewsText, "!,.-");
			$cutNewsText = substr($cutNewsText, 0, strrpos($cutNewsText, ' '));
			$readyCurrentNewsText = $cutNewsText . "... " . "<a href='index.php?page=openedNewsPage&NID=$currentNewsID' class='newsMoreBtn'>далее</a>" . " ...";

			if($mainPageNews['news_image'] != NULL) {
				?>

				<div class="newsContainerWithPhoto">
					<div class="newsImage">
						<a href="index.php?page=openedNewsPage&NID=<?php echo $mainPageNews['news_id']; ?>" class="newsMoreBtn">
							<img src="../images/newsPhotos/<?php echo $mainPageNews['news_image']; ?>">
						</a>
					</div>

					<div class="newsTitle">
						<a href="index.php?page=openedNewsPage&NID=<?php echo $mainPageNews['news_id']; ?>" class="newsMoreBtn">
							<?php echo $mainPageNews['news_title']; ?>
						</a>
					</div>

					<div class="newsDate">
						<?php echo $mainPageNews['news_date']; ?>
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
						<a href="index.php?page=openedNewsPage&NID=<?php echo $mainPageNews['news_id']; ?>" class="newsMoreBtn">
							<?php echo $mainPageNews['news_title']; ?>
						</a>
						</div>

						<div class="newsDate">
							<?php echo $mainPageNews['news_date']; ?>
						</div>

						<div class="newsText">
							<?php echo $readyCurrentNewsText; ?>
						</div>
					</div>
				<?php
			}
		}
	}

mysqli_close($connectMainPage);
?>