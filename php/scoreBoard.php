<?php
session_start();
require("config.inc.php"); 
require("Database.class.php");

if (isset($_SESSION['partieId'])) {


	$sql = "SELECT sum(score1) as s1,sum(score2) as s2 FROM `".TABLE_DONNE."` WHERE fkpartieid = ".$_SESSION['partieId'];

	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 

	$db->connect(); 		  
			  
	$record = $db->query_first($sql);
	
	print('['.$record["s1"].','.$record["s2"].']');
	
	$db->close();
}
?>		