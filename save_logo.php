<?php ob_start(); // start the output buffer. It requires when the is header(location) function
//To keep the session alive this file is required
require_once('auth.php');

$page_title = 'COMP1006 Web Application | Site logo upload'; 
require_once('header.php');

//addt the error handler in case anything breakes
try{

// create a flag to track the completion status of the form
$ok = true;


//validate the form values, if not correct display the error message

if (empty($_FILES['logo_image']['name'])) {
	echo '<div class="alert alert-warning">';
	echo '<span class="error">*</span>Please select the image.<br />';
	echo '<br /><a href="#" onclick="history.go(-1)" class="btn btn-warning btn-xs">Go Back</a></div>';
	$ok = false;
}



// check for photo, validate its type, and save it if there is one
if (!empty($_FILES['logo_image']['name'])) {
    $logo_image = $_FILES['logo_image']['name'];
    $type = $_FILES['logo_image']['type'];
    $tmp_name = $_FILES['logo_image']['tmp_name'];

    // validate file type
    if ($type != 'image/jpeg') {
        echo 'Invalid file type.Please select the JPG<br />';
        $ok = false;
    }
    else {

        if ($ok) {
            // save the image if no validation errors found
            $final_image = session_id() . "-" . $logo_image;
            move_uploaded_file($tmp_name, "images/$final_image");
        }
    }
}

// save ONLY IF the form is complete
if ($ok) {

    // database connection
    require_once('db.php');

    // set up an SQL command to save the new game
    $sql = "INSERT INTO pageImages (logoImage) VALUES (:logo_image)";
    
    // set up a command object
    $cmd = $conn->prepare($sql);

    // fill the placeholders with the 4 input variables
    $cmd->bindParam(':logo_image', $final_image, PDO::PARAM_STR, 255);
    

    // execute the query
    $cmd->execute();

    // disconnecting
    $conn = null;
   
    //image upload confirmation message
	echo '<div class="alert alert-success">Logo uploaded successfully.<br /> Click <a href="pages_list.php">Here</a></div>'; // close the success div
    
    //Redirect after success
   // header('location:pages_list.php');
    header("Refresh: 2; url=pages_list.php");

}

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
