<h1 id="loginTitle">Регистрация нового пользователя:</h1>

<div id="loginPageBar">
	<form action="../scripts/userRegistrationScript.php" method="POST">
		<table id="loginBarTable">
			<tr>
				<td><div class="loginInfo">Введите логин:</div></td>
				<td>
					<input type="text" name="userRegLoginTB" class="loginTextBox" required placeholder="Придумайте логин">
					<span class="requiredField">*</span>
				</td>
			</tr>
			<tr>
				<td><div class="loginInfo">Введите ваш пароль:</div></td>
				<td>
					<input type="password" name="userRegPassTB" class="loginTextBox" required placeholder="Придумайте пароль">
					<span class="requiredField">*</span>
				</td>
			</tr>
			<tr>
				<td><div class="loginInfo">Повторите ваш пароль:</div></td>
				<td>
					<input type="password" name="userRegRepeatPassTB" class="loginTextBox" required placeholder="Повторите пароль">
					<span class="requiredField">*</span>
				</td>
			</tr>
		</table>
		<input type="submit" name="userRegConfirmButton" value="Регистрация" class="userLogBut">
	</form>
</div>

