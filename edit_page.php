<?php 
//To keep the session alive below file is required
require_once('auth.php'); 

$page_title = 'Edit Page';

require_once('header.php'); 

   
//check if we have an page ID in the querystring
    if((!empty($_GET['page_id'])) && (is_numeric($_GET['page_id']))) {

    //if we do, store in a variable
    $page_id = $_GET['page_id'];

    //connect dB    
     require_once('db.php'); 
 
    //select the user name for the selected user
    $sql = "SELECT * FROM pages WHERE page_id = :page_id";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':page_id',$page_id, PDO::PARAM_INT);
	$cmd->execute();
	$pages = $cmd->fetchAll();
 
    //store each value from the database into a variable
    foreach($pages as $page){
    	$title = $page['title'];
        $page_content = $page['content'];
    }
 
    //disconnect
    $conn = null;
} // end of if 
    ?>

		<div class="row">
			<div class="col-lg-12">					
				<form method="post" action="update_page.php" class="form-horizontal">				
					<h2>Page details</h2>
                    <div class="form-group">
						<label for="title" class="control-label col-xs-2">Title</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="page_content" class="control-label col-xs-2">Content</label>
						<div class="col-sm-6">
                            <textarea type="text" class="form-control" rows="6" id="page_content" name="page_content"><?php echo $page_content; ?></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-xs-offset-2 col-sm-4">
							<input name="page_id" type="hidden" value="<?php echo $page_id; ?>" /><!-- forward the user ID as hidden value -->
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</div>
				</form>
			</div>               
		</div>        
<?php
  require_once('footer.php'); 
?>