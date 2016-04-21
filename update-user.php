<?php ob_start(); // start the output buffer. It requires when the is header(location) function
//To keep the session alive below file is required
require_once('auth.php'); 

$page_title = 'Update User';

require_once('header.php'); 
//addt the error handler in case anything breakes
try{
	
$user_id = null;

//Store the form inputs in variables
$user_name = $_POST['user_email'];
$user_password = $_POST['user_password'];
$user_id = $_POST['user_id']; //get the user ID from the hidden form field

//Create a flag to track the completion status of the form
$ok = true;

//Do the form validation before saving
//validate the form values, if not correct display the error message

echo '<div class="alert alert-warning">';
if (empty($user_name)) {
	echo '<span class="error">*</span> Email is required.<br />';
	$ok = false;
}
if(!filter_var($user_name, FILTER_VALIDATE_EMAIL)){
	echo '<span class="error">*</span> Valid email is required.<br />';
	$ok = false;
}
if (empty($user_password)){
	echo '<span class="error">*</span>Password is required<br />';
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

	// if we have the existing game id
	if(!empty($user_id)){
		$sql ="UPDATE users SET username =:user_name, password =:user_password WHERE user_id =:user_id";
	}
	
	//hash the password, it'll requre two parameteres
	$hashed_password = hash('sha512', $user_password); //sha512 algorithm convert the password into the 128 character
	// set the command object
	$cmd = $conn->prepare($sql);

	//fill the placeholder with the 4 input variable
	$cmd->bindParam(':user_name', $user_name, PDO::PARAM_STR, 50);
	$cmd->bindParam(':user_password', $hashed_password, PDO::PARAM_STR, 128);
	// bindParam has the builtin sql injection prevention


// add the user_id param if updating
	if(!empty($user_id)){
		$cmd->bindParam(':user_id',$user_id,PDO::PARAM_INT);
	}
	//execute the interst
	$cmd->execute();
	
	header("Refresh: 2; url=view_users_list.php"); // redirect after updation
	//header('location:view_users_list.php');
	echo '<div class="alert alert-success">User is updated.<br />
		You\'ll be redirected.. If not, click <a href="view_users_list.php">here</a>.	
	  </div>'; // close the success div

	//diconnecting DB
	$conn = null;
	
} // end of $ok if
}// close the error handler bracket
//catch exception
catch(Exception $e) {
  //echo 'Message: ' .$e->getMessage();
  
  // send overself the an email about the error
    mail('asimwins@gmail.com', 'User update Error',$e);
    
  // redirect the page to error page
   header('location:error.php');   
}
require_once('footer.php');
ob_flush();
?>