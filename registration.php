<?php 
	session_start();
	require_once "base.php";
	if($_SESSION["my_name"] != "") header('Location: index.php');
	if($_POST["login"] != ""){
		if($_POST["password"] != $_POST["password_1"]){
			echo "<script>alert('Пароли не совпадают')</script>";
		}
		else{
			if(user_exist($_POST["login"])){
				echo "<script>alert('Такой пользователь уже существует')</script>";
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
	<body><br>
		<div>
			<div style="float:left;">
				<a class=button  href="index.php">Назад</a>
			</div>
			<div style="float:right;">
				<a class=button  href="login.php">Вход</a>
			</div>
			<div class="clear"></div>
		</div>
		<form method="POST" style="margin-top:150px;">
			<div class=form>
				<p>Логин: </p><input type="text" placeholder="name_123" name="login" required autocomplete="nope">
				<p>Имя, фамилия: </p><input type="text" placeholder="Иван Иванов" name="my_name" required autocomplete="nope">
				<p>Пароль: </p><input type="password" placeholder="password" name="password" required>
				<p>Повторите пароль: </p><input type="password" placeholder="password" name="password_1" required>
				<p>Выберить свой класс:</p><select name="class_id" style="width: 100px;font-size:18px;">
					<?php
						$all_classes = all_classes();
						foreach($all_classes as $row){
							echo "<option value=" . $row['class_id'] .">" . $row['class'] . "</option>";
						}
					?>
				</select><br>
				<p>Я админ:</p><input type="checkbox" name="is_admin" onchange="if(this.checked)alert('После регистрации ожидайте подтверждения от другого админа');" style="width:20px;height: 20px;">
				<button type="submit">Регистрация</button><br>
			</div>
		</form>
	</body>
</html>




