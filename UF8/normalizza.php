<?php

	$tutto = file_get_contents("dati/archeo.txt");
	$tutto = mb_convert_encoding($tutto, "ASCII");
	$righe = explode("\r\n", $tutto);
	
	$origini = [];
	$punti = [];
	
	for($i = 1; $i < sizeof($righe); $i++){
		$riga = $righe[$i];
		$riga = explode(";", $riga); //$riga[2]
		if(sizeof($riga) > 4){
			$origineAttuale = $riga[4];
			if( !isset( $origini[$origineAttuale] ) ){
				$origini[$origineAttuale] = sizeof($origini) + 1;
			}
			$punti[] = array(
						"idpunto" => $riga[0],
						"X" => $riga[1],
						"Y" => $riga[2],
						"descrizione" => $riga[3],
						"idorigine" => $origini[ $origineAttuale ]
					);
		}
		
	}
	file_put_contents("dati/origini.json", json_encode($origini));
	file_put_contents("dati/punti.json", json_encode($punti));
	echo "fatto.";