<?php
	session_start();
	require_once "base.php";
	if($_POST["class"] != ""){
		append_class($_POST["class"]);
		header("Refresh: 0");
	}
	if($_SESSION["my_is_admin"] == 0 or $_SESSION["my_is_admin"] == "") header('Location: index.php');
?>
<html>
	<head>
		<title>Добавить класс</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<br/>
		<div>
			<div style="float:left;">
				<a class=button href="index.php">Назад</a>
			</div>
			<div style="float:right;">
				<div>
					<a class=button href="profile.php"><?php echo $_SESSION["my_login"]; ?></a>
					<a class=button href="logout.php">Выход</a>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div id="append_classes">
			<br/>
			<form align="center" method="POST">
				<input name="class" placeholder="1А"><br/><br/><br/>
				<button type='submit'>Добавить</button><br/><br/>
			</form>
		</div>
		<div width=80% align="center" style="margin: auto">
			<?php
				$all_classes = all_classes();
				$i = 0;
				foreach($all_classes as $row){
					$i += 1;
					echo "<p style='width: 100px;font-size:18px; display: inline;' id=" . $row['class_id'] ."0>" . $row['class'] . "</p><button id='" . $row['class_id'] . "' style='color:red' onclick='del(this.id)'>Удалить </button>";
					if($i % 7 == 0) echo "<br/><br/>";
				}
			?>
		</div>
	</body>
</html>
<script>
	async function del(id){
		document.getElementById(id + "0").remove();
		document.getElementById(id).remove();
		let formData = new FormData();
		formData.append('class', id);
		let response = await fetch('base.php', {
			method: 'POST',
			body: formData
		});
		
	}
</script>
