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
    <link href="css/styles.css" rel="stylesheet">

   	<!-- Add the fontawesome links-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">	
</head>

<body>

    <!-- Navigation -->    
	<nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a href="index.php" title="COMP1006 Web Application" class="navbar-brand">
					<i class="fa fa-user icon-large"></i> COMP1006 Web App
				</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">                				
				<?php 
					//session_start();
					//Session was started in the validate.php file
					if(!empty($_SESSION['user_id'])){ ?>
					<ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php" title="Public website">Public Website</a></li>
                        <li><a href="logo.php" title="Site log">Logo</a></li>
                        <li><a href="view_users_list.php" title="View List">All Users</a></li> 
						<li><a href="add_user.php" title="View List">Add User</a></li> 
                        <li><a href="pages_list.php" title="Page List">All Pages</a></li>    
                        <li><a href="page.php" title="Add Page">Add Page</a></li>
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