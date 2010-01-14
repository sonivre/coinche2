<?php
require("config.inc.php"); 
require("Database.class.php");

if (isset($_POST['s1']) && $_POST['s1'] != "") {

	$s1 = $_POST['s1'];
	$s2 = $_POST['s2'];
	
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 

	$db->connect(); 

	$data['fkpartieid'] = 1;
	$data['score1'] = $s1;
	$data['score2'] = $s2;
	$data['vtype'] = "A";
	$data['coinche'] = 0;
	$data['scoinche'] = 0;

	$db->query_insert(TABLE_DONNE, $data);

	$db->close();
}        
?>		