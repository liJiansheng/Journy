<?php
	require_once("connect.php");

	class API {
		static function getTrip($tid) {
			$tid = intval($tid);
			
			if ($tid == null) return false;
			else return (mysql_query("SELECT * FROM tlogs WHERE tid = $tid"));
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
		
		static function getPlanPosts($planid) {
			$planid = intval($planid);
			
			if ($planid == null) return false;
			else return (mysql_query("SELECT * FROM planpost WHERE planid = $planid"));
		}
	}
?>
