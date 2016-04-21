<?php ob_start(); // start the output buffer. It requires when the is header(location) function
session_start();
$page_title = 'COMP1006 Web Application | User Registeration';
require_once('header.php');

//addt the error handler in case anything breakes
try{

//collect the form values send from register.php page and store in the variables
$user_name = $_POST['user_email']; //collecting the email as user name
$user_password = $_POST['user_password'];
$confirm_user_password = $_POST['confirm_user_password'];

//Create a flag to track the completion status of the form
$ok = true;


/******************************************************************
Below block of code fetch the existing user from the database and 
compare with the new proposed user name. If it already exists then 
display the error message and stop the script to run further.
*******************************************************************/
//connection
require_once('db.php');

//fetch the existing user names from the database
$sql = "SELECT username FROM users";

//run the query and store the result into memory
$cmd = $conn->prepare($sql);
$cmd->execute();
$userName = $cmd->fetchAll();

//store each value from the database into a variable							
$exitingUser = null;// intialize the variables to prevent the "Undefined variable" error        
    
foreach($userName as $userEmail){
    	$exitingUser = $userEmail['username'];	// username is the colum name in the DB	
    }

// this Php function remove all illegal characters from email and validate is as email
  //$user_name = filter_var($user_name, FILTER_SANITIZE_EMAIL);

//validate the form values, if not correct display the error message
echo '<div class="alert alert-warning">';
if (empty($user_name)) {
	echo '<span class="error">*</span> Email is required as user name to complete the registeration<br />';
	$ok = false;
} else if($user_name == $exitingUser){ //check if user already exists or not.
	echo '<span class="error">*</span>User already exists by this email. Please use the different email address.<br />';
	$ok = false;
}else if(!filter_var($user_name, FILTER_VALIDATE_EMAIL)){
	echo '<span class="error">*</span> Valid email is required to complete the registration<br />';
	$ok = false;
}

if (empty($user_password)){
	echo '<span class="error">*</span> Password is required<br />';
	$ok = false;
}
if (empty($confirm_user_password)){
	echo '<span class="error">*</span> Password confirmation is required<br />';
	$ok = false;
}
if ($confirm_user_password != $user_password ){
	echo '<span class="error">*</span> Please make sure you enter the matching password<br />';
	$ok = false;
}

echo '<br /><a href="#" onclick="history.go(-1)" class="btn btn-warning btn-xs">Go Back</a>'; //go back button   
echo '</div>'; // close the warning div	
	
/******************************************************
If all is good and there is no error then enter the
new user into the database
******************************************************/
if($ok){	
//require_once('db.php');	
	//Set the SQL command to save the new user
	$sql = "INSERT INTO users (username, password) VALUES (:user_name, :user_password)";
	
	//hash the password, it'll requre two parameteres
	$hashed_password = hash('sha512', $user_password); //sha512 algorithm convert the password into the 128 character
	
	//fill the params execute
	$cmd = $conn->prepare($sql);
	$cmd->bindParam(':user_name', $user_name, PDO::PARAM_STR, 50);
	$cmd->bindParam(':user_password', $hashed_password, PDO::PARAM_STR, 128);
	$cmd->execute();
	
	//disconnect the connection from DB
	$conn = null;
	
	//user registration confirmation message
	echo '<div class="alert alert-success">Regestration successful.<br /> Click <a href="login.php">Log In</a></div>'; // close the success div
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