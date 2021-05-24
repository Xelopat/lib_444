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
	<body><br/>
		<div>
			<div style="float:left;">
				<a class=button href="index.php">Назад</a>
			</div>
			<div style="float:right;">
				<a class=button href=""><?php echo $_SESSION["my_name"];?></a>
				<a class=button href="logout.php">Выход</a>
			</div>
			<div class="clear"></div>
		</div>
		<div align="center" style="margin-top: 6%">
			<?php
				if($_SESSION["my_is_admin"] == 1) $is_admin = ", админ";
				else if($_SESSION["my_is_admin"] == -1) $is_admin = ", ожидание подтверждения(админ)";
				else $is_admin = ", пользователь";
				$class = get_class_by_id($_SESSION["my_class_id"]);
				echo '<p style="font-size:30px">' . $_SESSION["my_name"] . ' ' . $class["name"] . $is_admin . '</p>';
			?>
			</br><label style="font-size:30px">Мои книги</label></br>
			<label style="font-size:30px">На руках:</label></br>
			<table border="1" style="background: #55FF55;" width=50%><tr height=70px>
				<td  style='font-size:30px;'>Автор</td><td style='font-size:30px;'>Предмет</td><td style='font-size:30px;'>Класс</td><td style='font-size:30px;'>Сдать</td>
				<?php
					$taked = show_books($_SESSION["my_id"], "taked_books");
					if($taked){
						foreach($taked as $row){
							echo "<tr height=70px style='font-size:20px'>";
							$current_book = get_book($row["id_book"]);
							$author = get_author($current_book["author_id"]);
							$subject = get_subject($current_book["subject_id"]);
							$class = $current_book["class_num"];
							$arr = $current_book['id'] . '_remove';
							echo "<td style='font-size:30px;'>$author</td><td style='font-size:30px;'>$subject</td><td style='font-size:30px;'>$class</td><td style='font-size:30px;' align='center'><p style='height: 40px; width: 40px; font-size:30px;cursor:pointer' onclick=send_form('$arr');>&#9989;</p></td>";
							echo "</tr>";
						}
					}
				?>
				</tr>
			</table>
			<label style="font-size:30px">Ожидают подтверждения:</label>
			<table border="1" width=50% style="background: #FFEE00;">
			<tr height=70px>
				<td style='font-size:30px;'>Автор</td><td style='font-size:30px;'>Предмет</td><td style='font-size:30px;'>Класс</td><td style='font-size:30px;'>Отмена</td></tr>
				<?php
					$waited = show_books($_SESSION["my_id"], "waited_books");
					if($waited){
						foreach($waited as $row){
							echo "<tr height=70px style='font-size:20px'>";
							$current_book = get_book($row["id_book"]);
							$author = get_author($current_book["author_id"]);
							$subject = get_subject($current_book["subject_id"]);
							$class = $current_book["class_num"];
							$arr = $current_book['id'] . '_return';
							echo "<td style='font-size:30px;'>$author</td><td style='font-size:30px;'>$subject</td><td style='font-size:30px;'>$class</td><td style='font-size:30px;'><p style='height: 40px; width: 40px; font-size:30px;cursor:pointer' onclick=send_form('$arr');>&#10062;</p></td>";
							echo "</tr>";
						}
					}
				?>
				</table>
				<label style="font-size:30px">Сданы:</label>
				<table border="1" width=50%><tr height=70px>
				<td style='font-size:30px;'>Автор</td><td style='font-size:30px;'>Предмет</td><td style='font-size:30px;'>Класс</td><td style='font-size:30px;'>Взять снова</td></tr>
				<?php
					$accepted = show_books($_SESSION["my_id"], "accepted_books");
					if($accepted){
						foreach($accepted as $row){
							echo "<tr style='font-size:20px' height=70px>";
							$current_book = get_book($row["id_book"]);
							$author = get_author($current_book["author_id"]);
							$subject = get_subject($current_book["subject_id"]);
							$class = $current_book["class_num"];
							$arr = $current_book['id'] . '_take';
							if(!i_have_book($_SESSION["my_id"], $row["id"])) echo "<td style='font-size:30px;'>$author</td><td style='font-size:30px;'>$subject</td><td style='font-size:30px;'>$class</td><td style='font-size:30px;'><p style='height: 40px; width: 40px; font-size:30px;cursor:pointer' onclick=send_form('$arr');>&#9989;</p></td>";
							else echo "<td style='font-size:30px;'>$author</td><td style='font-size:30px;'>$subject</td><td style='font-size:30px;'>$class</td><td style='font-size:20px;' align='center'>Уже в библиотеке</td>";
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




