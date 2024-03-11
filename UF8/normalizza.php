<?php
	// leggere tutto il contenuto del file
	$tutto = file_get_contents("dati/archeo.txt");
	// convertire tutto in ASCII
	$tutto = mb_convert_encoding($tutto, "ASCII");
	// separare in righe tramite l'"a capo"
	$righe = explode("\r\n", $tutto);
	
	// costruire i contenitori per i dati
	$origini = [];
	$siti = [];
	$punti = [];

	// per ogni riga
	for($i = 1; $i < sizeof($righe); $i++){
		// recuperare la riga che ci interessa
		$riga = $righe[$i];
		// da questa spezzare per ";" per ottenere le singole celle
		$riga = explode(";", $riga); //$riga[2]
		// se la riga contien almeno 4 celle, ovvero non è vuota 
		if(sizeof($riga) > 4){
			// prendo l'origine indicata nella riga
			$origineAttuale = str_replace("\"", "", $riga[4]);
			// se non è presente tra quelle che già conosco
			if( !isset( $origini[$origineAttuale] ) ){
				// la aggiungo
				$origini[$origineAttuale] = sizeof($origini) + 1;
			}
			// faccio la stessa cosa per il sito
			$sitoAttuale = str_replace("\"", "", $riga[6]);
			if( !isset( $siti[$sitoAttuale]) ){
				$siti[$sitoAttuale] = sizeof($siti) + 1;
			}
			// ora che ho la possibilità di chiedere a $origini il numero di "celti"
			$punti[] = array(
						"idpunto" => intval($riga[0]),
						"X" => floatval( str_replace(",", ".", $riga[1]) ),
						"Y" => floatval( str_replace(",", ".", $riga[2]) ),
						"descrizione" => str_replace("\"", "", $riga[3]),
						"idorigine" => $origini[ $origineAttuale ],
						"idsito" => $siti[ $sitoAttuale ]
					);
		}
		
	}
	// scaricare tutti i dati dalla ram alla conservazione a lungo termine,
	// ovvero l'hdd
	file_put_contents("dati/origini.json", json_encode($origini, JSON_PRETTY_PRINT));
	file_put_contents("dati/punti.json", json_encode($punti, JSON_PRETTY_PRINT));
	file_put_contents("dati/siti.json", json_encode($siti, JSON_PRETTY_PRINT));
	echo "fatto.";