<?php
session_start();
require("config.inc.php"); 
require("Database.class.php");

	//get partie en cours (pas de stop date)
	$sql = "SELECT pkid, j11, j12, j21, j22 FROM `".TABLE_PARTIE."` WHERE pkid = (select max(pkid) from `".TABLE_PARTIE."`) and dstop is null";

	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 

	$db->connect(); 		  
			  
	$record = $db->query_first($sql);
//print("count($record): ".count($record)).", pkid:".$record["pkid"]."<br>";	
	if(count($record)>0 && $record["pkid"] > 0){
	
		$_SESSION['partieId']=$record["pkid"];
		
		//set joueurs ids
		$joueurs = array($record["j11"],$record["j21"],$record["j12"],$record["j22"]);
		$_SESSION['joueurs']=$joueurs;
		
		//set joueur names
		$i = 0;
		foreach ($joueurs as $joueur) {
		
			$sql = "SELECT nom FROM `".TABLE_JOUEUR."` WHERE pkid = ".$joueur;
			
			$record = $db->query_first($sql);
			
			$joueursName[$i++] = $record["nom"];		
		}	

		$_SESSION['joueursName']=$joueursName;		
		
		if (isset($_SESSION['partieId'])) {
		
			//get last donneur
			$sql = "SELECT donneur FROM `".TABLE_DONNE."` WHERE fkpartieid = ".$_SESSION['partieId']." ORDER BY pkid DESC";
			
			$record = $db->query_first($sql);
		
			$nextDonneur = $joueurs[0];
			
			//if partie started...
			if(count($record)>0){				
				$nextDonneur = getNextJoueur($joueurs, $record["donneur"]);				
			}
		
			$_SESSION['donneur']=$nextDonneur;
			
		}
		
	}else{
		print("KO");
	}
	$db->close();     
?>		