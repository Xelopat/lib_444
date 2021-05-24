<?php
	session_start();
	require_once "base.php";
	if($_POST["author_id"] != ""){
		append_book_all($_POST["author_id"], $_POST["subject_id"], $_POST["class_num"]);
		header("Refresh: 0");
	}
	if($_SESSION["my_is_admin"] == 0 or $_SESSION["my_is_admin"] == "") header('Location: index.php');
?>
<html>
	<head>
		<title>Добавить книгу</title>
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
				<select id="class_num" name="class_num" style="font-size: 30px">
					<option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
					<option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option>
				</select>
				<select id="author_id" name="author_id" style="font-size: 30px">
					<?php
						$all_authors = all_authors();
						foreach($all_authors as $row){
							echo "<option value=" . $row['author_id'] .">" . $row['name'] . "</option>";
						}
					?>
				</select>
				<select id="subject_id" name="subject_id" style="font-size: 30px">
					<?php
						$all_subjects = all_subjects();
						foreach($all_subjects as $row){
							echo "<option value=" . $row['subject_id'] .">" . $row['name'] . "</option>";
						}
					?>
				</select>
				<button type='submit'>Добавить</button><br/><br/>
			</form>
		</div>
		<div width=80% align="center" style="margin: auto">
			<?php
				$all_books = all_books("");
				$i = 0;
				foreach($all_books as $row){
					$i += 1;
					$author = get_author($row["author_id"]);
					$subject = get_subject($row["subject_id"]);
					$class = $row["class_num"];
					echo "<p style='width: 100px;font-size:18px; display: inline;' id=" . $row['book_id'] ."0>$author $subject $class</p><button id='" . $row['book_id'] . "' style='color:red' onclick='del(this.id)'>Удалить </button>";
					if($i % 4 == 0) echo "<br/><br/>";
				}
			?>
		</div>
	</body>
</html>
<script>
	async function del(id){
		let formData = new FormData();
		formData.append('book', id);
		let response = await fetch('base.php', {
			method: 'POST',
			body: formData
		});
		document.getElementById(id + "0").remove();
		document.getElementById(id).remove();
	}
</script>
