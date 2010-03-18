<?php
//database server
define('DB_SERVER', "srvrgis");

//database login name
define('DB_USER', "sezame");
//database login password
define('DB_PASS', "sezame");

//database name
define('DB_DATABASE', "coinche");

//smart to define your table names also
define('TABLE_DONNE', "donne");
define('TABLE_PARTIE', "partie");
define('TABLE_JOUEUR', "joueur");

function getNextJoueur($arrayJoueurs, $currentJoueur)
{
	return getJoueur($arrayJoueurs, $currentJoueur, true);
}
function getPreviousJoueur($arrayJoueurs, $currentJoueur)
{
    return getJoueur($arrayJoueurs, $currentJoueur, false);
}
function getJoueur($arrayJoueurs, $currentJoueur, $next)
{
	$nextJoueur = -1;
	while ($joueur = current($arrayJoueurs)) {
		if ($joueur == $currentJoueur) {
			if($next == true){
				$nextJoueur = $arrayJoueurs[(key($arrayJoueurs)+1)%4];
			}else{
				if(key($arrayJoueurs)==0)$nextJoueur = $arrayJoueurs[3];
				else $nextJoueur = $arrayJoueurs[(key($arrayJoueurs)-1)%4];
			}
		}
		next($arrayJoueurs);
	}			
    return $nextJoueur;
}
?>