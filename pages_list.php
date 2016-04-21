<?php ob_start(); // start the output buffer. It requires when the is header(location) function
//To keep the session alive this file is required
require_once('auth.php'); 

$page_title = 'Pages List';

require_once('header.php'); 
?>
<h2>List of Pages</h2>
	
<?php

//add the error handler in case anything breakes
try{

//Connect
require_once('db.php'); 

//Write the query to fetch the user data
$sql = "SELECT page_id,title FROM pages";

//run the query and store the result into memory
$cmd = $conn->prepare($sql);
$cmd->execute();
$pages = $cmd->fetchAll();

// Start the table and the headings
echo '<table class="table table-striped">
<thead>
<th>Title</th>
<th>Edit</th>
<th>Delete</th>
</thead>
<tbody>';


/* loop through the data, creating a new table row for 
each userand putting each value in a new column
*/
//$pages  = null;

foreach($pages as $page){
	//Display the data
	echo '<tr><td>' . $page['title'] . '</td>
	<td><a href="edit_page.php?page_id='.$page['page_id'].'" class="btn btn-info">Edit</td>
	<td> <a href="delete_page.php?page_id='. $page['page_id'] .'" onclick="return confirm(\'Are you sure?\')" class="btn btn-danger">Delete</a></td></tr>';	
}

//close the table
echo '</tbody></table>';

//disconnect DB
$conn = null;

}// close the error handler bracket
catch(Exception $e){
    
    //display error message
    //echo 'Message: ' .$e->getMessage();
    
    // send overself the an email about the error
    mail('asimwins@gmail.com', 'users Listing Error',$e);
    
    // redirect the page to error page
    header('location:error.php');    
}

require_once('footer.php'); 
ob_flush();
?>