<?php
	// di default faccio la tabellina del 2
	$base = 2;
	// a meno che il mio utente non me ne chieda un'altra
	if( isset($_GET["base"]) ){
		$base = $_GET["base"];
	}
	// di default lo faccio per 10 volte
	$ripetizioni = 10;
	// altrimenti guardo quante ne vuole l'utente
	if( isset($_GET["ripetizioni"]) ){
		$ripetizioni = $_GET["ripetizioni"];
	}
	
	$buffer = [];
	
	// per ogni ripetizione prevista
	for($i=0; $i < $ripetizioni; $i++){
		// ne invio il risultato
		$buffer[] = array(
						$base + 0,
						$i,
						$base * $i 
					);
	}
	
	echo json_encode( $buffer );