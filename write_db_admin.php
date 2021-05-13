<?php
	session_start();
	require_once "base.php";
	if($_SESSION["my_name"] == "") header('Location: index.php');
	if($_POST["type"] == "remove"){
		remove_book($_POST["user_id"], (int)$_POST["id"], "taked_books");
		append_book((int)$_POST["user_id"], (int)$_POST["id"], "accepted_books");
	}
	else if($_POST["type"] == "take"){
		if(!i_have_book($_POST["user_id"], $_POST["id"])){
			append_book((int)$_POST["user_id"], (int)$_POST["id"], "taked_books");
			echo "comlete";
		}
		else echo "failed";
	}
	else if($_POST["type"] == "return"){
		remove_book($_POST["user_id"], (int)$_POST["id"], "waited_books");
		append_book((int)$_POST["user_id"], (int)$_POST["id"], "taked_books");
	}
	else if($_POST["type"] == "accept"){
		remove_book($_POST["user_id"], (int)$_POST["id"], "waited_books");
		append_book((int)$_POST["user_id"], (int)$_POST["id"], "accepted_books");
	}
	else if($_POST["type"] == "append"){
		append_book((int)$_POST["user_id"], (int)$_POST["id"], "taked_books");
	}
?>