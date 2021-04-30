<?php 
	session_start();
	if(!isset($_SESSION['user-log-id'])) $_SESSION['user-log-id']=0;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>TurboNews</title>
	<link rel="stylesheet" type="text/css" href="styles/site.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
</head>
<body>
	<!------------- Шапка сайта начало ---------->

	<?php 
		require_once'connection.php';
		$connectIndexPage = mysqli_connect($hostname, $username, $password, $database) 
			or die("Error" . mysqli_error($connectIndexPage));
	?>

	<header>
		<div id="inHeader">
			<div id="siteLogo">
				<a href="/"><img id="siteLogoButton" src="images/right-arrows.svg">
					<div id="logoTitle">TurboNews</div>
				</a>
			</div>
			<ul id="headerNavigation">
				<li><a href="/">Главная</a></li>
				<li>
					<a href="index.php?page=allNews">Новости</a>
					<ul class="submenu">
						<li><a href="index.php?page=worldNews">Мировые новости</a></li>
						<li><a href="index.php?page=entertainmentNews">Новости развлечений</a></li>
						<li><a href="index.php?page=techNews">Новости технологий</a></li>
					</ul>
				</li>
				<li><a href="index.php?page=about">О нас</a></li>
				<li>
					<?php if($_SESSION['user-log-id'] == 0) { 
						?>
						<a href="index.php?page=loginPage"><img class="userPageButton" src="images/login.svg"></a><?php
					} else {
						?>
						<a href="index.php?page=userPage&<?php echo "user_id=" . $_SESSION['user-log-id']; ?>">
							<img class="userPageButton" src="images/login.svg">
						</a>
						<?php
					}
					?>
				</li>
			</ul>
		</div>
	</header>

	<!--------------------- КОНЕЦ ШАПКИ САЙТА ---------------------->

	<!--------------------- КОНТЕНТ САЙТА НАЧАЛО ---------------------->

	<?php 
		$page = $_GET['page'];
		if(!isset($page)) {
			?>
			<div id="promoImage">
				<h1 id="promoText">Новостной портал TurboNews</h1>
			</div>
			<?php
		}
	?>

	<div id="content">
		<?php 
			if(!isset($page)) {
				require('pages/main.php');
			} elseif($page == 'allNews') {
				require('pages/main.php');
			} elseif($page == 'worldNews') {
				require('pages/worldNews.php');
			} elseif($page == 'entertainmentNews') {
				require('pages/entertainmentNews.php');
			} elseif($page == 'techNews') {
				require('pages/techNews.php');
			} elseif($page == 'about') {
				require('pages/about.php');
			} elseif($page == 'userPage') {
				require('pages/userPage.php');
			} elseif($page == 'loginPage') {
				require('pages/loginPage.php');
			} elseif($page == 'registrationPage') {
				require('pages/registrationPage.php');
			} elseif($page == 'openedNewsPage') {
				require('pages/openedNewsPage.php');
			} elseif($page == 'succesReg') {
				require('pages/successRegistrationPage.php');
			} elseif($page == 'changePass') {
				require('pages/userChangePass.php');
			} elseif($page == 'userList') {
				require('pages/adminUserList.php');
			} elseif($page == 'updateUserType') {
				require('pages/userUpdateType.php');
			} elseif($page == 'addNewNews') {
				require('pages/addNewNews.php');
			} elseif($page == 'updCurrentNews')  {
				require('pages/updCurrentNews.php');
			} elseif($page == 'sendComplaint') {
				require('pages/sendComplaintPage.php');
			} elseif($page == 'complaintsList') {
				require('pages/complaintListPage.php');
			} else {
				require('pages/error.php');
			}
		?>
	</div>

	<!--------------------- КОНТЕНТ САЙТА КОНЕЦ ---------------------->

	<!--------------------- ФУТЕР НАЧАЛО ---------------------->

	<footer>
		<div id="inFooter">
			<div id="contacts">
				<div class="contact">
					<img src="images/envelope.svg" class="contactIcons">
					info@turbonews.com
				</div>

				<div class="contact">
					<img src="images/phone.svg" class="contactIcons">
					8 (912) 345-67-89
				</div>

				<div class="contact">
					<img src="images/placeholder.svg" class="contactIcons">
					г. Волгоград
				</div>
			</div>

			<div id="footerNavigation">
				<a href="/">Главная</a>
				<a href="index.php?page=news">Новости</a>
				<a href="index.php?page=about">О нас</a>
				<?php
					if($_SESSION['user-log-id'] == 0) {
						?>
						<a href="index.php?page=loginPage">Личный кабинет</a>
						<?php
					} else {
						?>
						<a href="index.php?page=userPage&<?php echo "user_id=" . $_SESSION['user-log-id']; ?>">Личный кабинет</a>
						<?php
					}
				?>
			</div>

			<div id="specialContacts">
				<a href="https://vk.com/" target="_blank">
					<img src="images/vk-social-logotype.svg" class="social">
				</a>

				<a href="https://ru-ru.facebook.com/" target="_blank">
					<img src="images/facebook-logo.svg" class="social">
				</a>

				<a href="https://plus.google.com/discover?hl=ru" target="_blank">
					<img src="images/google-plus.svg" class="social">
				</a>
			</div>

			<div id="copyrights">&copy; TurboNews, 2021</div>
		</div>	
	</footer>

	<!--------------------- КОНЕЦ ФУТЕРА ---------------------->

</body>
</html>

<?php 
	mysqli_close($connectIndexPage);
?>