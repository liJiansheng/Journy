<?php
	require_once("session.php");
	require_once("common.php");
	$sess->authPage(2);	
		require_once("ApiClass.php");

	if (isset($_POST['submit'])) {
		if (Api::validatePlan($_POST)) {
			$planid = Api::addPlan($_POST);
			successMessage("Plan Added", 'planTrip.php?planid='.$planid);
			die(0);
		}
	}
	$plan= $_POST;

	require_once("header.php");
?>
<div class="container"><div class="row"><div class="col-md-8">
<div class="col-md-8"><h2>Add Plan</h2>
<form class='form-horizontal' method='post'><fieldset>
	<div class='form-group'>
		<label class="col-md-3" for="plan_name">Plan Name:</label>
		<input type="text" id="plan_name" name="plan_name" class="form-control" value="<?php echo htmlentities($plan['plan_name']); ?>">
	</div>
    
    	<div class='form-group'>
		<label class="col-md-3" for="plan_name">Where To:</label>
		<input type="text" id="plan_location" name="plan_location" class="form-control" value="<?php echo htmlentities($plan['plan_location']); ?>">
	</div>
	
	<div class='form-group'>
		<label class="col-md-3" for="description">Budget:</label>
			<textarea id="plan_cost" name="plan_cost" class="form-control" rows="15" placeholder="Budget">
<?php echo htmlentities($plan['plan_cost']); ?>
</textarea>
	</div>
	 <input type="hidden" id="uid" name="uid" class="col-md-8" placeholder="" value="<?php echo htmlentities($mydata['uid']);?>">
     
    <div class='form-group'>
		<button type="submit" class="btn btn-primary" name="submit">Add plan</button>
		<button type="reset" class="btn clear">Clear</button>
	</div> 
</fieldset>
</form>
</div></div>
