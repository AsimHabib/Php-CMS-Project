<?php ob_start(); // start the output buffer. It requires when the is header(location) function
//To keep the session alive this file is required
//require_once('auth.php'); 
session_start();

$page_title = 'COMP1006 Web Application | Send email';
require_once('header_main.php');


//collect the form values send from page.php page and store in the variables
$name = $_POST['name']; 
$message = $_POST['message'];



//Create a flag to track the completion status of the form
$ok = true;

//validate the form values, if not correct display the error message
echo '<div class="alert alert-warning">';
if (empty($name)) {
	echo '<span class="error">*</span>Name is required. This field can not be empty.<br />';
	$ok = false;
}
if (empty($message)){
	echo '<span class="error">*</span>Message is required.This field can not be empty.<br />';
	$ok = false;
}
echo '<br /><a href="#" onclick="history.go(-1)" class="btn btn-warning btn-xs">Go Back</a></div>'; // close the warning div	
	
/******************************************************
If all is good and there is no error then send the
email.
******************************************************/
if($ok){

$emailTo = 'asimhabib2@gmail.com';
$subject ='Email from website';

// use the PHP buit- in function to send the email
mail($emailTo, $subject, $message, 'From:asimwins@gmail.com');
//mail('asimwins@gmail.com', 'Email from website','Sending the email from the php website', 'From:asimwins@gmail.com');


//user registration confirmation message
echo '<div class="alert alert-success">Message sent successfully.</div><br />';

//Redirect after success
// header('location:pages_list.php');
header("Refresh: 2; url=index.php");
}//end of $ok if

require_once('footer.php');
ob_flush();
?>