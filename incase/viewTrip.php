<?php
	require_once("session.php");
	require_once("common.php");
	$sess->authPage(2);	
	require_once("ApiClass.php");
	
	$posts_query = API::getTripPosts($_GET["id"]);
	
	$posts = array();
	while($posts[] = mysql_fetch_assoc($posts_query)) {}
	
	$trip_query = API::getTrip($_GET["id"]);
	
	$trip = array();
	while($trip[] = mysql_fetch_assoc($trip_query)) {}

	$plans_query = API::getMyPlans($_SESSION['uid']);
	while($myplans[] = mysql_fetch_assoc($plans_query)) {}
	$myplans = array();
	
	require_once("header.php");
?>
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
		<div class="container">
			<div class="page-header">
				<h1><?php echo $trip[0]["tname"] ?> <div class="fb-share-button pull-right" data-href="http://54.187.179.115/viewTrip.php?id=1" data-width="50" data-type="button"></div></h1>
			</div>
			<p><?php echo $trip[0]["tdes"] ?></p>
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<ul class="timeline"></ul>
				</div>
				<div class="hidden-xs col-sm-4 gmaps-canvas-placeholder">
					<div class="hidden-xs gmaps-canvas" data-spy="affix" data-offset-top="0">
						<div id="gmaps-canvas"></div>
					</div>
				</div>
			</div>
		</div>
		<script>
			var posts = <?php echo json_encode($posts) ?>;
			var myplans = <?php echo json_encode($myplans) ?>;
		</script>
		
		<script id="plan-template" type="text-template">
			<button class="btn btn-primary"><%= plan_name %> </button>
		</script>
		<script id="day-template" type="text-template">
			<div class="timeline-badge"><span class="glyphicon glyphicon-calendar"></span></div>
			<div class="timeline-panel">
				<div class="timeline-heading">
					<h2 class="timeline-title"><%= title %></h2>
					<p class="text-muted">
						<span class="glyphicon glyphicon-calendar"></span>
						<span><%= day %></span>
					</p>
				</div>
				<div class="timeline-body">
					<% _.each(posts, function(post) { %>
						<hr>
						<div class="post" data-marker-id="<%= post.marker %>">
							<div class="row">
								<div class="col-xs-11">
									<img src="<%= post.image %>" class="img-thumbnail">
								</div>
								<div class="col-xs-1">
									<button class="btn btn-primary pull-right addbtn" data-container="body" data-title="Add to Plan" data-toggle="popover" data-placement="left" id = "addbtn-<%= post.pid %>">
										<span class="glyphicon glyphicon-plus"></span>
									</button>
								</div>
							</div>
							<h3><%= post.title %></h3>
							<p class="text-muted">
								<span class="glyphicon glyphicon-time"></span>
								<span><%= post.time %></span>
								<span class="glyphicon glyphicon-map-marker"></span>
								<span><%= post.address %></span>
							</p>
							<p><%= post.des %></p>
						</div>
					<% }); %>
				</div>
			</div>
		</script>
		
		<script src="js/app.js"></script>
		<script src="js/viewTrip.js"></script>
	</body>
</html>
