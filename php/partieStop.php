<?php
session_start();
require("config.inc.php"); 
require("Database.class.php");

//just insert the stop date of the current partie
if (isset($_SESSION['partieId'])) {

	$time = $_POST['date'];
	
	$seconds = $time / 1000;
	
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 

	$db->connect(); 

	$data['dstop'] = date("Y-m-d H:i:s", $seconds);
	
	$id = $db->query_update(TABLE_PARTIE, $data, "pkid=".$_SESSION['partieId']);
	
	$db->close();
	
	unset($_SESSION['partieId']);
}        
?>		