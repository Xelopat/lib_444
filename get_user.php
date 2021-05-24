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
	<body><br/>
		<div>
			<div style="float:left;">
				<a class=button  href="index.php">Назад</a>
			</div>
			<div style="float:right;">
				<a class=button  href="profile.php"><?php echo $_SESSION["my_name"];?></a>
				<a class=button  href="logout.php">Выход</a>
			</div>
			<div class="clear"></div>
		</div>
		<div align="center" style="margin-top: 6%">
			</br><label style="font-size:35px">Книги пользователя <?php echo $user["my_name"];?> (<?php echo $user_class["name"];?>) </label></br>
			<label style="font-size:30px">На руках:</label></br>
			<table border="1" style="background: #55FF55;" width=50%>
				<tr style="background: #FFFFFF;" height=70px>
					<td style='font-size:30px;' >Добавить:</td><td >
						<select id="book_append" style='font-size:30px;'>
							<option value="0">Не выбрано</option>
							<?php
								$all_authors = all_books(" WHERE class_num = $user_class_num");
								foreach($all_authors as $row){
									echo "<option value=" . $row['id'] .">" . get_author($row['author_id']) . " " . get_subject($row['subject_id']) . "</option>";
								}
							?>
						</select>
					</td>
					<?php echo "<td style='font-size:30px;' align='center'><p onclick='append_book(" . $_GET["id"] . ")'; style='height: 40px; width: 40px; font-size:30px;cursor:pointer'>&#9989;</p></td><td style='font-size:30px;'></td>";?>
				</tr>
				<tr height=40px>
					<td style='font-size:30px;'>Автор</td><td style='font-size:30px;'>Предмет</td><td style='font-size:30px;'>Класс</td><td style='font-size:30px;'>Удалить</td>
				</tr>
				<?php
					$taked = show_books($_GET["id"], "taked_books");
					if($taked){
						foreach($taked as $row){
							echo "<tr height=40px>";
							$current_book = get_book($row["id_book"]);
							$author = get_author($current_book["author_id"]);
							$subject = get_subject($current_book["subject_id"]);
							$class = $current_book["class_num"];
							$arr = $current_book['id'] . '_remove' . "_" . $_GET["id"];
							echo "<td style='font-size:30px;'>$author</td><td style='font-size:30px;'>$subject</td><td style='font-size:30px;' align='center'>$class</td><td style='font-size:30px;' align='center'><p style='height: 40px; width: 40px; font-size:30px;cursor:pointer' onclick=send_form('$arr');>&#10062;</p></td>";
							echo "</tr>";
						}
					}
				?>
				
			</table>
			<label style="font-size:30px">Ожидают подтверждения:</label>
			<table border="1" style="background: #FFEE00;" width=50%>
				<tr height=40px><td style='font-size:30px;'>Автор</td><td style='font-size:30px;'>Предмет</td><td style='font-size:30px;'>Класс</td><td style='font-size:30px;'>Подтвердить сдачу</td></tr>
				<?php
					$waited = show_books($_GET["id"], "waited_books");
					if($waited){
						foreach($waited as $row){
							echo "<tr height=40px>";
							$current_book = get_book($row["id_book"]);
							$author = get_author($current_book["author_id"]);
							$subject = get_subject($current_book["subject_id"]);
							$class = $current_book["class_num"];
							$arr = $current_book['id'] . '_accept' . "_" . $_GET["id"];
							echo "<td style='font-size:30px;'>$author</td><td style='font-size:30px;'>$subject</td><td style='font-size:30px;'>$class</td><td style='font-size:30px;' align='center'><p style='height: 40px; width: 40px; font-size:30px;cursor:pointer' onclick=send_form('$arr');>&#9989;</p></td>";
							echo "</tr>";
						}
					}
				?>
			</table>
			<label style="font-size:30px">Сданы:</label>
			<table border="1" width=50%><tr height=40px>
			<td style='font-size:30px;'>Автор</td><td style='font-size:30px;'>Предмет</td><td style='font-size:30px;'>Класс</td><td style='font-size:30px;'>Взять снова</td><td style='font-size:30px;'>Удалить</td></tr>
			<?php
				$accepted = show_books($_GET["id"], "accepted_books");
				if($accepted){
					foreach($accepted as $row){
						echo "<tr height=40px>";
						$current_book = get_book($row["id_book"]);
						$author = get_author($current_book["author_id"]);
						$subject = get_subject($current_book["subject_id"]);
						$class = $current_book["class_num"];
						$arr = $current_book['id'] . '_take' . "_" . $_GET["id"];
						$arr_1 = $current_book['id'] . '_removeend' . "_" . $_GET["id"];
						if(!i_have_book($_GET["my_id"], $row["id"])) echo "<td style='font-size:30px;'>$author</td><td style='font-size:30px;'>$subject</td><td style='font-size:30px;'>$class</td><td style='font-size:30px;'><p style='height: 40px; width: 40px; font-size:30px;cursor:pointer' onclick=send_form('$arr');>&#9989;</p></td>";
						else echo "<td style='font-size:30px;'>$author</td><td style='font-size:30px;'>$subject</td><td style='font-size:30px;'>$class</td>";
						echo "<td style='font-size:30px;'><p style='height: 40px; width: 40px; font-size:30px;cursor:pointer' onclick=send_form('$arr_1');>&#10062;</p></td>";
						echo "</tr>";
					}
				}
			?>
			</table>
		</div>
	</body>
	<script>
		async function append_book(user){
			let formData = new FormData();
			if(document.getElementById('book_append').value != "0"){
				formData.append('id', document.getElementById('book_append').value);
				formData.append('type', "append");
				formData.append('user_id', user);
				let response = await fetch('write_db_admin.php', {
					method: 'POST',
					body: formData
				});
				let result = await response.text();
				console.log(result);
				if(result != "failed") location.reload();
			}
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




