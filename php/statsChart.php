<?php
session_start();
require("config.inc.php"); 
require("Database.class.php");

//get all partie id from the same soiree
if(!isset($_SESSION['soireeIds'])){

	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 

	$db->connect(); 
	
	$yesterday = date('Y-m-d 12:00:00', mktime(0, 0, 0, date("m") , date("d") - 1, date("Y")));
	
	$sqlSoiree = "SELECT pkid FROM `".TABLE_PARTIE."` WHERE dstart > '".$yesterday."'";
	
	$rows = $db->fetch_all_array($sqlSoiree);
	
	$ids = array();
	$k=0;
	foreach($rows as $row){ 
		$id = $row['pkid'];
		$ids[$k++]=$id;
	}		
	
	$_SESSION['soireeIds']=$ids;
	
	$db->close();	
}
$soireeIds = $_SESSION['soireeIds'];

$soireeIdsAsString ="";
foreach($soireeIds as $soireeId){ 
	$soireeIdsAsString.=$soireeId.",";
}
$soireeIdsAsString = substr($soireeIdsAsString, 0,strlen($soireeIdsAsString)-1);

$soireeIdsAsString = 'in ('.$soireeIdsAsString.')';


if(isset($_SESSION['partieId'])){

	$strXMLeff = "";
	$strXML = "<graph bgColor='CCC5AE' animation='1' decimalPrecision='0' showLegend='0' showColumnShadow='1' yAxisMaxValue='";
	$strXMLbis = "' showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' canvasBorderColor='666666' baseFontColor='333333'>";
	$strXMLcat = "<categories font='Arial' fontSize='10' fontColor='000000'><category name='Les bleus' /><category name='Les rouges' /></categories>";
	$strXMLdata0 = "<dataset seriesname='Sans Atout' color='5D7794'>";
	$strXMLdata1 = "<dataset seriesname='Atout' color='D6D17B'>";
	$strXMLdata2 = "<dataset seriesname='Tout Atout' color='E36D4B'>";
	
	$yaxismaxvalue = 10;
	$stats1 = array(0,0,0);//A,SA,TA
	$stats2 = array(0,0,0);
	
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 

	$db->connect(); 
	
	//compute efficacité + réussite
	//select count(*) from donne where fkpartieid=10 and annonceur=2 and score2=0;
	$sqlTotal = "SELECT count(*) as total FROM `".TABLE_DONNE."` WHERE fkpartieid ".$soireeIdsAsString;
	$sqlTotalEquipe = "SELECT count(*) as total FROM `".TABLE_DONNE."` WHERE fkpartieid ".$soireeIdsAsString." group by annonceur order by annonceur asc";
	$sqlTotalKoEquipe1 = "SELECT count(*) as total FROM `".TABLE_DONNE."` WHERE fkpartieid ".$soireeIdsAsString." and score1 = 0 and annonceur = 1";
	$sqlTotalKoEquipe2 = "SELECT count(*) as total FROM `".TABLE_DONNE."` WHERE fkpartieid ".$soireeIdsAsString." and score2 = 0 and annonceur = 2";
	
	$rowsTot = $db->query_first($sqlTotal);
	$donnesTotal = $rowsTot['total'];
	
	$donnesTotalByEquipe = array(0,0);
	$rowsTot = $db->fetch_all_array($sqlTotalEquipe);
	$i=0;
	foreach($rowsTot as $rowTot){ 
		$tot = $rowTot['total'];
		$donnesTotalByEquipe[$i++]=$tot;
	}		
	
	$rowsTot = $db->query_first($sqlTotalKoEquipe1);
	$donnesKo1 = $rowsTot['total'];
	
	$rowsTot = $db->query_first($sqlTotalKoEquipe2);
	$donnesKo2 = $rowsTot['total'];	
	
	//Taux de réussite : nb_ok_equipe1 * 100 / nb_total_equipe1
	//Taux d’efficacité : (nb_ok_equipe1 + nb_nok_equipe2 ) * 100 / nb_total	
	$reu1 = $donnesTotalByEquipe[0]!=0 ? ($donnesTotalByEquipe[0]-$donnesKo1)*100/$donnesTotalByEquipe[0] : 0;
	$reu2 = $donnesTotalByEquipe[1]!=0 ? ($donnesTotalByEquipe[1]-$donnesKo2)*100/$donnesTotalByEquipe[1] : 0;
	$eff1 = $donnesTotal!=0 ? ($donnesTotalByEquipe[0]-$donnesKo1+$donnesKo2)*100/$donnesTotal : 0;
	$eff2 = $donnesTotal!=0 ? ($donnesTotalByEquipe[1]-$donnesKo2+$donnesKo1)*100/$donnesTotal : 0;
	
	$strXMLeff .= round($reu1) . "|" . round($reu2) . "|" . round($eff1) . "|" . round($eff2) . "@";
	
	//compute stats des donnes
	//select count(*),vtype from donne where fkpartieid=10 and annonceur=1 group by vtype order by vtype asc; Atout, Sans Atout, Tout Atout
	$sql1 = "SELECT count(*) as total,vtype FROM `".TABLE_DONNE."` WHERE fkpartieid ".$soireeIdsAsString." and annonceur=1 group by vtype order by vtype asc";	
	$sql2 = "SELECT count(*) as total,vtype FROM `".TABLE_DONNE."` WHERE fkpartieid ".$soireeIdsAsString." and annonceur=2 group by vtype order by vtype asc";	
			  
	$rows1 = $db->fetch_all_array($sql1);
	
	foreach($rows1 as $row1){ 
		$tot = $row1['total'];
		$type = $row1['vtype'];
		if($type=='A')$stats1[0]=$tot;
		else if($type=='SA')$stats1[1]=$tot;
		else if($type=='TA')$stats1[2]=$tot;
	}	
	
	$rows2 = $db->fetch_all_array($sql2);
	
	foreach($rows2 as $row2){ 
		$tot = $row2['total'];
		$type = $row2['vtype'];
		if($type=='A')$stats2[0]=$tot;
		else if($type=='SA')$stats2[1]=$tot;
		else if($type=='TA')$stats2[2]=$tot;
	}		
	
	//compute max y absys value
	$somme1 = $stats1[0]+$stats1[1]+$stats1[2];
	$somme2 = $stats2[0]+$stats2[1]+$stats2[2];
	$maxi = max($somme1,$somme2);
	if($maxi>0)$yaxismaxvalue = (floor($maxi/10)+1)*10;
	
	
	//iterate arrays and print dataset
	$strXMLdata0 .= "<set value='".$stats1[1]."' />";
	$strXMLdata0 .= "<set value='".$stats2[1]."' />";
	
	$strXMLdata1 .= "<set value='".$stats1[0]."' />";
	$strXMLdata1 .= "<set value='".$stats2[0]."' />";

	$strXMLdata2 .= "<set value='".$stats1[2]."' />";
	$strXMLdata2 .= "<set value='".$stats2[2]."' />";	
	
	$strXMLdata0 .= "</dataset>";
	$strXMLdata1 .= "</dataset>";
	$strXMLdata2 .= "</dataset>";
	$strXML .= $yaxismaxvalue . $strXMLbis . $strXMLcat . $strXMLdata0 . $strXMLdata1 . $strXMLdata2 . "</graph>";
	print($strXMLeff . $strXML);
	
	$db->close();		
	
}else{
	print('{data:[0]}');
}
?>		