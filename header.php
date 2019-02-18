<?php
	require_once("session.php");
	require_once("common.php");	
	ob_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

		<title>Journy</title>
		
		<link href="http://fonts.googleapis.com/css?family=Cabin:400,500,600,700,400italic,500italic,600italic,700italic|Open+Sans:300italic,400italic,600italic,700italic,800italic,300,400,600,700,800" rel="stylesheet" type="text/css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		 <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		 <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		 <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="css/app.css" rel="stylesheet">


		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.min.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
		
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/underscore-min.js"></script>
		<script src="js/backbone-min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/moment.min.js"></script>
		<script src="js/bootbox.min.js"></script>
		<script src="js/jquery.scrollTo.min.js"></script>
		
  		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
		<script src="js/bootstrap-datetimepicker.min.js"></script>
	</head>
	<body>
    <header>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Journy</a>
				</div>
				<div class="collapse navbar-collapse">
					 <ul class="nav navbar-nav navbar-right">															  
						<?php 					
			if ($sess->isLogin()) {	         					
								echo "<li class ='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>".htmlentities($mydata['name'])."<i class='caret'></i></a>";
							    echo "<ul class='dropdown-menu'>";	
								  echo "<li><a href='viewMyLogs.php'>My Travel Logs</a></li>";
                        echo "<li><a href='myTravelPlans.php'>My Travel Plans</a></li>";   
						  echo "<li><a href='frensGallery.php'>Friends' Travels</a></li>";										
							echo "<li><a href='logout.php'>Logout</a></li>";
							echo "</ul></li> </ul>";
							}		
							else{																
							echo "<a href='login.php' class='btn btn-primary navbar-right' id='login'>Login</a><";							
								}	?>           
                            
				</div>
			</div>
		</div>      
        </header>  
      <div class="buffer"></div>
		<div class="col-md-3 visible-desktop"></div>
		<div class="col-md-6">
        <?php		
			if (isset($_SESSION['flash'])) {
				foreach ($_SESSION['flash'] as $k => $v) {
					$type = $v['type'];
					echo "<div class='alert $type'><a class='close' data-dismiss='alert' href='#'>×</a>";
					echo $v['message'];
					echo "</div>";
				}
				session_start();
				unset($_SESSION['flash']);
				session_write_close();
			}
			ob_end_flush();
			?>
		</div>  