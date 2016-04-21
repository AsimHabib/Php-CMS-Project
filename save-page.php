<?php ob_start(); // start the output buffer. It requires when the is header(location) function

//To keep the session alive this file is required
require_once('auth.php'); 

$page_title = 'COMP1006 Web Application | Save Page';
require_once('header.php');

//addt the error handler in case anything breakes
try{

//collect the form values send from page.php page and store in the variables
$title = $_POST['title']; 
$page_content = $_POST['page_content'];

//Create a flag to track the completion status of the form
$ok = true;

//validate the form values, if not correct display the error message
echo '<div class="alert alert-warning">';
if (empty($title)) {
	echo '<span class="error">*</span>Title is required.This field can not be empty.<br />';
	$ok = false;
}
if (empty($page_content)){
	echo '<span class="error">*</span>Page text is required.This field can not be empty.<br />';
	$ok = false;
}
echo '<br /><a href="#" onclick="history.go(-1)" class="btn btn-warning btn-xs">Go Back</a></div>'; // close the warning div	
	
/******************************************************
If all is good and there is no error then enter the
new user into the database
******************************************************/
if($ok){

//connection    
require_once('db.php');	

//Set the SQL command to save the new user
$sql = "INSERT INTO pages(title, content) VALUES (:title, :page_content)";
	
		
	//fill the params execute
	$cmd = $conn->prepare($sql);
	$cmd->bindParam(':title', $title, PDO::PARAM_STR, 25);
	$cmd->bindParam(':page_content', $page_content, PDO::PARAM_STR);
	$cmd->execute();
	
	//disconnect the connection from DB
	$conn = null;
	
	//user registration confirmation message
	echo '<div class="alert alert-success">Page Added Successfully.<br /> Click <a href="pages_list">Here</a></div>'; // close the success div
    
    //Redirect after success
   // header('location:pages_list.php');
    header("Refresh: 2; url=pages_list.php");
}//end of $ok if

}// close the error handler bracket
//catch exception
catch(Exception $e) {
  //echo 'Message: ' .$e->getMessage();
  
  // send overself the an email about the error
    mail('asimwins@gmail.com', 'User Listing Error',$e);
    
  // redirect the page to error page
   header('location:error.php');   
}

require_once('footer.php');
ob_flush();
?>