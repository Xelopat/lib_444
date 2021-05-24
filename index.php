<?php 
session_start();
?>
<html>
	<head>
		<title>Библиотека</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body><br/>
		<div align="right">
			<?php
				if($_SESSION["my_login"] == "") echo 
				'<div>
				<a class=button href="login.php">Вход</a>
				<a class=button href="registration.php">Регистрация</a>
				</div>';
				else echo 
				'<div>
				<a class=button href="profile.php">' . $_SESSION["my_login"] . '</a>
				<a class=button href="logout.php">Выход</a>
				</div>';
			?>
		</div>
		<div align="center" style="margin-top: 10%">
			<a class=button href="all_books.php">Все книги</a>
			<?php
			if($_SESSION["my_is_admin"] == 1){
				echo '</br></br></br><a class=button href="all_users.php" class="button">Все пользователи</a>';
				echo '</br></br></br><a class=button href="append_subject.php" class="button">Добавить предмет</a>';
				echo '</br></br></br><a class=button href="append_class.php" class="button">Добавить класс</a>';
				echo '</br></br></br><a class=button href="append_author.php" class="button">Добавить автора</a>';
				echo '</br></br></br><a class=button href="append_book.php" class="button">Добавить книгу</a>';
			}
			?>
		</div>
	</body>
</html>