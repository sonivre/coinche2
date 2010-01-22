<?php
session_start();

$joueurs = $_SESSION['joueurs'];
print("[");
foreach ($joueurs as $joueur) {
    print("['".$joueur."',25],");
}
print("]");
/*
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