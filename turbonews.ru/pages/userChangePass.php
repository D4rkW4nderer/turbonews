<h1 id="usrChangePassTitle">Изменение текущего пароля пользователя:</h1>

<div id="changeUsrPassBar">
	<form action="../scripts/userChangePasswordScript.php" method="POST">
		<table id="changeUsrPassTable">
			<tr>
				<td><div class="changePassInfo">Введите текущий пароль:</div></td>
				<td>
					<input type="password" name="changeUsrPassCurPS" class="changePassTB" required placeholder="Введите ваш текущий пароль">
					<span class="requiredField">*</span>
				</td>
			</tr>
			<tr>
				<td><div class="changePassInfo">Введите новый пароль:</div></td>
				<td>
					<input type="password" name="changeUsrPassNewPS" class="changePassTB" required placeholder="Введите новый пароль">
					<span class="requiredField">*</span>
				</td>
			</tr>
			<tr>
				<td><div class="changePassInfo">Повторите новый пароль:</div></td>
				<td>
					<input type="password" name="changeUsrPassRepPS" class="changePassTB" required placeholder="Повторите новый пароль">
					<span class="requiredField">*</span>
				</td>
			</tr>
		</table>
		<input type="submit" name="changeUserPassButton" id="changeUsrPassBut" value="Сменить пароль">
	</form>
</div>

