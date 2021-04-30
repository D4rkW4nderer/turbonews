<h1 id="loginTitle">Войдите в личный кабинет чтобы продолжить:</h1>

<div id="loginPageBar">
	<form action="../scripts/userLoginScript.php" method="POST">
		<table id="loginBarTable">
			<tr>
				<td><div class="loginInfo">Ваш логин:</div></td>
				<td>
					<input type="text" name="userLoginTextBox" class="loginTextBox" required placeholder="Введите ваш логин">
					<span class="requiredField">*</span>
				</td>
			</tr>
			<tr>
				<td><div class="loginInfo">Ваш пароль:</div></td>
				<td>
					<input type="password" name="userPasswordTextBox" class="loginTextBox" required placeholder="Введите ваш пароль">
					<span class="requiredField">*</span>
				</td>
			</tr>
		</table>
		<input type="submit" name="userLoginButton" value="Войти" class="userLogBut">
		<a href="index.php?page=registrationPage" class="userLogBut">Зарегистрироваться</a>
	</form>
</div>

