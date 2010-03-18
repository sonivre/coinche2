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
	}else{//For FusionChart
	
		$strXML = "<graph bgColor='CCC5AE' yaxisminvalue='0' yaxismaxvalue='";
		$strXMLbis = "' formatNumberScale='0' decimalPrecision='0' animation='1' showLegend='0' showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' canvasBorderColor='666666' baseFontColor='333333'>";
		$strXMLcat = "<categories>";
		$strXMLdata1 = "<dataset seriesname='Les bleus' color='4572A7'>";
		$strXMLdata2 = "<dataset seriesname='Les rouges' color='AA4643'>";
		
		$sql = "SELECT score1,score2 FROM `".TABLE_DONNE."` WHERE fkpartieid = ".$_SESSION['partieId']." ORDER BY pkid";

		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 

		$db->connect(); 		  
				  
		$rows = $db->fetch_all_array($sql);

		$somme1 = 0;
		$somme2 = 0;				
		$count	= 1;
		$yaxismaxvalue = 1000;
		
		//new partie
		if(count($rows) == 0){
			$strXMLcat .= "<category name='1' />";
			$strXMLdata1 .= "<set value='0'/>";
			$strXMLdata2 .= "<set value='0'/>";		
		}
		
		foreach($rows as $row){ 
			$point1 = $row['score1'];
			$somme1 += $point1;
			$point2 = $row['score2'];
			$somme2 += $point2;			
			$strXMLcat .= "<category name='".($count++)."' />";
			$strXMLdata1 .= "<set value='".$somme1."'/>";
			$strXMLdata2 .= "<set value='".$somme2."'/>";
		}
		$maxi = max($somme1,$somme2);
		if($maxi>0)$yaxismaxvalue = (floor($maxi/1000)+1)*1000;
		
		$strXMLcat .= "</categories>";
		$strXMLdata1 .= "</dataset>";
		$strXMLdata2 .= "</dataset>";
		$strXML .= $yaxismaxvalue . $strXMLbis . $strXMLcat . $strXMLdata1 .$strXMLdata2 . "</graph>";
		print($strXML);
		
		$db->close();		
	}
}else{
	print('{data:[0]}');
}
?>		