<?php 
	session_start();
	require_once "base.php";
	if($_SESSION["my_name"] != "") header('Location: index.php');
	if($_POST["login"] != ""){
		if($_POST["password"] != $_POST["password_1"]){
			echo "Пароли не совпадают";
		}
		else{
			if(user_exist($_POST["login"])){
				echo "Такой пользователь уже существует";
			}
			else{
				if($_POST["is_admin"] == "on") $admin = -1;
				else $admin = 0;
				append_user($_POST["login"], $_POST["password"], $_POST["my_name"], $admin, (int)$_POST["class_id"]);
				$info = user_right($_POST["login"], $_POST["password"]);
				$_SESSION["my_id"] = $_POST["id"];
				$_SESSION["my_login"] = $_POST["login"];
				$_SESSION["my_name"] = $_POST["my_name"];
				$_SESSION["my_class_id"] = (int)$_POST["class_id"];
				$_SESSION["wait_count"] = 0;
				$_SESSION["take_count"] = 0;
				$_SESSION["my_is_admin"] = $admin;
				header('Location: index.php');
			}
		}
	}
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<title>Регистрация</title>
	</head>
	<body>
		<div>
			<div style="float:left;">
				<a href="index.php">Назад</a>
			</div>
			<div style="float:right;">
				<a href="login.php">Вход</a>
			</div>
			<div class="clear"></div>
		</div>
		<form method="POST" style="margin-top:150px;">
			<div align="center">
				<label>Логин: </label></br><input type="text" placeholder="name_123" name="login" required></br>
				<label>Имя, фамилия: </label></br><input type="text" placeholder="Иван Иванов" name="my_name" required></br>
				<label>Пароль: </label></br><input type="password" placeholder="password" name="password" required></br>
				<label>Повторите пароль: </label></br><input type="password" placeholder="password" name="password_1" required></br>
				<label>Выберить свой класс:</label></br><select name="class_id" style="width: 100px">
					<?php
						$all_classes = all_classes();
						foreach($all_classes as $row){
							echo "<option value=" . $row['class_id'] .">" . $row['class'] . "</option>";
						}
					?>
				</select></br>
				<label>Я админ:</label><input type="checkbox" name="is_admin" onchange="if(this.checked)alert('После регистрации ожидайте подтверждения от другого админа');"></br>
				<input type="submit" value="Регистрация"></br>
				<a href="login.php">Уже есть аккаунт?</a>
			</div>
		</form>
	</body>
</html>




