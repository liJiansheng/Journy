<?php
require_once("connect.php");
class Api {

	static function getFrensTripID($uid){
		$uid = intval($uid);
		if ($uid == null) return false;
		else return (mysql_query("SELECT tid FROM fren_log WHERE uid=$uid"));
	}
	
	static function getFrens($uid){
		$uid = intval($uid);
		if ($uid == null) return false;
		else return (mysql_query("SELECT * FROM user u INNER JOIN fren_log f WHERE u.id = f.fid WHERE f.uid=$uid"));
	}
	
	static function viewAllFrensLog ($fid, $tid, $uid) {
		$fid = intval($fid);
		$tid = intval($tid);
		$uid = intval($uid);
		if ($tid == null || $fid == null || $uid==null) return false;
		else return (mysql_query("SELECT * FROM tlogs t INNER JOIN fren_log f WHERE f.fid=$fid AND f.uid=$uid AND f.tid=$tid AND t.tid=f.tid;"));
	}
	
	static function viewFrensLog ($tid) {
		$tid = intval($tid);
		
		if ($tid == null) return false;
		else return (mysql_query("SELECT * FROM tpost WHERE tid = $tid;"));
	}

		static function getFlog ($tid,$fid) {
		$tid = intval($tid);
		
		if ($tid == null) return false;
		else return (mysql_query("SELECT * FROM tlogs WHERE tid = $tid;"));
	}
	
		static function getUser ($uid) {
		$uid = intval($uid);
		//echo $userID;
		//$role = mysql_fetch_assoc(mysql_query("SELECT role as r FROM users where userID=$userID;"));			
		//errorMessage("Get user ".$role, "error.php");	
		//errorMessage("Get user student ".$role , "error.php");	
	//	if($role['r'] == 1){			
		return mysql_fetch_assoc(mysql_query("SELECT * from user WHERE id = $uid;"));
		//}
	}
		static function validate ($username, $password) {	
		$username = mysql_real_escape_string($username);
		//$password = md5($password);
		$data = mysql_fetch_assoc(mysql_query("SELECT * FROM user WHERE email = $username AND pass = $password AND confirmed = 1"));		
		if (!$data) return false;
		else {
			session_start();
			$_SESSION["uid"]=$data["id"];
			session_write_close();
			return true;
		}
	}
	
	static function validatePlan ($data) {	
		$fieldsToCheck = array('plan_name', 'uid','des');
		foreach ($fieldsToCheck as $k => $field) {
			if (!isset($data[$field]) || $data[$field] == "") {
				errorMessage("Field '$field' cannot be left blank!");
				return false;
			}
		}	
		return true;
	}	
	
	static function addPlan ($edata) {

		$edata['plan_name'] = mysql_real_escape_string($edata['plan_name']);					
		$edata['plan_location'] = mysql_real_escape_string($edata['plan_location']);
		$edata['planid'] = mysql_real_escape_string($edata['planid']);
		$edata['cost'] = mysql_real_escape_string($edata['cost']);
		$edata['uid']=mysql_real_escape_string($edata['uid']);

            // everything was fine !
		mysql_query("INSERT INTO plans (planid, plan_name, plan_location, cost, uid) VALUES ('$edata[planid]','$edata[plan_name]','$edata[plan_location]','$edata[cost],'$edata[uid]')");
			
		$planid = mysql_insert_id();
		return $planid;               
	}
////////////////////////////////////////////////////////////////
		static function getTrip($tid) {
		$tid = intval($tid);
			
			if ($tid == null) return false;
			else return (mysql_query("SELECT * FROM tlogs WHERE tid = $tid"));
		}

		static function getFrensTrip($tid) {
			$tid = intval($tid);
			
			if ($tid == null) return false;
			else return (mysql_query("SELECT t.tid, t.uid,t.tname,t.tdes,t.numdays, u.name, m.image FROM tlogs t INNER JOIN user u ON t.uid=u.id INNER JOIN (SELECT * FROM tpost p WHERE p.tid=$tid LIMIT 1) m ON t.tid=m.tid WHERE t.tid = $tid"));
		}

			static function getMyTrips($uid) {
			$uid = intval($uid);
			
			if ($uid == null) return false;
			else return (mysql_query("SELECT * FROM tlogs WHERE uid = $uid"));
		}
		
		static function getTripPosts($tid) {
			$tid = intval($tid);
			
			if ($tid == null) return false;
			else return (mysql_query("SELECT * FROM tpost WHERE tid = $tid"));
		}
		
		static function getPlan($planid) {
			$planid = intval($planid);
			
			if ($planid == null) return false;
			else return (mysql_query("SELECT * FROM plans WHERE planid = $planid"));
		}
		
		static function getMyPlans($uid) {
			$uid = intval($uid);			
			if ($uid == null) return false;
			else return (mysql_query("SELECT * FROM plans WHERE uid = $uid"));
		}
		
		static function getPlanPosts($planid) {
			$planid = intval($planid);
			
			if ($planid == null) return false;
			else return (mysql_query("SELECT * FROM planpost WHERE planid = $planid ORDER BY sequence_num"));
		}	
}

?>