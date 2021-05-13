<?php
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db_name = 'lib_444';
	$link = mysqli_connect($host, $user, $password, $db_name);
	
	function user_exist($login){
		global $link;
		$sql = "SELECT * FROM users WHERE login='$login'";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
			return true;
		}
		return false;
	}
	function user_right($login, $password){
		global $link;
		$sql = "SELECT * FROM users WHERE login='$login' AND password='$password'";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return array("id" => $row["id"], "login" => $row["login"], "is_admin" => $row["is_admin"], "my_name" => $row["name"], "class_id" => $row["class_id"],
				"take_count" => $row["take_count"], "wait_count" => $row["wait_count"]);
			}
		}
		return false;
	}
	function get_user($id){
		global $link;
		$sql = "SELECT * FROM users WHERE id='$id'";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return array("id" => $row["id"], "login" => $row["login"], "is_admin" => $row["is_admin"], "my_name" => $row["name"], "class_id" => $row["class_id"],
				"take_count" => $row["take_count"], "wait_count" => $row["wait_count"]);
			}
		}
		return false;
	}
	function show_books($id_user, $table_name){
		global $link;
		$sql = "SELECT * FROM $table_name WHERE id_user='$id_user'";
		$result = $link->query($sql);
		$arr = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[] = array("id_book" => $row["id_book"], "date" => $row["date"]);
			}
			return $arr;
		}
		else{
			return false;
		}
	}
	function i_have_book($id_user, $id_book){
		global $link;
		$sql = "SELECT * FROM taked_books WHERE id_user='$id_user' AND id_book='$id_book'";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
			return true;
		}
		else{
			$sql1 = "SELECT * FROM waited_books WHERE id_user='$id_user' AND id_book='$id_book'";
			$result1 = $link->query($sql1);
			if ($result1->num_rows > 0) {
				return true;
			}
			else{
				return false;
			}
		}
	}
	function remove_book($id_user, $id_book, $table_name){
		global $link;
		$sql = "DELETE FROM $table_name WHERE id_user='$id_user' AND id_book=$id_book";
		$result = $link->query($sql);
	}
	function append_book($id_user, $id_book, $table_name){
		global $link;
		$sql = "INSERT INTO $table_name (id_user, id_book) VALUES (`$id_user`, `$id_book`)";
		$result = $link->query($sql);
	}
	function get_book($id){
		global $link;
		$sql = "SELECT * FROM books WHERE id='$id'";
		$result = $link->query($sql);
		$arr = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return array("id" => $row["id"], "author_id" => $row["author_id"], "subject_id" => $row["subject_id"], "class_num" => $row["class_num"], "info" => $row["info"]);
			}
		}
		return false;
	}
	function get_subject($id){
		global $link;
		$sql = "SELECT * FROM subjects WHERE id='$id'";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row["name"];
			}
		}
		return false;
	}
	function get_author($id){
		global $link;
		$sql = "SELECT * FROM authors WHERE id='$id'";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row["name"];
			}
		}
		return false;
	}
	function get_class_by_id($id){
		global $link;
		$sql = "SELECT * FROM classes WHERE id='$id'";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return array("name" => $row["name"], "num" => $row["num"]);
			}
		}
		return false;
	}
	function all_authors(){
		global $link;
		$sql = "SELECT * FROM authors";
		$result = $link->query($sql);
		$arr = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[] = array("author_id" => $row["id"], "name" => $row["name"]);
			}
		}
		return $arr;
	}
	function all_subjects(){
		global $link;
		$sql = "SELECT * FROM subjects";
		$result = $link->query($sql);
		$arr = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[] = array("subject_id" => $row["id"], "name" => $row["name"]);
			}
		}
		return $arr;
	}
	function all_classes(){
		global $link;
		$sql = "SELECT * FROM classes";
		$result = $link->query($sql);
		$arr = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[] = array("class_id" => $row["id"], "class" => $row["name"], "num" => $row["num"]);
			}
		}
		return $arr;
	}
	function all_books($params){
		global $link;
		$sql = "SELECT * FROM books " . $params;
		$result = $link->query($sql);
		$arr = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[] = array("id" => $row["id"], "author_id" => $row["author_id"], "subject_id" => $row["subject_id"], "class_num" => $row["class_num"], "info" => $row["info"]);
			}
		}
		return $arr;
	}
	function all_users($params){
		global $link;
		$sql = "SELECT * FROM users " . $params;
		$result = $link->query($sql);
		$arr = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[] = array("id" => $row["id"], "login" => $row["login"], "name" => $row["name"], "class_id" => $row["class_id"],
				"take_count" => $row["take_count"], "wait_count" => $row["wait_count"], "is_admin" => $row["is_admin"]);
			}
		}
		return $arr;
	}
	function append_user($login, $password, $my_name, $is_admin, $class_id){
		global $link;
		$sql = "INSERT INTO users (login, password, name, is_admin, class_id) VALUES ('$login', '$password', '$my_name', $is_admin, $class_id)";
		$result = $link->query($sql);
	}
?>