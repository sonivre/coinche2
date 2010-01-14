<?php
require("config.inc.php"); 
require("Database.class.php");

if (isset($_GET['equipe']) && $_GET['equipe'] != "") {

	$equipe = $_GET['equipe'];

	$score = 'score'.$equipe;

	$sql = "SELECT score".$equipe." FROM `".TABLE_DONNE."` WHERE fkpartieid = 1 ORDER BY pkid";

	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 

	$db->connect(); 		  
			  
	$rows = $db->query($sql);

	$somme = 0;
	
	print('[');
	while ($record = $db->fetch_array($rows)) {
		$point = $record[$score];
		$somme += $point;
		print($somme.',');
	}
	print(']');

	$db->close();
}        
?>		