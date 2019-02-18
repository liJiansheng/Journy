<?php
	require_once("header.php");
?>
	
<div id="cover">


 </div>
		<div class="container">
			<div class="page-header">
				<h1>My Friend's Trips</h2>
			</div>
			<div class="row trips"></div>
		</div>
	
            
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
	</body>
</html>
