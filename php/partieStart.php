<?php
session_start();
require("config.inc.php"); 
require("Database.class.php");

if (isset($_POST['j11']) && isset($_POST['j12']) && isset($_POST['j21']) && isset($_POST['j22']) && isset($_POST['date'])) {

	$j11 = $_POST['j11'];
	$j12 = $_POST['j12'];
	$j21 = $_POST['j21'];
	$j22 = $_POST['j22'];
	$time = $_POST['date'];
	
	$seconds = $time / 1000;
	
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 

	$db->connect(); 

	$data['dstart'] = date("Y-m-d H:i:s", $seconds);
	//$data['dstop'] = null;
	$data['j11'] = $j11;
	$data['j12'] = $j12;
	$data['j21'] = $j21;
	$data['j22'] = $j22;
	
	$joueurs = array($j11,$j21,$j12,$j22);
	
	$joueursName = array("","","","");
	
	$id = $db->query_insert(TABLE_PARTIE, $data);
	
	//get joueur names
	$i = 0;
	foreach ($joueurs as $joueur) {
	
		$sql = "SELECT nom FROM `".TABLE_JOUEUR."` WHERE pkid = ".$joueur;
		
		$record = $db->query_first($sql);
		
		$joueursName[$i++] = $record["nom"];		
	}	
	
	$_SESSION['partieId']=$id;
	$_SESSION['donneur']=$joueurs[0];
	$_SESSION['joueurs']=$joueurs;
	$_SESSION['joueursName']=$joueursName;
	
	$db->close();
}        
?>		