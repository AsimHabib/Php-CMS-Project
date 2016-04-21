<?php
//acccess the current session by calling session start
session_start();
if(empty($_SESSION['user_id'])){
	header("location:login.php");
	exit();
}
?>