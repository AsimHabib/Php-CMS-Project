<?php
//To keep the session alive this file is required
require_once('auth.php');

$page_title = 'COMP1006 Web Application | Site logo upload'; 
require_once('header.php');
?>
		<!-- Image Upload Form Starts -->
		<div class="row">
			<div class="col-lg-12">					
				<form method="post" action="save_logo.php" class="form-horizontal" enctype="multipart/form-data">
				<h1>Upload Site Logo</h1>					
					<div class="form-group">
						<label for="logo_image" class="col-sm-2">Logo Image:</label>
						<div class="col-sm-4">
							<input type="file" id="logo_image" name="logo_image" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-offset-2 col-sm-4">
							<button type="submit" class="btn btn-primary">Upload</button>
						</div>
					</div>
				</form>
			</div>               
		</div> 
		<!-- Registeration Form Ends -->
<?php
require_once('footer.php');
?>
