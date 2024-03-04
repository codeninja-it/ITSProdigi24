<?php
	// stabilisco che la ricerca di default è ""
	$ricerca = "";
	// a meno che l'utente non mi chieda qualcos'altro
	if( isset($_GET["q"]) ){ // archeo.php?q=museo
		$ricerca = $_GET["q"];
	}
	
	$provincia = "";
	if( isset($_GET["pr"])){
		$provincia = $_GET["pr"];
	}
		
	
	// leggo il contenuto del file
	$tutto = file_get_contents("dati/archeo.txt");
	// qualunque sia il suo charset lo converto in ASCII
	$tutto = mb_convert_encoding($tutto, "ASCII");
	// spezzo tutto il testo per ogni "a capo" che trovo
	$righe = explode("\r\n", $tutto);
	
	// mi creo un buffer
	$buffer = [];
	// e per ogni riga
	for($i=0; $i < sizeof($righe); $i++){
		// sezzandola per ";" ottengo le celle
		$celle = explode(";", $righe[$i]);
		// se la descrizione contiene quanto l'utente cerca
		if(
			sizeof($celle) > 13 && 
			strpos($celle[3], $ricerca) != false && 
			strpos($celle[12], $pr) 
		){ // "Mu" => "Mus"
			// inserisco nel buffer la riga
			$buffer[] = $celle;
		}
	}
	
	// invio all'utente il buffer completo
	echo json_encode($buffer, JSON_PRETTY_PRINT);