<?php
session_start();
require("config.inc.php"); 
require("Database.class.php");

if(isset($_SESSION['partieId'])){

	if (isset($_GET['equipe']) && $_GET['equipe'] != "") {

		$equipe = $_GET['equipe'];

		$score = 'score'.$equipe;

		$sql = "SELECT score".$equipe." FROM `".TABLE_DONNE."` WHERE fkpartieid = ".$_SESSION['partieId']." ORDER BY pkid";

		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 

		$db->connect(); 		  
				  
		$rows = $db->fetch_all_array($sql);

		$somme = 0;
		
		print('{data:[');
		
		//if(count($rows) == 0){
			print('0,');
		//}else{		
			foreach($rows as $row){ 
				$point = $row[$score];
				$somme += $point;
				print($somme.',');
			}
		//}
		print(']}');

		$db->close();
	}        
}else{
	print('{data:[0]}');
}
?>		