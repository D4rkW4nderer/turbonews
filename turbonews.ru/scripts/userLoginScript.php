<?php 
	session_start();
	
	require_once '../connection.php';

	$userLoginScriptConnect = mysqli_connect($hostname, $username, $password, $database)
		or die("Error" . mysqli_error($userLoginScriptConnect));

	mysqli_set_charset($userLoginScriptConnect, 'utf-8');

	$userLoginName = htmlspecialchars(mysqli_real_escape_string($userLoginScriptConnect, $_POST['userLoginTextBox']));
	$userLoginPassword = htmlspecialchars(mysqli_real_escape_string($userLoginScriptConnect, $_POST['userPasswordTextBox']));

	$checkUserList = "SELECT * FROM user_list";
	$checkUserListQuery = mysqli_query($userLoginScriptConnect, $checkUserList)
		or die("Error" . mysql_error($userLoginScriptConnect));

	if($checkUserListQuery) {
		while($userLoginData = mysqli_fetch_array($checkUserListQuery)) {
			if($userLoginName == $userLoginData['user_name'] && $userLoginPassword == $userLoginData['user_password']) {
				$_SESSION['user-log-id'] = $userLoginData['user_id'];
			}
		}
	}

	if($_SESSION['user-log-id'] != 0) {
		header("Refresh: 0; url=../index.php?page=userPage&user_id=" . $_SESSION['user-log-id']);
	} else {
		// header("Refresh: 0; url=../index.php?page=loginPage");
		?>
		<script type="text/javascript">
			alert("Неверный логин или пароль");
			location="../index.php?page=loginPage";
			</script>
		<?php
		// echo "<script type='text/javascript'>alert('Неправильный логин и/или пароль!')</script>";
	}

	mysqli_close($userLoginScriptConnect);
?>