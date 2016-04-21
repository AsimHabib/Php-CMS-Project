<?php ob_start(); // start the output buffer. It requires when the is header(location) function
//To keep the session alive this file is required
require_once('auth.php'); 

$page_title = 'User Listings';

require_once('header.php'); 
?>
<h2>List of registered users</h2>
	
<?php

//add the error handler in case anything breakes
try{

//Connect
require_once('db.php'); 

//Write the query to fetch the user data
$sql = "SELECT * FROM users";

//run the query and store the result into memory
$cmd = $conn->prepare($sql);
$cmd->execute();
$users = $cmd->fetchAll();

// Start the table and the headings
echo '<table class="table table-striped">
<thead>
<th>User Name</th>
<th>Edit</th>
<th>Delete</th>
</thead>
<tbody>';


/* loop through the data, creating a new table row for 
each userand putting each value in a new column
*/
foreach($users as $user){
	//Display the data
	echo '<tr><td>' . $user['username'] . '</td>
	<td><a href="edit_user.php?user_id='.$user['user_id'].'" class="btn btn-info">Edit</td>
	<td> <a href="delete-user.php?user_id='. $user['user_id'] .'" onclick="return confirm(\'Are you sure?\')" class="btn btn-danger">Delete</a></td></tr>';	
}

//close the table
echo '</tbody></table>';

//disconnect DB
$conn = null;

}// close the error handler bracket
catch(Exception $e){
    // send overself the an email about the error
    mail('asimwins@gmail.com', 'users Listing Error',$e);
    
    // redirect the page to error page
    header('location:error.php');    
}

require_once('footer.php'); 
ob_flush();
?>