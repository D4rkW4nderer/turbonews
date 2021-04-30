<h1 id="mainTitle">Список новостей:</h1>

<?php 
	require_once 'connection.php';

	$connectTechNewsPage = mysqli_connect($hostname, $username, $password, $database) 
		or die('Error' . mysqli_error($connectTechNewsPage));

	mysqli_set_charset($connectTechNewsPage, 'utf-8');

	$currentUserID = $_SESSION['user-log-id'];

	$userInfoQuery = "SELECT * FROM user_list";
	$userInfoLoad = mysqli_query($connectTechNewsPage, $userInfoQuery)
		or die("Error" . mysqli_error($connectTechNewsPage));

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

	$queryTechNewsLoad = "SELECT * FROM news";
	$loadTechNews = mysqli_query($connectTechNewsPage, $queryTechNewsLoad) 
		or die('Error' . mysqli_error($connectTechNewsPage));

	if($loadTechNews) {
		while($techNews = mysqli_fetch_array($loadTechNews)) {
			if($techNews['news_type'] == "tech") {
				$cutNewsText = $techNews['news_text'];
				$currentNewsID = $techNews['news_id'];

				$cutNewsText = substr($cutNewsText, 0, 660);
				$cutNewsText = rtrim($cutNewsText, "!,.-");
				$cutNewsText = substr($cutNewsText, 0, strrpos($cutNewsText, ' '));
				$readyCurrentNewsText = $cutNewsText . "... " . "<a href='index.php?page=openedNewsPage&NID=$currentNewsID' class='newsMoreBtn'>далее</a>" . " ...";

				if($techNews['news_image'] != NULL) {
					?>

					<div class="newsContainerWithPhoto">
						<div class="newsImage">
							<a href="index.php?page=openedNewsPage&NID=<?php echo $techNews['news_id']; ?>" class="newsMoreBtn">
								<img src="../images/newsPhotos/<?php echo $techNews['news_image']; ?>">
							</a>
						</div>

						<div class="newsTitle">
							<a href="index.php?page=openedNewsPage&NID=<?php echo $techNews['news_id']; ?>" class="newsMoreBtn">
								<?php echo $techNews['news_title']; ?>
							</a>
						</div>

						<div class="newsDate">
							<?php echo $techNews['news_date']; ?>
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
							<a href="index.php?page=openedNewsPage&NID=<?php echo $techNews['news_id']; ?>" class="newsMoreBtn">
								<?php echo $techNews['news_title']; ?>
							</a>
							</div>

							<div class="newsDate">
									<?php echo $techNews['news_date']; ?>
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
	mysqli_close($connectTechNewsPage);
?>