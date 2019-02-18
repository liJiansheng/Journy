<?php
	require_once("header.php");
?>
	
	<div id="cover"><img src="img/cover.jpg"></img> </div>
		<div class="container">
			<div class="page-header">
				<h1 class="work-title text-centre">Featured Trips</h2>
			</div>
			<div class="row trips"></div>
		</div>
		<div class="row row-feature1" >
					<div class="container">                
					<div class="col-md-4 text-center">
						<i class="icon-centre icon-comments-alt icon-5x"></i>
						<h2>Log your Trip on the Go</h2>
						<p>Use our mobile website to post your photos where you are!</p>
					</div><!--/span4-->
					<div class="col-md-4 text-center">
						<i class="icon-check icon-centre icon-5x"></i>
						<h2>Share your Travel Logs</h2>
						<p>Your entire trip can be shared with your friends via a web link. Your friends can see what you have experienced in a nice activity feed. </p>
					</div><!--/span4-->
					<div class="col-md-4 text-center">
						<i class="icon-centre icon-bullhorn icon-5x"></i>
						<h2>Plan a Trip Together</h2>
						<p>See where others have been and you can plan your trip based on where others have been. Be inspired! </p>
					</div><!--/span4-->
				</div><!--/row-->
			</div><!--/container-->
       <div class="row row-feature2" >
					<div class="container">           
					<h1 class="work-title text-centre">How It Works</h1>     
					<div class="col-md-4 text-center">
						<i class="icon-centre icon-comments-alt icon-5x"></i>
						<h2>Log your Trip on the Go</h2>
						<p>Use our mobile website to post your photos where you are!</p>
					</div><!--/span4-->
					<div class="col-md-4 text-center">
						<i class="icon-check icon-centre icon-5x"></i>
						<h2>Share your Travel Logs</h2>
						<p>Your entire trip can be shared with your friends via a web link. Your friends can see what you have experienced in a nice activity feed. </p>
					</div><!--/span4-->
					<div class="col-md-4 text-center">
						<i class="icon-centre icon-bullhorn icon-5x"></i>
						<h2>Plan a Trip Together</h2>
						<p>See where others have been and you can plan your trip based on where others have been. Be inspired! </p>
					</div><!--/span4-->
				</div><!--/row-->
			</div><!--/container-->
                 

		<script id="trip-template" type="text-template">
			<div class="thumbnail">
				<img src="<%= image %>">
				<div class="caption">
					<h3><%= tname %></h3>
					<p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> <%= numdays %> days</p>
					<p><%= tdes %></p>
					<p><a href="trip.php?id=<%= tid %>" class="btn btn-primary">View Trip &raquo;</a></p>
				</div>
			</div>
		</script>		
		<script src="js/index.js"></script>
<?php
	require_once("index_footer.php");
?>