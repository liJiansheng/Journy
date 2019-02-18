<?php
session_start();
	if(!isset($_SESSION["uid"])){
		header("Location: login.php");
	}
require_once("connect.php");

 function editPlanSequence($data, $planid){
	 $count = sizeof($data);
	 for($i=0;$i<$count;$i++){
		$data['pid'] = mysql_real_escape_string($data[$i][0]);
	//	$data['seq'] = mysql_real_escape_string($data[$i][1]);
		
		mysql_query("UPDATE planpost SET sequence_num=$i WHERE pid=$data[pid] AND planid = $planid;");
	
	 }
	// mysql_query("INSERT INTO planpost (pid, uid, planid, title,des, sequence_num,plan_hrs) VALUES 
	 //	(1, 4,0,'test','test des', 10, 2)");
	
}

editPlanSequence($_POST['seqArr'], $_POST['planid']);
?>