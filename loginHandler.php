<?php
	session_start();
	$user = addslashes($_POST["username"]);
	$pass = $_POST["password"];
	require_once("connect.php");
	$query=mysql_query("SELECT * FROM `user` WHERE `email` = '$user' AND `pass` = '$pass' AND `confirmed` = 1");
	if(mysql_num_rows($query)==0){
		header("Location: login.php?loginfailed=1");
		die();
	}
	else{
		while($row=mysql_fetch_array($query)){
			$_SESSION["uid"]=$row["id"];
		}
	}
	mysql_close($con);
	header("Location: frensGallery.php");
?>