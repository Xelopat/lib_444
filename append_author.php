<?php
	session_start();
	require_once "base.php";
	if($_POST["author"] != ""){
		append_author($_POST["author"]);
		header("Refresh: 0");
	}
	if($_SESSION["my_is_admin"] == 0 or $_SESSION["my_is_admin"] == "") header('Location: index.php');
?>
<html>
	<head>
		<title>Добавить премет</title>
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
		<div id="append_authors">
			<br/>
			<form align="center" method="POST">
				<input name="author" placeholder="Иванов.И.И."><br/><br/><br/>
				<button type='submit'>Добавить</button><br/><br/>
			</form>
		</div>
		<div width=80% align="center" style="margin: auto">
			<?php
				$all_authors = all_authors();
				$i = 0;
				foreach($all_authors as $row){
					$i += 1;
					echo "<p style='width: 100px;font-size:18px; display: inline;' id=" . $row['author_id'] ."0>" . $row['name'] . "</p><button id='" . $row['author_id'] . "' style='color:red' onclick='del(this.id)'>Удалить </button>";
					if($i % 7 == 0) echo "<br/><br/>";
				}
			?>
		</div>
	</body>
</html>
<script>
	async function del(id){
		let formData = new FormData();
		formData.append('author', id);
		let response = await fetch('base.php', {
			method: 'POST',
			body: formData
		});
		document.getElementById(id + "0").remove();
		document.getElementById(id).remove();
	}
</script>
