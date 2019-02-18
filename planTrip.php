<?php
	require_once("session.php");
	require_once("common.php");
	$sess->authPage(2);	
	require_once("ApiClass.php");
		
	$planid = $_GET["id"];	
	if($_GET["id"]!=null){
		$posts_query = Api::getPlanPosts($_GET["id"]);
		
		$posts = array();
		while($posts[] = mysql_fetch_assoc($posts_query)) {}
		
		$plan_query = API::getPlan($_GET["id"]);	
		$plan = array();
		
		while($plan[] = mysql_fetch_assoc($plan_query)) {}
	}else{
		header("Location: index.php");
	}

	require_once("header.php");
?>
 
		<div class="container">
			<div class="page-header">
				<h1><?php echo $plan[0]["plan_name"] ?></h2>
			</div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#location" data-toggle="tab">My Locations</a></li>
				<li><a href="#flights" data-toggle="tab">Flights Search</a></li>
				<li><a href="#forum" data-toggle="tab">Forum</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="location">
					<div class="page-header">
						<h2>My Locations</h2>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-8">
							<ul id="plan_list" class="plan timeline"></ul>
								<div class="airplane"></div>
                                <div class="daytag"></div>
						</div>
						<div class="hidden-xs col-sm-4 gmaps-canvas-placeholder">
							<div class="hidden-xs gmaps-canvas" data-spy="affix" data-offset-top="0">
								<div id="gmaps-canvas"></div>
							</div>
						</div>
					</div>
				</div>	
				<div class="tab-pane fade" id="flights">	
					<div class="page-header">
						<h2>Flights Search</h2>
					</div>
					<div class="well well-lg">
						<br>
						<br>
						<div class="row" id="fromto">
							<div class="col-xs-12 col-sm-5 text-center">
								<p class="larger">FROM</p>
								<p class="large">Singapore</p>
							</div>
							<div class="col-xs-12 col-sm-2 text-center">
		`						<br class="visible-xs">
								<span class="glyphicon glyphicon-plane"></span>
								<br class="visible-xs">
								<br class="visible-xs">
								<br class="visible-xs">
							</div>
							<div class="col-xs-12 col-sm-5 text-center">
								<p class="larger">TO</p>
								<p class="large">Jakarta</p>
							</div>
						</div>
						<br>
						<br>
					</div>
					<br>
					<form name="findflight" class="form-horizontal" enctype="multipart/form-data" method="post">
						<div class="form-group">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-6">
										<label class="radio-inline">
											<input type="radio" id="inlineCheckbox1" name="radio" value="option1" checked> One Way
										</label>
									</div>
									<div class="col-xs-6">
										<label class="radio-inline">
											<input type="radio" id="inlineCheckbox2" name="radio" value="option2"> Round Trip
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="dptdatetimepicker" class="col-xs-12 col-sm-2 control-label">Departure Date:</label>
							<div class="col-xs-12 col-sm-10">
								<div class="input-group date" id="dptdatetimepicker" data-date-format="DD/MM/YYYY">
									<input type="text" class="form-control" id="dptDate" name="dptDate" placeholder="Select Date">
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="retdatetimepicker" class="col-xs-12 col-sm-2 control-label">Return Date:</label>
							<div class="col-xs-12 col-sm-10">
								<div class="input-group date" id="retdatetimepicker" data-date-format="DD/MM/YYYY">
									<input type="text" class="form-control" id="retDate" name="retDate" placeholder="Select Date">
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="select" class="col-xs-12 col-sm-2 control-label">No. of passengers:</label>
							<div class="col-xs-12 col-sm-10">
								<div class="well">
									<div class="form-group">
										<label for="select-4" class="col-xs-12 col-sm-2 control-label">Adults:</label>
										<div class="col-xs-12 col-sm-10">
											<input type="number" class="form-control" id="select-4" name="adults" min="0" placeholder="0">
										</div>
									</div>
									<div class="form-group">
										<label for="select-5" class="col-xs-12 col-sm-2 control-label">Children (2 - 12 years):</label>
										<div class="col-xs-12 col-sm-10">
											<input type="number" class="form-control" id="select-5" name="children" min="0" placeholder="0">
										</div>
									</div>
									<div class="form-group">
										<label for="select-6" class="col-xs-12 col-sm-2 control-label">Infants (0 - 2 years):</label>
										<div class="col-xs-12 col-sm-10">
											<input type="number" class="form-control" id="select-6" name="infants" min="0" placeholder="0">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-10 col-sm-offset-2">
								<button class="btn btn-primary" type="button" data-loading-text="Loading...">
									<span class="glyphicon glyphicon-plane"></span>
									Find flights
								</button>
							</div>
						</div>	  		
					</form>
				</div>
				<div class="tab-pane fade" id="forum">
					<div class="page-header">
						<h2>Forum</h2>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			$(function() {
				$("#dptdatetimepicker").datetimepicker({
					pickTime: false
				});	
		
				$("#retdatetimepicker").datetimepicker({
					pickTime: false
				});
				
				$("#dptdatetimepicker").on("dp.change", function (e) {
					$("#retdatetimepicker").data("DateTimePicker").setMinDate(e.date);
				});
				
				$("#retdatetimepicker").on("dp.change", function (e) {
					$("#dptdatetimepicker").data("DateTimePicker").setMaxDate(e.date);
				});	
			});
		</script>

		<?php echo "<script>
				var posts=".json_encode($posts)."
			</script>"; ?>
		
        	<script id="daytag-template" type="text-template">				
			<div class="timeline-panel">				
				<div class="timeline-heading">
					<h1 class="timeline-title"><%= dayNum %></h1>					
				</div>			
			</div>
		</script>
		<script id="flight-button-template" type="text-template">
		<button class="btn btn-primary" data-loading-text="Loading...">
			<span class="glyphicon glyphicon-plane"></span>
			Find flights between above and below locations</button>
		</script>

		<script id="place-template" type="text-template">
			<div class="timeline-badge"><span class="glyphicon glyphicon-map-marker"></span></div>
			<div id="pid" style="display: none;"><%= pid %></div>
			<div id="seq" style="display: none;"><%= sequence_num %></div>
			<div id="planid" style="display: none;"><%= planid %></div>
			<div class="timeline-panel place">				
				<div class="timeline-heading">
					<h1 class="timeline-title"><%= title %></h1>
					<p class="text-muted">
						<span class="glyphicon glyphicon-map-marker"></span>
						<span><%= address %></span>
					</p>
				</div>
				<div class="timeline-body">
					<p><%= des %></p>
				</div>
			</div>
		</script>
		
		<script id="flight-template" type="text-template">
			<div class="flight">
				<h3><%= airport1 %> to <%= airport2 %></h3>
				<p>
					Carrier: <%= carrier %> /
					Cost: $<%= cost %> /
					Departure Date: <%= departuredate %>
				</p>
			</div>
		</script>
		
		<script src="js/app.js"></script>
		<script src="js/planTrip.js"></script>
		
		<script>
			var rowSeq = [];	 
			var curSeq = [];
			var newSeq = [];
			var getPos = [];
			var seqnum;
			var pTop = [];
			var pid; 
			var planid; 
			var count = 0;
			var dayNum = 1;
			var dayCount = 1;
	
			$(function() {
				$(".plan").sortable();   
				$(".plan").on("sortout", function(event, ui) {
					curSeq = [];
					rowSeq = [];
					count = 0;
					planid = parseInt($(this).find("#planid").html());

					$("ul#plan_list > li").each(function(index, elem) {
						if($(this).find("#seq").html()!=null || $(this).find("#pid").html()!=null){			
							rowSeq[0] = parseInt($(this).find("#pid").html());
							rowSeq[1] = parseInt($(this).find("#seq").html());		
							getPos = $(elem).position();
							rowSeq[2]= getPos["top"];	
							curSeq[count] = rowSeq;										
							count++;
							rowSeq = [];								
						}								
					});		
					
					newSeq = sortSeq(curSeq);
					//alert(newSeq[0][0]);
			
					$.ajax({
						type: "POST",
						url: "editPlansSeq.php",
						data: {seqArr: newSeq, planid: planid},
						success: function(data){
							return true;
						}
					}).done(function(data) {
						//alert(data);
					});
				});	

				function swap(arr, i, j){
					var temp = arr[i];
					arr[i] = arr[j];
					arr[j] = temp;
				}

				function sortSeq(arr){
					var len = arr.length, min;	
					for (i=0; i < len; i++){
						min = i;
						for (j=i+1; j < len; j++){
							if (arr[j][2] < arr[min][2]){
								min = j;
							}
						}
						if (i != min){
							swap(arr, i, min);
						}
					}
					return arr;
				}

				/*function showProps(obj) {
				  var result = "";
				  for (var i in obj) {
					if (obj.hasOwnProperty(i)) {
						result += "." + i + " = " + obj[i] + "\n";
					}
				  }
				  return result;
				}*/
			});
		</script>	

	</body>
</html>