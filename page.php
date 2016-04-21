<?php
//To keep the session alive this file is required
require_once('auth.php'); 

$page_title = 'COMP1006 Web Application | Add Page';
require_once('header.php');
?>
		<!-- Add Page Form Starts -->
		<div class="row">
			<div class="col-lg-12">					
				<form method="post" action="save-page.php" class="form-horizontal">
				<h1>Add Page</h1>
					<div class="form-group">
						<label for="title" class="control-label col-xs-2">Title</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="title" name="title" placeholder="Title">
						</div>
					</div>

					<div class="form-group">
						<label for="page_content" class="control-label col-xs-2">Content</label>
						<div class="col-sm-4">
                            <textarea type="text" class="form-control" rows="6" id="page_content" name="page_content" placeholder="Please enter the text here."></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-offset-2 col-sm-4">
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
				</form>
			</div>               
		</div> 
		<!-- Add Page Form Ends -->
<?php
require_once('footer.php');
?>
