<?php 
	session_start();
	require_once "base.php";
	$status = true;
	if($_SESSION["my_name"] == "") $status = false;
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<title>Все книги</title>
	</head>
	<body>
		<div>
			<div style="float:left;">
				<a href="index.php">Назад</a>
			</div>
			<div style="float:right;">
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
			<div class="clear"></div>
		</div>
		<div align="center">
			<label>Класс:</label>
			<select id="class_num" onchange=reload('')>
				<option value="0">Не выбрано</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
				<option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option>
			</select>
			<label>Автор:</label>
			<select id="author_id" onchange=reload('')>
				<option value="0">Не выбрано</option>
				<?php
					$all_authors = all_authors();
					foreach($all_authors as $row){
						echo "<option value=" . $row['author_id'] .">" . $row['name'] . "</option>";
					}
				?>
			</select>
			<label>Предмет:</label>
			<select id="subject_id" onchange=reload('')>
				<option value="0">Не выбрано</option>
				<?php
					$all_subjects = all_subjects();
					foreach($all_subjects as $row){
						echo "<option value=" . $row['subject_id'] .">" . $row['name'] . "</option>";
					}
				?>
			</select>
		</div></br>
		<table border="1" align="center">
			<?php
				$args = array($_GET["author_id"], $_GET["subject_id"], $_GET["class_num"]);
				$info = "";
				$and = false;
				$all_info = array();
				if($args != array("", "", "")) $info = "WHERE ";
				if($args[0] != ""){
					array_push($all_info, "author_id=" . $args[0]);
				}
				if($args[1] != ""){
					array_push($all_info, "subject_id=" . $args[1]);
				}
				if($args[2] != ""){
					array_push($all_info, "class_num=" . $args[2]);
				}
				$info .= implode(" AND ", $all_info);
				if($_GET["order"] != "") $info .= " ORDER BY " . $_GET["order"];
				if(!$status){
					echo "<td><p onclick=reload('author_id')>Автор</p></td><td><p onclick=reload('subject_id')>Предмет</p></td><td><p onclick=reload('class_num')>Класс</p></td>";
					$all_books = all_books($info);
					if($all_books){
						foreach($all_books as $row){
							echo "<tr>";
							$author = get_author($row["author_id"]);
							$subject = get_subject($row["subject_id"]);
							$class = $row["class_num"];
							echo "<td>$author</td><td>$subject</td><td>$class</td>";
							echo "</tr>";
						}
					}
				}
				else{
					echo "<td><p onclick=reload('author_id')>Автор</p></td><td><p onclick=reload('subject_id')>Предмет</p></td><td><p onclick=reload('class_num')>Класс</p></td><td><p>Добавить в библиотеку</p></td>";
					$all_books = all_books($info);
					if($all_books){
						foreach($all_books as $row){
							echo "<tr>";
							$author = get_author($row["author_id"]);
							$subject = get_subject($row["subject_id"]);
							$class = $row["class_num"];
							$arr = $row['id'] . '_take';
							if(!i_have_book($_SESSION["my_id"], $row["id"])) echo "<td>$author</td><td>$subject</td><td>$class</td><td align='center'><button onclick=send_form('$arr');>&#9989;</button></td>";
							else echo "<td>$author</td><td>$subject</td><td>$class</td><td align='center'>Уже в библиотеке</td>";
							echo "</tr>";
						}
					}
				}
			?>
		</table>
	</body>
	<script>
		const searchString = new URLSearchParams(window.location.search);
	function reload(sort_by){
	let class_num = document.getElementById("class_num").value;
	let author_id = document.getElementById("author_id").value;
	let subject_id = document.getElementById("subject_id").value;
	let info = "?";
	if(class_num != "0") info += "class_num=" + class_num + "&";
	if(author_id != "0") info += "author_id=" + author_id + "&";
	if(subject_id != "0") info += "subject_id=" + subject_id + "&";
	if(searchString.get('order') != "" && sort_by == "") sort_by = searchString.get('order');
	if(sort_by != "") info += "order=" + sort_by + "&";
	document.location.href = "all_books.php" + info;
	}
	if(searchString.get('class_num')) document.getElementById("class_num").value = searchString.get('class_num');
	if(searchString.get('author_id')) document.getElementById("author_id").value = searchString.get('author_id');
	if(searchString.get('subject_id')) document.getElementById("subject_id").value = searchString.get('subject_id');
	
	async function send_form(arr){
	let formData = new FormData();
	let id = arr.split("_")[0];
	let type = arr.split("_")[1];
	formData.append('id', id);
	formData.append('type', type);
	let response = await fetch('write_db.php', {
	method: 'POST',
	body: formData
	});
	let result = await response.text();
	if(result == "failed") alert("У вас уже есть эта книга"); 
	else location.reload();
	}
	</script>
	</html>
	
	
	
	
		