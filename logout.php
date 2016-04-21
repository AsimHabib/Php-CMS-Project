<?php ob_start(); // start the output buffer. It requires when the is header(location) function. It also prevent from " headers already sent" error
require_once('header.php');
session_start();// need to start the session so it can be destroyed
session_unset(); // this  function frees all session variables currently registered.
session_destroy(); //destroys all of the data associated with the current session

//header("location:login.php");
header("Refresh: 2; url=index.php");
//echo '<div class="alert alert-success">Logged out successful.<br /></div>'; 
echo '<div class="alert alert-success">You have been Successfully logged out<br />You\'ll be redirected in about 2 secs. If not, click <a href="login.php">here</a>.</div>'; 

require_once('footer.php');
ob_flush();
?>