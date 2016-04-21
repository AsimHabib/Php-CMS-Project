<?php ob_start(); // start the output buffer. It requires when the is header(location) function
require_once('header.php');
//read and select the user_id from url's query string using GET
// need to use the GET instead of pOST becuase we want to collect the QueryString
$user_id = $_GET['user_id'];

if(is_numeric($user_id)){ // is checking that data should be numeric

//Connect DB
require_once('db.php'); 

// write and run the delete query
$sql = "DELETE FROM users WHERE user_id = :user_id"; // this is the way to prevent SQL injectoin by using placeholder

$cmd = $conn->prepare($sql);
$cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$cmd->execute();

// disconnect
$conn = null;

//redirect back to view_users_list.php
//header('location:view_users_list.php');
header("Refresh: 1; url=view_users_list.php");
echo '<div class="alert alert-success">User deleted successfully.<br />You\'ll be redirected in about 2 secs. If not, click <a href="view_users_list.php">here</a>.</div>'; 

}
require_once('footer.php');
ob_flush();
?>