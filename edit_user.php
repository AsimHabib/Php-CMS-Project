<?php 

//To keep the session alive below file is required
require_once('auth.php'); 

$page_title = 'Edit User';

require_once('header.php'); 

        
//intialize the variables to prevent the "Undefined variable" error
$user_name = null;
   
//check if we have an user ID in the querystring
    if((!empty($_GET['user_id'])) && (is_numeric($_GET['user_id']))) {

    //if we do, store in a variable
    $user_id = $_GET['user_id'];

    //connect dB    
     require_once('db.php'); 
 
    //select the user name for the selected user
    $sql = "SELECT username FROM users WHERE user_id = :user_id";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':user_id',$user_id, PDO::PARAM_INT);
	$cmd->execute();
	$users = $cmd->fetchAll();
 
    //store each value from the database into a variable
    foreach($users as $user){
    	$user_name = $user['username'];
    }
 
    //disconnect
    $conn = null;
} // end of if 
    ?>

		<div class="row">
			<div class="col-lg-12">					
				<form method="post" action="update-user.php" class="form-horizontal">				
					<h2>User details</h2>
					<div class="form-group">
						<label for="inputEmail" class="control-label col-xs-2">Email</label>
						<div class="col-sm-4">
							<input type="email" class="form-control" id="inputEmail" name="user_email" value="<?php echo $user_name; ?>" placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword" class="control-label col-xs-2">New Password</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="inputPassword" name="user_password" placeholder="Password">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-xs-offset-2 col-sm-4">
							<input name="user_id" type="hidden" value="<?php echo $user_id; ?>" /><!-- forward the user ID as hidden value -->
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</div>
				</form>
			</div>               
		</div>        
<?php
  require_once('footer.php'); 
?>