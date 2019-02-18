<?php
require_once("session.php");
require_once("common.php");
$sess->authPage(2);	
require_once("ApiClass.php");
	
	$posts_query = Api::getPlanPosts($_GET["id"]);
	
	$posts = array();
	while($posts[] = mysql_fetch_assoc($posts_query)) {}
	
	$plan_query = API::getPlan($_GET["id"]);
	
	$plan = array();
	while($plan[] = mysql_fetch_assoc($plan_query)) {}
	require_once("header.php");
?>

  <script type="text/javascript">
  $(function() {
      $('#dptdatetimepicker').datetimepicker({
      pickTime: false
    });	
	
      $('#retdatetimepicker').datetimepicker({
      pickTime: false
    });
  });
  </script>
		<div class="row">
			<div class="col-md-4 col-md-offset-3 well">			
			<div id="fromto">
			<i class="glyphicon glyphicon-plane"></i>
				<h1>FROM<i class="glyphicon glyphicon-arrow-right"></i>TO</h1>
			</div>                                      
                            
<form name = "findflight" class='form-horizontal' enctype="multipart/form-data" method='post'>		
      		  <div class="row">
							<div class="col-xs-4">
								<label class="radio"><input type="radio" name="radio" checked=""><i></i>One Way</label>
							</div>
							<div class="col-xs-8">
								<label class="radio"><input type="radio" name="radio"><i></i>Round Trip</label>
							</div>
                     </div>
                     <div class="clear"></div>
              <div class="row">                
            <label class='col-xs-3' rel='tooltip'>Departure Date</label>
         	<div id="dptdatetimepicker" class="input-append col-xs-6">
    		<input id="dptDate" name="dptDate" data-format="dd-MM-yyyy" type="text" value="Select date"></input>
    <span class="add-on"><i class="glyphicon glyphicon-calendar" data-time-icon="icon-time" data-date-icon="glyphicon-calendar"></i></span></div>  		
    </div>
    <div class="clear"></div>   
        <div class="row">         
      		<label class='col-xs-3' rel='tooltip'>Return Date</label>
         	<div id="retdatetimepicker" class="input-append col-xs-6">
    		<input id="retDate" name="retDate" data-format="dd-MM-yyyy" type="text" value="Select date"></input>
    		<span class="add-on"><i class="glyphicon glyphicon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
            </div></div>
            <div class="clear"></div>
            
            <div class="row">
				<div class="col-xs-4">
								<label for="name">Adult(12+yrs)</label>
								<select class="custom-select" id="select-4">
									<option selected="selected">1</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
								</select>
						</div>		
						<div class="col-xs-4">
								<label for="name">Children(2-12Yrs)</label>
								<select class="custom-select" id="select-5">
									<option selected="selected">0</option>
									<option>0</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
								</select>
						</div>	
						<div class="col-xs-4">
								<label for="name">Infant(0-2Yrs)</label>
								<select class="custom-select" id="select-6">
									<option selected="selected">0</option>
									<option>0</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
								</select>
							</div>	
							<div class="clear"></div>	
						</div>		
  			</div>
  		
		<script id="flight-button-template" type="text-template">
		<button class="btn btn-primary" data-loading-text="Loading...">
	<span class="glyphicon glyphicon-plane"></span>
		Find flights between above and below locations</button>
		</script>
	</form></div></div>
    
		<div class="container">
			<div class="page-header">
				<h1><?php echo $plan[0]["plan_name"] ?></h2>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<ul id="plan_list" class="plan timeline"></ul>
					<div class="airplane"></div>
				</div>
				<div class="hidden-xs col-sm-4 gmaps-canvas-placeholder">
					<div class="hidden-xs gmaps-canvas" data-spy="affix" data-offset-top="0">
						<div id="gmaps-canvas"></div>
					</div>
				</div>
			</div>
		</div>	
		<?php echo "<script>
				var posts=".json_encode($posts)."
			</script>"; ?>

		<script id="place-template" type="text-template">
			<div class="timeline-badge"><span class="glyphicon glyphicon-map-marker"></span></div>
			<div id=<%= pid %> name =<%= sequence_num %> class="timeline-panel place">
				
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
				<h3><%=airport1 %> to <%=airport2 %></h3>
				<p>
					Carrier: <%= carrier %> /
					Cost: $<%= cost %> /
					Departure Date: <%=departuredate%>
				</p>
			</div>
		</script>
		
		<script src="js/app.js"></script>
		<script src="js/planTrip.js"></script>
          <script>
  	var curSeq = [];
	var newSeq = [];

  $(function() {
  	$(".plan" ).on( "sortcreate", function( event, ui ) {
  			
  	} );

    $( ".plan" ).sortable();   

    $( ".plan" ).on( "sortout", function( event, ui ) {

	$("ul#plan_list > li").each(function( index ) {
				alert(index);
  				alert($(this).find("#"+index).attr("name"));
  			});
} );

function showProps(obj) {
  var result = "";
  for (var i in obj) {
    if (obj.hasOwnProperty(i)) {
        result += "." + i + " = " + obj[i] + "\n";
    }
  }
  return result;
}
  });
  </script>	
	</body>
</html>