<?php 
	session_start();
	require_once "base.php";
	if($_SESSION["my_name"] == "") header('Location: index.php');
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
				<a href=""><?php echo $_SESSION["my_name"];?></a>
				<a href="logout.php">Выход</a>
			</div>
			<div class="clear"></div>
		</div>
		<div align="center" style="margin-top: 8%">
			<?php
				if($_SESSION["my_is_admin"] == 1) $is_admin = ", админ";
				else if($_SESSION["my_is_admin"] == -1) $is_admin = ", ожидание подтверждения(админ)";
				else $is_admin = ", пользователь";
				$class = get_class_by_id($_SESSION["my_class_id"]);
				echo $_SESSION["my_name"] . " " . $class . $is_admin;
			?></br></br>
			</br><label>Мои книги</label></br>
			<label>На руках:</label></br>
			<table border="1" style="background: #00DD00;">
				<td>Автор</td><td>Предмет</td><td>Класс</td><td>Сдать</td>
				<?php
					$taked = show_books($_SESSION["my_id"], "taked_books");
					if($taked){
						foreach($taked as $row){
							echo "<tr>";
							$current_book = get_book($row["id_book"]);
							$author = get_author($current_book["author_id"]);
							$subject = get_subject($current_book["subject_id"]);
							$class = $current_book["class_num"];
							$arr = $current_book['id'] . '_remove';
							echo "<td>$author</td><td>$subject</td><td>$class</td><td align='center'><button onclick=send_form('$arr');>&#9989;</button></td>";
							echo "</tr>";
						}
					}
				?>
			</table>
			<label>Ожидают подтверждения:</label>
			<table border="1" style="background: #FFEE00;">
				<td>Автор</td><td>Предмет</td><td>Класс</td><td>Отмена</td>
				<?php
					$waited = show_books($_SESSION["my_id"], "waited_books");
					if($waited){
						foreach($waited as $row){
							echo "<tr>";
							$current_book = get_book($row["id_book"]);
							$author = get_author($current_book["author_id"]);
							$subject = get_subject($current_book["subject_id"]);
							$class = $current_book["class_num"];
							$arr = $current_book['id'] . '_return';
							echo "<td>$author</td><td>$subject</td><td>$class</td><td><button onclick=send_form('$arr');>&#10062;</button></td>";
							echo "</tr>";
						}
					}
				?>
				</table>
				<label>Сданы:</label>
				<table border="1" style="background: #FF5555;">
				<td>Автор</td><td>Предмет</td><td>Класс</td><td>Взять снова</td>
				<?php
					$accepted = show_books($_SESSION["my_id"], "accepted_books");
					if($accepted){
						foreach($accepted as $row){
							echo "<tr>";
							$current_book = get_book($row["id_book"]);
							$author = get_author($current_book["author_id"]);
							$subject = get_subject($current_book["subject_id"]);
							$class = $current_book["class_num"];
							$arr = $current_book['id'] . '_take';
							if(!i_have_book($_SESSION["my_id"], $row["id"])) echo "<td>$author</td><td>$subject</td><td>$class</td><td><button onclick=send_form('$arr');>&#9989;</button></td>";
							else echo "<td>$author</td><td>$subject</td><td>$class</td>";
							echo "</tr>";
						}
					}
				?>
			</table>
		</div>
	</body>
	<script>
		async function send_form(arr)
        {
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
		};
	</script>
</html>




