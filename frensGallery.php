<?php
	require_once("session.php");
	require_once("common.php");
	$sess->authPage(2);	
	require_once("ApiClass.php");
	$trips= array();
	$query = Api::getFrensTripID($_SESSION["uid"]);

	$data = array();
	while($r = mysql_fetch_assoc($query)) {
		$data[] = $r;
	}
	$temp = array();
	$prev = array();
	foreach ($data as $k => $v) {
	$query2 = Api::getFrensTrip($v["tid"]);
	$tu = array();
	while($t = mysql_fetch_assoc($query2)) {
		$tu[] = $t;
	}
	
	if($prev!=null){
		$temp = array_merge($tu,$prev);  
		$prev = $temp;
	}else{
		$prev = $tu;	
	}	
	}
	$trips = $prev;		
	require_once("header.php");
?>	
		<div class="container">
			<div class="page-header">
				<h1>My Friend's Trips</h2>
			</div>
			<div class="row trips"></div>
		</div>
		<?php echo "<script>
				var trips=".json_encode($trips)."
			</script>"; ?>            
		<script id="trip-template" type="text-template">		
			<div class="thumbnail">
			<p class="text-muted"><span class="glyphicon glyphicon-user"></span><%= name %></p>
				<img src="<%= image %>">
				<div class="caption">
					<h3><%= tname %></h3>
					<p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> <%= numdays %> days</p>
					<p><%= tdes %></p>
					<p><a href="viewTrip.php?id=<%= tid %>" class="btn btn-primary">View Trip &raquo;</a></p>
				</div>
			</div>	
		</script>
		
		<script src="js/index.js"></script>
	</body>
</html>
