<?php
	session_start();
	require_once "base.php";
	if($_SESSION["my_name"] == "") header('Location: index.php');
	if($_POST["type"] == "remove"){
		remove_book($_SESSION["my_id"], (int)$_POST["id"], "taked_books");
		append_book($_SESSION["my_id"], (int)$_POST["id"], "waited_books");
	}
	else if($_POST["type"] == "take"){
		if(!i_have_book($_SESSION["my_id"], $_POST["id"])){
			append_book($_SESSION["my_id"], (int)$_POST["id"], "taked_books");
			echo "comlete";
		}
		else echo "failed";
	}
	else if($_POST["type"] == "return"){
		remove_book($_SESSION["my_id"], (int)$_POST["id"], "waited_books");
		append_book($_SESSION["my_id"], (int)$_POST["id"], "taked_books");
	}
?>