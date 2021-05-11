<?php 
	session_start();
	require_once "base.php";
	if($_SESSION["my_name"] != "") header('Location: index.php');
	if($_POST["login"] != ""){
		$arr = user_right($_POST["login"], $_POST["password"]);
		if($arr != false){
			$_SESSION["my_id"] = $arr["id"];
			$_SESSION["my_login"] = $arr["login"];
			$_SESSION["my_name"] = $arr["my_name"];
			$_SESSION["my_class_id"] = $arr["class_id"];
			$_SESSION["wait_count"] = $arr["wait_count"];
			$_SESSION["take_count"] = $arr["take_count"];
			$_SESSION["my_is_admin"] = $arr["is_admin"];
			header('Location: index.php');
		}
		else echo "Неверное имя пользователя и/или пароль";
		}
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<title>Вход</title>
	</head>
	<body>
		<div>
			<div style="float:left;">
				<a href="index.php">Назад</a>
			</div>
			<div style="float:right;">
				<a href="registration.php">Регистрация</a>
			</div>
			<div class="clear"></div>
		</div>
		<form method="POST" style="margin-top:150px;">
			<div align="center">
				<label>Логин: </label></br><input type="text" placeholder="name_123" name="login" required></br>
				<label>Пароль: </label></br><input type="password" placeholder="password" name="password" required></br>
				<input type="submit" value="Вход"></br>
				<a href="registration.php">Ещё нет аккаунта?</a>
			</div>
		</form>
	</body>
</html>
