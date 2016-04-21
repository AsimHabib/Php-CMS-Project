<?php
/***********************************
Below block of code fetch the logo
image info from the database
***********************************/
//Connect
require_once('db.php'); 

//Write the query to fetch the data
$sql = "SELECT * FROM pageImages";

//run the query and store the result into memory
$cmd = $conn->prepare($sql);
$cmd->execute();
$pageImages = $cmd->fetchAll();

foreach($pageImages as $image){
   
    $logo = $image['logoImage'];
}

//disconnect DB
//$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $page_title; ?></title>

    <!-- Bootstrap Core CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- Custom CSS -->
    <!-- <link href="css/styles.css" rel="stylesheet"> -->
	<style>
		@import url("css/styles.css");
	</style>

   	<!-- Add the fontawesome links-->   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<body>

    <!-- Navigation -->
	<nav class="navbar navbar-default" role="navigation">	
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a href="index.php" class="pull-left brand-font navbar-brand" title="COMP1006 Web Application" class="">
                    <?php if (!empty($logo)) {
                        echo '<img src="images/' . $logo . '" title="COMP1006 Web Application" height="36" />';
                    } ?><!-- COMP1006 Web App --></a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<!-- <a href="index.php" title="COMP1006 Web Application" class="navbar-brand">
					<i class="fa fa-user icon-large"></i> COMP1006 Web App </a> -->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">                				
				<?php 
                /***********************************
                Below block of code displays the 
                public site links.
                ***********************************/
                //Connect
				//require_once('db.php'); 

				//Write the query to fetch the data
				$sql = "SELECT * FROM pages";

				//run the query and store the result into memory
				$cmd = $conn->prepare($sql);
				$cmd->execute();
				$links = $cmd->fetchAll();
                
                echo '<ul class="nav navbar-nav main">';
                //display the public site links with loop
				foreach($links as $link){										
				    echo '<li><a href="index.php?page_id='.$link['page_id'].'" title="'. $link['title'].'">' . $link['title']. '</a></li> ';
				}
                echo '</ul>'; 
                //disconnect DB
                //$conn = null;
					
                    //Session was started in the validate.php file
					if(!empty($_SESSION['user_id'])){ ?>
					<ul class="nav navbar-nav navbar-right">
                        <li><a href="admin_index.php" title="Admin Panel"><i class="fa fa-cog"></i> Admin Panel</a></li>  
                        <li><a href="logout.php" title="Logout"><i class="fa fa-sign-out"></i> Logout</a></li>
				    </ul>
					<?php } else { ?>
					<ul class="nav navbar-nav navbar-right">					
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php"><i class="fa fa-sign-in"></i> Login</a></li>
					</ul>
					<?php }  ?>               						
            </div>
            <!-- /.navbar-collapse -->			
        </div>
        <!-- /.container -->		
    </nav>
    <!-- Page Content -->
    <div class="container">