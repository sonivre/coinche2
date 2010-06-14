<?php
session_start();
require("config.inc.php"); 
require("Database.class.php");

	$res = '';

	//get last closed partie, and retrieve players
	$sql = "SELECT pkid, j11, j12, j21, j22 FROM `".TABLE_PARTIE."` WHERE pkid = (select max(pkid) from `".TABLE_PARTIE."`) and dstop is not null";

	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 

	$db->connect(); 		  
			  
	$record = $db->query_first($sql);
	
	if(count($record)>0 && $record["pkid"] > 0){
	
		$res = "[".$record['j11'].",".$record['j21'].",".$record['j12'].",".$record['j22']."]";
		
		print($res);
		
	}else{
		print("KO");
	}
	$db->close();     
?>		