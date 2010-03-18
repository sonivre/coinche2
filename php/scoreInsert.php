<?php
session_start();
require("config.inc.php"); 
require("Database.class.php");

if (isset($_POST['s1']) && $_POST['s1'] != "") {

	$s1 = $_POST['s1'];
	$s2 = $_POST['s2'];
	$type = $_POST['type'];
	$c = $_POST['c'];
	$sc = $_POST['sc'];
	$a = $_POST['a'];
	$an = $_POST['an'];
	
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 

	$db->connect(); 

	$data['fkpartieid'] = $_SESSION['partieId'];
	$data['score1'] = $s1;
	$data['score2'] = $s2;
	$data['vtype'] = $type;
	$data['coinche'] = $c;
	$data['scoinche'] = $sc;
	$data['donneur'] = $_SESSION['donneur'];
	$data['annonceur'] = $a;
	$data['annonce'] = $an;

	$db->query_insert(TABLE_DONNE, $data);
	
	//increment donneur
	$joueurs = $_SESSION['joueurs'];
	$nextDonneur = getNextJoueur($joueurs, $_SESSION['donneur']);
	$_SESSION['donneur'] = $nextDonneur;

	$db->close();
}        
?>		