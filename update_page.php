<?php ob_start(); // start the output buffer. It requires when the is header(location) function
//To keep the session alive below file is required
require_once('auth.php'); 

$page_title = 'Update Page';

require_once('header.php'); 
//addt the error handler in case anything breakes
try{
	
$page_id = null;

//Store the form inputs in variables
$title = $_POST['title'];
$page_content = $_POST['page_content'];
$page_id = $_POST['page_id'];

//Create a flag to track the completion status of the form
$ok = true;

//Do the form validation before saving
//validate the form values, if not correct display the error message

echo '<div class="alert alert-warning">';
if (empty($title)) {
	echo '<span class="error">*</span> Title is required.<br />';
	$ok = false;
}
if (empty($page_content)){
	echo '<span class="error">*</span>Text field is required<br />';
	$ok = false;
}
if($ok == false){
    echo '<br /><a href="#" onclick="history.go(-1)" class="btn btn-warning btn-xs">Go Back</a>'; //go back button
    }
echo '</div>'; // close the warning div	

// save only if the form is complete
if ($ok) {

	// Connecting the DB
    require_once('db.php'); 

	// if we have the existing page id
	if(!empty($page_id)){
		$sql ="UPDATE pages SET title =:title, content =:page_content WHERE page_id =:page_id";
	}	
	
	// set the command object
	$cmd = $conn->prepare($sql);

	//fill the placeholder with the 4 input variable
	$cmd->bindParam(':title', $title, PDO::PARAM_STR, 25);
	$cmd->bindParam(':page_content', $page_content, PDO::PARAM_STR);
	// bindParam has the builtin sql injection prevention


// add the page_id param if updating
	if(!empty($page_id)){
		$cmd->bindParam(':page_id',$page_id,PDO::PARAM_INT);
	}
	//execute the interst
	$cmd->execute();
	
	header("Refresh: 2; url=pages_list.php"); // redirect after updation
	//header('location:pages_list.php');
	echo '<div class="alert alert-success">Page is updated.<br />
		You\'ll be redirected.. If not, click <a href="pages_list.php">here</a>.	
	  </div>'; // close the success div

	//diconnecting DB
	$conn = null;
	
} // end of $ok if
}// close the error handler bracket
//catch exception
catch(Exception $e) {
 // echo 'Message: ' .$e->getMessage();
  
  // send overself the an email about the error
    mail('asimwins@gmail.com', 'update Error',$e);
    
  // redirect the page to error page
   header('location:error.php');   
}
require_once('footer.php');
ob_flush();
?>