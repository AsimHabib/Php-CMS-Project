<?php ob_start(); // start the output buffer. It requires when the is header(location) function
require_once('header.php');
//read and select the page_id from url's query string using GET
// need to use the GET instead of POST becuase we want to collect the info passed by the QueryString
$page_id = $_GET['page_id'];

//addt the error handler in case anything breakes
try{ 

if(is_numeric($page_id)){ // is checking that data should be numeric

//Connect DB
require_once('db.php'); 

// write and run the delete query
$sql = "DELETE FROM pages WHERE page_id = :page_id"; // this is the way to prevent SQL injectoin by using placeholder

$cmd = $conn->prepare($sql);
$cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
$cmd->execute();

// disconnect
$conn = null;

//redirect back to pages_list.php
//header('location:view_users_list.php');
header("Refresh: 1; url=pages_list.php");
echo '<div class="alert alert-success">Page deleted successfully.<br />You\'ll be redirected in about 2 seconds. If not, click <a href="pages_list.php">here</a>.</div>'; 

}
    
}// close the error handler bracket
//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
  
  // send overself the an email about the error
   // mail('asimwins@gmail.com', 'update Error',$e);
    
  // redirect the page to error page
  // header('location:error.php');   
}    
require_once('footer.php');
ob_flush();
?>