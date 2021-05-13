<?php 
	session_start();
	require_once "base.php";
	if($_SESSION["my_is_admin"] != 1) header('Location: index.php');
	$user = get_user($_GET["id"]);
	$user_class = get_class_by_id($user["class_id"]);
	$user_class_num = $user_class["num"];
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<title>Библиотека</title>
	</head>
	<body>
		<div>
			<div style="float:left;">
				<a href="index.php">Назад</a>
			</div>
			<div style="float:right;">
				<a href="profile.php"><?php echo $_SESSION["my_name"];?></a>
				<a href="logout.php">Выход</a>
			</div>
			<div class="clear"></div>
		</div>
		<div align="center" style="margin-top: 8%">
			</br><label>Книги пользователя <?php echo $user["my_name"];?> (<?php echo $user_class["name"];?>) </label></br>
			<label>На руках:</label></br>
			<table border="1" style="background: #55FF55;">
				<td>Автор</td><td>Предмет</td><td>Класс</td><td>Удалить</td>
				<?php
					$taked = show_books($_GET["id"], "taked_books");
					if($taked){
						foreach($taked as $row){
							echo "<tr>";
							$current_book = get_book($row["id_book"]);
							$author = get_author($current_book["author_id"]);
							$subject = get_subject($current_book["subject_id"]);
							$class = $current_book["class_num"];
							$arr = $current_book['id'] . '_remove' . "_" . $_GET["id"];
							echo "<td>$author</td><td>$subject</td><td>$class</td><td align='center'><button onclick=send_form('$arr');>&#10062;</button></td>";
							echo "</tr>";
						}
					}
				?>
			</tr>
			<td>Добавить:</td><td>
			<select id="book_append">
				<option value="0">Не выбрано</option>
				<?php
					$all_authors = all_books(" WHERE class_num = $user_class_num");
					foreach($all_authors as $row){
						echo "<option value=" . $row['id'] .">" . get_author($row['author_id']) . " " . get_subject($row['subject_id']) . "</option>";
					}
				?>
			</select>
			</td>
			<td><td align='center'><button onclick=append_book();>&#9989;</button></</td><td></td>
			</table>
			<label>Ожидают подтверждения:</label>
			<table border="1" style="background: #FFEE00;">
				<td>Автор</td><td>Предмет</td><td>Класс</td><td>Подтвердить сдачу</td>
				<?php
					$waited = show_books($_GET["my_id"], "waited_books");
					if($waited){
						foreach($waited as $row){
							echo "<tr>";
							$current_book = get_book($row["id_book"]);
							$author = get_author($current_book["author_id"]);
							$subject = get_subject($current_book["subject_id"]);
							$class = $current_book["class_num"];
							$arr = $current_book['id'] . '_accept' . "_" . $_GET["id"];
							echo "<td>$author</td><td>$subject</td><td>$class</td><td align='center'><button onclick=send_form('$arr');>&#9989;</button></td>";
							echo "</tr>";
						}
					}
				?>
				</table>
				<label>Сданы:</label>
				<table border="1" style="background: #FF5555;">
				<td>Автор</td><td>Предмет</td><td>Класс</td><td>Взять снова</td><td>Удалить</td>
				<?php
					$accepted = show_books($_GET["my_id"], "accepted_books");
					if($accepted){
						foreach($accepted as $row){
							echo "<tr>";
							$current_book = get_book($row["id_book"]);
							$author = get_author($current_book["author_id"]);
							$subject = get_subject($current_book["subject_id"]);
							$class = $current_book["class_num"];
							$arr = $current_book['id'] . '_take' . "_" . $_GET["id"];
							$arr_1 = $current_book['id'] . '_remove' . "_" . $_GET["id"];
							if(!i_have_book($_GET["my_id"], $row["id"])) echo "<td>$author</td><td>$subject</td><td>$class</td><td><button onclick=send_form('$arr');>&#9989;</button></td>";
							else echo "<td>$author</td><td>$subject</td><td>$class</td>";
							echo "<td><button onclick=send_form('$arr_1');>&#10062;</button></td>";
							echo "</tr>";
						}
					}
				?>
			</table>
		</div>
	</body>
	<script>
		function append_book(user){
		
		}
		async function send_form(arr)
        {
			let formData = new FormData();
			let id = arr.split("_")[0];
			let type = arr.split("_")[1];
			let user_id = arr.split("_")[2];
			formData.append('id', id);
			formData.append('type', type);
			formData.append('user_id', user_id);
            let response = await fetch('write_db_admin.php', {
                method: 'POST',
                body: formData
			});
			let result = await response.text();
			console.log(result);
			if(result != "failed") location.reload();
		};
	</script>
</html>




