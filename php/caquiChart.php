<?php
session_start();

$isFusionChart = $_GET['fusionChart'];

$joueurs = $_SESSION['joueurs'];
$joueursName = $_SESSION['joueursName'];
$donneur = $_SESSION['donneur'];

$color = array("4572A7","AA4643","4572A7","AA4643");

if($isFusionChart == true)print("<graph bgColor='CCC5AE' showShadow='1' showValues='0' animation='1' shownames='1' pieRadius='120' canvasBorderColor='666666' baseFontColor='333333'>");
else print("[");

$i = 0;
foreach ($joueurs as $joueur) {
	if($donneur == $joueur){
		if($isFusionChart == true)print("<set value='25' name='".$joueursName[$i]."' color='".$color[$i]."' isSliced='1'/>");
		else print("{name:'".$joueursName[$i]."',y:25,sliced: true},");
	}else{
		if($isFusionChart == true)print("<set value='25' name='".$joueursName[$i]."' color='".$color[$i]."' />");
		else print("['".$joueursName[$i]."',25],");
	}
	$i++;
}
if($isFusionChart == true)print("</graph>");
else print("]");
/*

For FusionChart

<graph bgColor='ECDDAF' pieYScale='75' showShadow='1' showValues='0' animation='1' shownames='1' pieRadius='120' canvasBorderColor='666666' baseFontColor='333333'>
<set value='25' name='Marco' color='4572A7'/>
<set value='25' name='Item B' color='AA4643'/>
<set value='25' name='Item C' color='4572A7' isSliced='1'/>
<set value='25' name='Item D' color='AA4643'/>
</graph>


		  data: [['Fred', 25],
			 ['Nico', 25],
			 {
				name: 'Marcrrooo',
				y: 25,
				sliced: true
			 },
			 ['Olivier', 25]
		  ]
*/		  
?>			  