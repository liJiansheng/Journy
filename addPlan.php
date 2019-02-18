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
$isShow = false;
if($plan!=null){
	$isShow = true;
}
//$subject['category'] = implode(",", $subject['category']);
require_once("header.php");
?>
<div class="container"><div class="row"><div class="col-md-8">
<div class="col-md-8"><h2>Add Plan</h2>
<form class='form-horizontal' method='post'><fieldset>
	<div class='form-group'>
		<label class="col-md-3" for="plan_name">Plan Name:</label>
		<input type="text" id="plan_name" name="plan_name" class="form-control" value="<?php if($isShow) echo htmlentities($plan['plan_name']); ?>">
	</div>
    <div class='form-group'>
		<label class="col-md-3" for="description">Description:</label>
			<textarea id="des" name="des" class="form-control" rows="15" placeholder="Description">
				<?php if($isShow) echo htmlentities($plan['des']); ?>
		</textarea>
         <input type="hidden" id="uid" name="uid" class="col-md-8" placeholder="" value="<?php if($isShow) echo htmlentities($_SESSION["uid"]);?>">     
	</div> 		
	
    <div class='form-group'>
		<button type="submit" class="btn btn-primary" name="submit">Add plan</button>
		<button type="reset" class="btn ">Clear</button>
	</div> 
</fieldset>
</form>
</div></div>
