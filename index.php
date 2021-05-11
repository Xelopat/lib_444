<?php 
session_start();
?>
<html>
	<head>
		<title>Библиотека</title>
	</head>
	<body>
		<div align="right">
			<?php
				if($_SESSION["my_login"] == "") echo 
				'<div>
				<a href="login.php">Вход</a>
				<a href="registration.php">Регистрация</a>
				</div>';
				else echo 
				'<div>
				<a href="profile.php">' . $_SESSION["my_login"] . '</a>
				<a href="logout.php">Выход</a>
				</div>';
			?>
		</div>
		<div align="center" style="margin-top: 10%">
			<a href="scan_book.php">Сканировать книгу</a></br></br></br>
			<a href="all_books.php">Все книги</a>
			<?php
			if($_SESSION["my_is_admin"] == 1) echo '</br></br></br><a href="all_users.php">Все пользователи</a>'
			?>
		</div>
	</body>
</html>