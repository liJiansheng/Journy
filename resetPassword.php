<?php
	require_once("common.php");
	require_once("ApiClass.php");
	//session_start();
	if(isset($_SESSION['uid'])){
		header("Location: frensGallery.php");
		die();
	}
	//if ($mydata) errorMessage("You are already logged in");
	require_once("header.php");
?>		
		<div class="container">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
				<div class="page-header">
					<h1 class="text-center">Reset Password</h1>
				</div>
				<form class="form-horizontal" role="form" action="resetPasswordHandler.php" method="post">
					<div class="form-group">
						<label for="inputEmail3" class="col-xs-12 col-sm-3 control-label">Email:</label>
						<div class="col-xs-12 col-sm-9">
							<input type="email" class="form-control" id="username" name="username" placeholder="example@example.com">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<button type="submit" name="submit" class="btn btn-primary btn-block">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>	
	</body>
</html>