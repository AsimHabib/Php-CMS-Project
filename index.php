<?php
//To keep the session alive below file is required
//require_once('auth.php'); 
session_start();
$page_title = 'COMP1006 Web Application | Home';
require_once('header_main.php');

//add the error handler in case anything breakes
try{

//check if we have an page ID in the querystring
    if((!empty($_GET['page_id'])) && (is_numeric($_GET['page_id']))) {

    //if we do, store in a variable
    $page_id = $_GET['page_id'];

    //connect dB    
     require_once('db.php');
	
	
	//query to fetch the content from the Db
    $sql = "SELECT * FROM pages WHERE page_id = :page_id";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':page_id',$page_id, PDO::PARAM_INT);
	$cmd->execute();
	$pages = $cmd->fetchAll();
	
	$title = null;
	$page_content = null;
    //loop through the data,store each value from the database into a variable
    foreach($pages as $page){
    	$title = $page['title'];
        $page_content = $page['content'];
    }

//disconnect DB
$conn = null;
}
}// close the error handler bracket
catch(Exception $e){
    
    //display error message
    //echo 'Message: ' .$e->getMessage();
    
    // send overself the an email about the error
    mail('asimwins@gmail.com', 'users Listing Error',$e);
    
    // redirect the page to error page
    header('location:error.php');    
}

?>
    <!-- main content -->
	<?php 
	// when the page is loaded first time then there is no data. So display the hard coded content in the default page 
	if($page_content == ""){ ?>
		<div class="jumbotron">
			<h2>Welcome To My Website</h2>
			<p>This is welcome message. </p>
	   </div>

		<div class="row">
			<div class="col-lg-12">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>               
		</div>
	<?php } 
	//If it is contact page through the page_id then display the form 
	else if($title == "Contact"){ ?>
	<div class="row">
			<div class="col-lg-12">	
			<h2><?php echo $title; ?></h2>
            <p><?php echo $page_content; ?></p>
				<form method="post" action="send_email.php" class="form-horizontal">
					<div class="form-group">
						<label for="name" class="control-label col-xs-2">Name</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="name" name="name" placeholder="please enter the name">
						</div>
					</div>

					<div class="form-group">
						<label for="message" class="control-label col-xs-2">Message</label>
						<div class="col-sm-4">
                            <textarea type="text" class="form-control" rows="6" id="message" name="message" placeholder="Please enter your message here."></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-offset-2 col-sm-4">
							<button type="submit" class="btn btn-primary">Send</button>
						</div>
					</div>
				</form>
			</div>               
		</div> 		
	<?php } 
	// else display the page content according to the page_id called.
	else {?>		
    <div class="row">
        <div class="col-lg-12">
            <h2><?php echo $title; ?></h2>
            <p><?php echo $page_content; ?></p>
        </div>               
    </div>	
	
	<?php }
require_once('footer.php');
?>
