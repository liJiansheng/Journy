<?php
	session_start();
	if(!isset($_SESSION["uid"])){
		header("Location: login.php");
	}
require_once("connect.php");
mysql_query("INSERT INTO planspost VALUES ($_SESSION[uid], $_GET[pid] 24)");
?>