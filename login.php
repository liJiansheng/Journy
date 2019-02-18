<?php
require_once("common.php");
require_once("ApiClass.php");
if (isset($_POST['submit'])) {	
	if (Api::validate($_POST['username'], $_POST['password'])) {
		if (isset($_SESSION['loginRedirect']) == false) $_SESSION['loginRedirect'] = "frensGallery.php";
		successMessage("Successfully logged in. ", $_SESSION['loginRedirect']);
	}
	else {
		errorMessage("Username and Password combination is invalid. ", $_POST['password']);
	}
}
//if ($mydata) errorMessage("You are already logged in");
require_once("header.php");?>		
		<div class="container">
			<div class="col-xs-12 text-center">
				<img src="/img/zeppelin.png" class="img-responsive">
			</div>
			<div class="col-xs-4 col-xs-offset-4">
				<div class="page-header">
					<h1 class="text-center">Login</h1>
				</div>
				<form class="form-horizontal" role="form" action="loginHandler.php" method="post">
					<div class="form-group">
						<label for="inputEmail3" class="col-md-3 control-label">Email:</label>
						<div class="col-md-9">
							<input type="email" class="form-control" id="username" name="username" placeholder="example@example.com">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">Password:</label>
						<div class="col-md-9">
							<input type="password" class="form-control" id="password" name="password" placeholder="password">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<button type="submit" name="submit" class="btn btn-primary btn-block">Sign in</button>
						</div>
					</div>
				</form>
			</div>
		</div>	
	</body>
</html>