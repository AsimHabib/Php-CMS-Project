<?php ob_start(); // start the output buffer. It requires when the is header(location) function
$page_title = 'COMP1006 Web Application | User Registeration';
require_once('header.php');

//collect the form values send from login.php page and store in the variables
$username = $_POST['user_email'];
$password = hash('sha512', $_POST['user_password']);

// DB connection
require_once('db.php');

$sql = "SELECT user_id FROM users WHERE username = :username AND password = :password";

$cmd = $conn->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
$cmd->execute();

$users = $cmd->fetchAll();

//Returns the number of rows affected by SQL statement 
$count = $cmd->rowCount();

if ($count == 0) {
	echo '<div class="alert alert-warning"><span class="error">*</span>Wrong user name and password.<br />
    <br /><a href="#" onclick="history.go(-1)" class="btn btn-warning btn-xs">Go Back</a></div>';
	require_once('footer.php');
	exit();	
}
else {
	session_start();//session starts here
	foreach($users as $user) {		
		$_SESSION['user_id']=$user['user_id'];
   } 
}
$conn = null;
  header('location:index.php');

  ob_flush(); ?>
