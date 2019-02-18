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
  			</form></div></div>