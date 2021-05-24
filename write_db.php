<?php
	session_start();
	require_once "base.php";
	if($_SESSION["my_name"] == "") header('Location: index.php');
	if($_POST["type"] == "remove"){
		remove_book($_SESSION["my_id"], (int)$_POST["id"], "taked_books");
		append_book($_SESSION["my_id"], (int)$_POST["id"], "waited_books");
		$_SESSION["take_count"] -= 1;
		reload_count($_POST["user_id"], "take_count", -1);
		$_SESSION["wait_count"] += 1;
		reload_count($_POST["user_id"], "wait_count", 1);
	}
	else if($_POST["type"] == "take"){
		append_book($_SESSION["my_id"], (int)$_POST["id"], "taked_books");
		$_SESSION["take_count"] += 1;
		reload_count($_SESSION["my_id"], "take_count", 1);
		echo "comlete";
	}
	else if($_POST["type"] == "return"){
		remove_book($_SESSION["my_id"], (int)$_POST["id"], "waited_books");
		append_book($_SESSION["my_id"], (int)$_POST["id"], "taked_books");
		$_SESSION["take_count"] += 1;
		reload_count($_SESSION["my_id"], "take_count", 1);
		$_SESSION["wait_count"] -= 1;
		reload_count($_SESSION["my_id"], "wait_count", -1);
	}
?>