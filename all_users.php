<?php 
	session_start();
	require_once "base.php";
	if($_SESSION["my_is_admin"] != 1) header('Location: index.php');
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<title>Все пользователи</title>
	</head>
	<body><br/>
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
		<div align="center">
			<label  style="font-size: 30px">Класс:</label>
			<select id="class_num" onchange=reload('')  style="font-size: 30px">
				<option value="0">Не выбрано</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
				<option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option>
			</select>
		</div></br>
		<table border="1" align="center" width=50%>
			<?php
				$info = "";
				$and = false;
				$all_info = array();
				if($_GET["class_num"] != "0" && $_GET["class_num"] != ""){
					$info = "WHERE class_id IN (SELECT id FROM classes WHERE num = " . $_GET["class_num"] .")";
				}
				if($_GET["order"] != "") $info .= " ORDER BY " . $_GET["order"];
				echo "<tr height=40px><td style='font-size:30px;'><p onclick=reload('name')>Имя&#9660;</p></td><td style='font-size:30px;'><p onclick=reload('class_id')>Класс&#9660;</p></td>
				<td style='font-size:30px;' align=center><p onclick=reload('take_count')>На руках&#9660;</p></td>
				<td style='font-size:30px;' align=center><p onclick=reload('wait_count')>Ожидают подтверждения&#9660;</p></td></tr>";
				$all_users = all_users($info);
				if($all_users){
					foreach($all_users as $row){
						echo "<tr onclick=get_user($row[id]) height=40px>";
						$name = $row["name"];
						$class = get_class_by_id($row["class_id"]);
						$class = $class["name"];
						echo "<td style='font-size:30px;'>$name</td><td style='font-size:30px;'>$class</td><td style='font-size:30px;'>" . (string)$row['take_count'] . "</td><td style='font-size:30px;'>" . (string)$row['wait_count'] . "</td>";
						echo "</tr>";
					}
				}
			?>
		</table>
	</body>
	<script>
		const searchString = new URLSearchParams(window.location.search);
		function reload(sort_by){
			let class_num = document.getElementById("class_num").value;
			let info = "?";
			if(class_num != "0") info += "class_num=" + class_num + "&";
			if(searchString.get('order') != "" && sort_by == "") sort_by = searchString.get('order');
			if(sort_by != "" && sort_by != null) info += "order=" + sort_by + "&";
			document.location.href = "all_users.php" + info;
		}
		if(searchString.get('class_num')) document.getElementById("class_num").value = searchString.get('class_num');
		
		function get_user(id){
			document.location.href = "get_user.php?id=" + id;
		}
		
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




